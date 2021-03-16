<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\FunnyEmail;
use App\Notifications\Marketers\YouArePartnerNow;
use Mail;

use App\Events\TestEvent;
use Softon\Sms\Facades\Sms;

use App\Notifications\Marketers\PaymentProcessed;

class TestController extends Controller
{


    public function mail(Request $request)
    {
      return env('MAIL_USERNAME');
      // return config('mail.username');
      // var_dump(openssl_get_cert_locations());die();
      // return new FunnyEmail();
      $name = "Dino Cajic";
      $to = "731067022b-35793a@inbox.mailtrap.io";
      // dd('/');
      return new FunnyEmail($name);
      Mail::to($to)->send(new FunnyEmail($name));
    }

    public function event()
    {
      $user = auth()->user();
      $order = \App\Order::find(3);
      $bill = \App\Bill::find(4);
      $referrar = \App\User::find(11);
      $user->notify( new YouArePartnerNow() );
      return "done";
      $to = "731067022b-35793a@inbox.mailtrap.io";
      event( new TestEvent($to, 'Amit') );
      return 'test event fired';
    }

    public function sms()
    {
      return Sms::send(['7020227842'],'sms.test',['user'=>'Amit', 'token' => 'TASAS'])->response();;
    }

    public function subscription()
    {
      return PaymentController::create_subscription();
    }

    public function webhook(Request $request)
    {
      slack('YES', '#general');
      $tag = new \App\Tag;
      $tag->name = $request->event ?? 'FAILED';
      $tag->desc = $request->payload ?? 'FAILED';

      $tag->save();
      return 'done';
    }
}
