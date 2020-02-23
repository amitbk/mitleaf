<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\OrderPlan;
use App\FirmPlan;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create_frames($id)
    {
        $order = Order::find($id);
        $order->create_frames_of_plans();
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
        // TEMP
        // CREATE order
        $user = Auth::user();
        $firm = $user->firms()->first();
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
            $order_plan->save();

            $total += $plan->rate*$order_plan->qty;

            // TEMP: Create active plan
            $firm_plan = new FirmPlan;
            $firm_plan->firm_id = $firm->id;
            $firm_plan->plan_id = $plan->id;
            $firm_plan->order_plan_id = $order_plan->id;
            $firm_plan->is_frame_plan = $plan->is_frame_plan;
            $firm_plan->qty_per_month = 30*$order_plan->qty;

            if(property_exists($plan, 'firm_type_id'))
                $firm_plan->firm_type_id = $plan->firm_type_id;

            $firm_plan->date_scheduled = Carbon::now()->addDays(1);
            $firm_plan->date_expiry = Carbon::now()->addMonths($request->duration_selected)->addDays(1);
            $firm_plan->save();
        }
        $order->amount = $total;
        $order->save();

        // return $total;

        // ======================================================
        /* Here we have selected plans data
        - save selected plans data in session
        - save plans data in orders and order_plans table
        - create a data to send to payments gateway
        - send request to payments gateway
        */

        // TODO: Create a FirmPlan for order
        $order->createFramesOfPlans();

        return redirect('myplans');
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
