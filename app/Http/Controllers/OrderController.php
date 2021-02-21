<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\OrderPlan;
use App\FirmPlan;
use App\Post;
use App\Firm;
use App\Event;
use Carbon\Carbon;
use DB;

use App\Events\NewOrder;

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

    public function create_posts($id)
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
                    // create posts for each event
                    foreach ($events as $event) {


                        // we should not create duplicate post for 1 event
                        // so-> find if post is already created or not for this event and firm combination
                        // nested query in laravel
                        $firm_id = $firm_plan->firm->id;
                        $post = Post::whereHas('firm_plan', function($q) use ($firm_id)
                                {
                                    $q->where('firm_id', $firm_id);
                                })->where('event_id', $event->id)->first();

                        if(!$post)
                        {
                            $post = new Post;
                            $post->schedule_on = $event->date;
                            $post->firm_plan_id = $firm_plan->id;
                            $post->event_id = $event->id;
                            $post->content = $event->desc;
                            $post->firm_id = $firm_plan->firm_id;
                            $post->save();
                            $firm_plan->date_scheduled_upto = $post->schedule_on;
                        }
                    }
                }
                else
                if( !in_array ( $firm_plan->plan_id, [1,3] ) )
                {
                  // var_dump("<br>2-", $firm_plan->plan_id, !in_array ( $firm_plan->plan_id, [1,3]  ) );

                    // find $posts having ->scheduled_on < $firm_plan->date_start_from
                    $is_posts_created = false;
                    if(!$is_posts_created)
                    {
                        // var_dump("<pre>",$firm_plan);die();
                        $days_interval = 30/$firm_plan->qty_per_month;
                        $start_day = $firm_plan->date_start_from;
                        $next_day = $firm_plan->date_start_from;

                        if($firm_plan->date_scheduled_upto != null)
                        {
                            // if some posts already created upto 'date_scheduled_upto' date
                            $next_day = $firm_plan->date_scheduled_upto;
                            $next_day->addDays($days_interval);
                        }

                        // create post if $next_day < $firm_plan->date_expiry
                        while($next_day <= $firm_plan->date_expiry)
                        {
                            $post = new Post;
                            $post->schedule_on = $next_day;
                            $post->firm_plan_id = $firm_plan->id;
                            $post->firm_id = $firm_plan->firm_id;
                            $post->save();
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

            // check if trial selected
            $is_trial = 0;
            $trial_days = 10;
            if($request->duration_selected == 0) {
              // trial can be selected only if not used before
              $user->is_trial_used ? $request->duration_selected = 3 : $is_trial = 1;
            }

            // discount if plan selected for a year
            $discount = $request->duration_selected == 12 ? config('amit.yearDiscount') : 0;

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
                $order_plan->rate = $plan->finalRate;
                // $order_plan->rate = $discount > 0 ? $plan->rate - ($plan->rate*$discount/100) : $plan->rate ;
                $order_plan->qty = $plan->slab_selected;
                // $order_plan->is_trial = $is_trial;
                $order_plan->save();

                // $total += $plan->finalRate*$order_plan->qty;
                $total += $plan->finalRate;

                // TEMP: Create active plan
                $firm_plan = new FirmPlan;
                $firm_plan->firm_id = $firm->id;
                $firm_plan->plan_id = $plan->id;
                $firm_plan->order_plan_id = $order_plan->id;
                $firm_plan->is_post_plan = $plan->is_post_plan;
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
            // $order->createPostsOfPlans();

            event(new NewOrder($order));

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
