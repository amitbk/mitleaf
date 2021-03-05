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

use Image;

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
        $this->middleware('admin')->only( ['sessions', 'test'] );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $plans = Plan::where('is_active',1)->where('is_post_plan',1)->get();
        $firm_types = FirmType::where('is_active',1)->get();
        return view('home', compact('plans') )->with('firm_types', $firm_types)->with('user', $user);
    }

    public function sessions()
    {
      return session()->all();
    }
    public function test()
    {

      

      $img = Image::make('images\assets\bg.png');
      // use callback to define details
      // $img->text('FLYMIT.', 120, 100);
      $img->text('flymit', 0, 0, function($font) {
          // $font->file('foo/bar.ttf');
          $font->size(24);
          $font->color('#fdf6e3');
          $font->align('center');
          $font->valign('top');
          // $font->angle(45);
      });

      $text = array('name'=> 'FLYMIT', 'x_left' => '10', 'y_left' => '10' , 'size' => '50',  'color' => '000000',  'angle' => '0', 'font' => public_path('fonts/rubik.ttf') );
      $img->text($text['name'], $text['x_left'], $text['y_left'], function($font) use($text) {
						$font->file($text['font']);
						$font->size($text['size']);
						$font->color($text['color']);
            $font->align('center');
            $font->valign('top');
						$font->angle($text['angle']);
					});

      $img->save('images/assets/bg1.png');

      dd('Done');
      return \App\Post::where('firm_plan_id', 1)->whereNotNull('template_id')->pluck('template_id')->toArray();
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
