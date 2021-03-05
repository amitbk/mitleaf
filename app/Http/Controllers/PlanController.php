<?php

namespace App\Http\Controllers;

use App\Plan;
use App\FirmType;
use App\Order;
use App\OrderPlan;
use App\FirmPlan;
use App\Firm;

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
    public function index(Request $request)
    {
        $user = Auth::user();
        $plans = Plan::where('is_active',1)->get();
        $firm_types = FirmType::where('is_active',1)->get();
        $firms = auth()->user()->firms;
        $firm = Firm::find($request->firm_id);

        if($request->wantsJson())
          return ['plans' => $plans, 'firm_types' => $firm_types, 'firms' => $firms];

        return view('plans.index', compact('plans'), compact('firm_types', 'user') )
                    ->withFirms($firms)->with('firmId', $request->firm_id ?? '0')
                    ->with('yearDiscount', config('amit.yearDiscount'))->with('firm', $firm );
    }

    public function myplans(Request $request)
    {
        $user = Auth::user();
        $firms = $user->firms;
        if($firms == null)
        {
            flash("You don't have firm added yet, please add a firm.", 'danger');
            return redirect()->route('firms.index');
        }
        return view('plans.myplans', compact('firms') )->with('firm_id', $request->firm);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // test
        return redirect('/home');
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
