<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\OrderPlan;
use App\FirmPlan;
use App\Firm;
use DB;

use App\Events\NewOrder;

class OrderController extends Controller
{
      public function __construct()
      {
          $this->middleware('auth');//->except('payment_callback');
          $this->middleware('admin')->only(['admin']);
      }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();
      // $orders = Order::latest()->paginate(10);
      $orders = $user->orders()->latest()->paginate(10);
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

        // Steps:
        // 1. Save order data with order_plan
        // 2. initiate payment
        // 3. Send to payment page

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
                $order_plan->qty = $plan->slab_selected;
                $order_plan->save();
                $total += $plan->finalRate;

            }
            $order->amount = $total;
            $order->is_trial = $is_trial;
            $order->status = 0;
            $order->duration_selected = $request->duration_selected;

            $order->save();

            if($is_trial) {
              $user->is_trial_used = 1;
              $user->save();
            }

            // ======================================================
            /* Here we have selected plans data
            - save plans data in orders and order_plans table - done
            - create a data to send to payments gateway
            - send request to payments gateway
            */


            // pay online
            $razorpay_order = PaymentController::create_order(['receipt_id'=> $order->id, 'amount' => $order->amount]);
            $order->payments_meta = ['razorpay_order_id' => $razorpay_order->id];
            $order->save();
            DB::commit();

            $user_data = array('name' => $user->name, 'email' => $user->email, 'contact' => $user->mobile);
            return view('order.payment_capture')
                  ->with('user', $user_data)
                  ->with('firm', getFirm())
                  ->with('razorpay_order_id', $razorpay_order->id)
                  ->with('amount',$razorpay_order->amount)
                  ->with('order_id',$order->id)
                  ->with('key',PaymentController::getKey());


            return redirect('myplans');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
        }

    }

    public function payment_callback(Request $request)
    {
      PaymentController::verify_signature($request);
      $order = Order::where('payments_meta->razorpay_order_id', $request->razorpay_order_id)
                ->first();
      // $order = Order::find(1);
      $firm = $order->firm;
      $is_trial = $order->is_trial;
      foreach ($order->plans as $order_plan) {

          $plan = $order_plan->plan;

          // TODO: Create active plan
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
          // expiry shoul be greater than today
          $is_expiry_greater_than_today = !!$fp_current_date_expiry && $fp_current_date_expiry > date('Y-m-d 00:00:00');
          if( $is_expiry_greater_than_today )
            $firm_plan->date_start_from = $fp_current_date_expiry;
          else
            $firm_plan->date_start_from = date('Y-m-d 00:00:00', strtotime( date('Y-m-d'). " + 1 days"));

          $expiry_string = $is_trial ? " + $trial_days days" : " + $order->duration_selected month";
          $date_expiry = date('Y-m-d 00:00:00', strtotime( $firm_plan->date_start_from. $expiry_string ));

          $firm_plan->date_expiry = $date_expiry;
          $firm_plan->save();

          $order->date_start_from = $firm_plan->date_start_from;
          $order->date_expiry = $firm_plan->date_expiry;
      }
      $order->status = 1;
      $order->save();

      // event(new NewOrder($order));


      return ['payment_success' => true, 'order' => $order];
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
