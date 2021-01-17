<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\OrderPlan;
use App\FirmPlan;
use App\Frame;
use App\Firm;
use App\Event;
use Carbon\Carbon;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $orders = Order::latest()->paginate(10);
      return view('admin.orders.index', compact('orders') );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
      $orders = Order::latest()->paginate(10);
      return view('admin.orders.index', compact('orders') );
    }

    public function create_frames($id)
    {
        try {
            DB::beginTransaction();

            $order = Order::find($id);

            $firm_plans = $order->firm_plans;
            foreach ($firm_plans as $firm_plan) {
                if($firm_plan->plan_id == 3) // indian event
                {
                    // var_dump("<br>1-", $firm_plan->plan_id, !in_array ( $firm_plan->plan_id, [1,3]  ) );
                    // get all future events for current year
                    $events = Event::orderBy('date', 'asc')->where('date', '>=', now())->get();
                    // create frames for each event
                    foreach ($events as $event) {


                        // we should not create duplicate frame for 1 event
                        // so-> find if frame is already created or not for this event and firm combination
                        // nested query in laravel
                        $firm_id = $firm_plan->firm->id;
                        $frame = Frame::whereHas('firm_plan', function($q) use ($firm_id)
                                {
                                    $q->where('firm_id', $firm_id);
                                })->where('event_id', $event->id)->first();

                        if(!$frame)
                        {
                            $frame = new Frame;
                            $frame->schedule_on = $event->date;
                            $frame->firm_plan_id = $firm_plan->id;
                            $frame->event_id = $event->id;
                            $frame->content = $event->desc;
                            $frame->save();
                            $firm_plan->date_scheduled_upto = $frame->schedule_on;
                        }
                    }
                }
                else
                if( !in_array ( $firm_plan->plan_id, [1,3] ) )
                {
                  // var_dump("<br>2-", $firm_plan->plan_id, !in_array ( $firm_plan->plan_id, [1,3]  ) );

                    // find $frames having ->scheduled_on < $firm_plan->date_start_from
                    $is_frames_created = false;
                    if(!$is_frames_created)
                    {
                        // var_dump("<pre>",$firm_plan);die();
                        $days_interval = 30/$firm_plan->qty_per_month;
                        $start_day = $firm_plan->date_start_from;
                        $next_day = $firm_plan->date_start_from;

                        if($firm_plan->date_scheduled_upto != null)
                        {
                            // if some frames already created upto 'date_scheduled_upto' date
                            $next_day = $firm_plan->date_scheduled_upto;
                            $next_day->addDays($days_interval);
                        }

                        // create frame if $next_day < $firm_plan->date_expiry
                        while($next_day <= $firm_plan->date_expiry)
                        {
                            $frame = new Frame;
                            $frame->schedule_on = $next_day;
                            $frame->firm_plan_id = $firm_plan->id;
                            $frame->save();
                            $firm_plan->date_scheduled_upto = $next_day;
                            $next_day->addDays($days_interval);
                        }
                    }// if
                }
                $firm_plan->save();
            }
            DB::commit();
            return "Done!";
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            // TEMP
            $user = Auth::user();

            $is_trial = !$user->is_trial_used;
            // $plan_days = $is_trial ? 7 : 30;
            $trial_days = 10;
            // CREATE order
            $firm = Firm::find($request->firm_id);
            // $firm = $user->firms()->first();
            $order = new Order;
            $order->amount = 0;
            $order->user_id = $user->id;
            $order->firm_id = $firm->id;
            $order->save();

            $total = 0;
            foreach (json_decode($request->plans) as $plan) {

                $order_plan = new OrderPlan;
                $order_plan->order_id = $order->id;
                $order_plan->plan_id = $plan->id;
                $order_plan->rate = $plan->rate;
                $order_plan->qty = $plan->slab_selected;
                // $order_plan->is_trial = $is_trial;
                $order_plan->save();

                $total += $plan->rate*$order_plan->qty;

                // TEMP: Create active plan
                $firm_plan = new FirmPlan;
                $firm_plan->firm_id = $firm->id;
                $firm_plan->plan_id = $plan->id;
                $firm_plan->order_plan_id = $order_plan->id;
                $firm_plan->is_frame_plan = $plan->is_frame_plan;
                $firm_plan->qty_per_month = 30*$order_plan->qty;
                $firm_plan->is_trial = $is_trial;

                if(property_exists($plan, 'firm_type_id'))
                    $firm_plan->firm_type_id = $plan->firm_type_id;

                // when to start plan
                // check current plan expiry if any to start the plan
                $fp_current_date_expiry = FirmPlan::where('firm_id', $firm->id)->where('plan_id', $plan->id)->max('date_expiry');
                if( $fp_current_date_expiry )
                  $firm_plan->date_start_from = $fp_current_date_expiry;
                else
                  $firm_plan->date_start_from = date('Y-m-d 00:00:00', strtotime( date('Y-m-d'). " + 1 days"));

                $expiry_string = $is_trial ? " + $trial_days days" : " + $request->duration_selected month";
                $firm_plan->date_expiry = date('Y-m-d 00:00:00', strtotime( $firm_plan->date_start_from. $expiry_string ));

                // $date_expiry = $is_trial ? Carbon::now()->addDays($trial_days) : Carbon::now()->addMonths($request->duration_selected)->addDays(1);
                // $firm_plan->date_expiry = $date_expiry;
                $firm_plan->save();

                $order->date_start_from = $firm_plan->date_start_from;
                $order->date_expiry = $firm_plan->date_expiry;
                $order->duration_selected = $request->duration_selected;
            }
            $order->amount = $total;
            $order->is_trial = $is_trial;

            $order->save();

            if($is_trial) {
              $user->is_trial_used = 1;
              $user->save();
            }

            // ======================================================
            /* Here we have selected plans data
            - save selected plans data in session
            - save plans data in orders and order_plans table
            - create a data to send to payments gateway
            - send request to payments gateway
            */
            // TODO: Create a FirmPlan for order
            // $order->createFramesOfPlans();
            DB::commit();
            return redirect('myplans');
        } catch (\Exception $e) {
            DB::rollback();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
