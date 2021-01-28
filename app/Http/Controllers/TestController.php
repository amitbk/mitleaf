<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\RandomEmail;
use App\Mail\FunnyEmail;
use Mail;

use App\Events\TestEvent;

class TestController extends Controller
{


    public function mail(Request $request)
    {
      // return new FunnyEmail();
      $name = "Dino Cajic";
      $to = "731067022b-35793a@inbox.mailtrap.io";
      Mail::to($to)->send(new FunnyEmail($name));
    }

    public function event()
    {
      $to = "731067022b-35793a@inbox.mailtrap.io";
      event( new TestEvent($to, 'Amit') );
      return 'test event fired';
    }
}
