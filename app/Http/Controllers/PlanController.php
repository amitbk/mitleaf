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
        $firms = auth()->user()->firms;
        return view('plans.index', compact('plans'), compact('firm_types') )->withFirms($firms);
    }

    public function myplans()
    {
        $user = Auth::user();
        $firm = $user->firms()->first();
        if($firm == null)
        {
            flash("You don't have firm added yet, please add a firm.", 'danger');
            return redirect()->route('firms.index');
        }
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
