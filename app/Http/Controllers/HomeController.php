<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Plan;
use App\FirmType;

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
        $plans = Plan::where('is_active',1)->where('is_post_plan',1)->get();
        $firm_types = FirmType::where('is_active',1)->get();
        return view('home', compact('plans') )->with('firm_types', $firm_types);
    }

    public function test()
    {
      $img = \App\Image::find(1);
      return $img->create_thumbnail($img->url);


      // return \App\FirmPlan::where('firm_id', 1)->where('plan_id', 2)->max('date_expiry');
      // $f = \App\Firm::find(1);
      // return $f->orders->max('date_expiry');
    }
}
