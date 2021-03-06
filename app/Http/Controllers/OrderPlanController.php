<?php

namespace App\Http\Controllers;

use Auth;
use App\Order;
use App\OrderPlan;
use App\FirmPlan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderPlan  $orderPlan
     * @return \Illuminate\Http\Response
     */
    public function show(OrderPlan $orderPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderPlan  $orderPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderPlan $orderPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderPlan  $orderPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderPlan $orderPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderPlan  $orderPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderPlan $orderPlan)
    {
        //
    }
}
