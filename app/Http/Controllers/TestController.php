<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\RandomEmail;
use App\Mail\FunnyEmail;
use Mail;

class TestController extends Controller
{


    public function mail(Request $request)
    {

      // return new FunnyEmail();
      $name = "Dino Cajic";
      $to = "731067022b-35793a@inbox.mailtrap.io";
      Mail::to($to)->send(new FunnyEmail($name));

    }
}
