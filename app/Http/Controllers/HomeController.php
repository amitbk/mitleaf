<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function test()
    {
      return \App\FirmPlan::where('firm_id', 1)->where('plan_id', 2)->max('date_expiry');
      $f = \App\Firm::find(1);
      return $f->orders->max('date_expiry');
    }
}
