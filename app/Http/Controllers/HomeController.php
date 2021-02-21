<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SocialMedia\GraphController;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookSDKException;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Plan;
use App\FirmType;
use Auth;

class HomeController extends Controller
{
    // public $api;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware(function ($request, $next) use ($fb) {
        //     $fb->setDefaultAccessToken(Auth::user()->facebook_token());
        //     $this->api = $fb;
        //     return $next($request);
        // });

        // dd($this);
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

    public function sessions()
    {
      return session()->all();
    }
    public function test()
    {
      // $img = \App\Image::find(1);
      // return $img->create_thumbnail($img->url);
      $aa = app(GraphController::class, [Facebook::class] );
      // $cc = app()->bind(GraphController::class, Facebook::class);
      dd($aa);
      // $this->api = app()->make(Facebook::class);
      // return $this->app->instance(Facebook::class);
      $gc = (new GraphController( $this->api ) )->update_pages();
      dd($gc);
      $user = Auth::user();
      return $user->facebook_token();

      $firm = \App\Firm::find(2);
      return $firm->active_plans();


      // return \App\FirmPlan::where('firm_id', 1)->where('plan_id', 2)->max('date_expiry');
      // $f = \App\Firm::find(1);
      // return $f->orders->max('date_expiry');
    }
}
