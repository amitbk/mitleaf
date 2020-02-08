<?php

namespace App\Http\Controllers;

use App\Plan;
use App\FirmType;
use App\Order;
use App\OrderPlan;
use App\FirmPlan;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class PlanController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::where('is_active',1)->get();
        $firm_types = FirmType::where('is_active',1)->get();
        return view('plans.index', compact('plans'), compact('firm_types') );
    }

    public function myplans()
    {
        $user = Auth::user();
        $firm = $user->firms()->first();
        $plans = $firm->plans;

        return view('plans.myplans', compact('plans') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // test
        return redirect()->route('firms.index');
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


        // return redirect()->route('firms.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
