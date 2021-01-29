<?php

namespace App\Channels;
use Softon\Sms\Facades\Sms;
use Illuminate\Notifications\Notification;

class SmsChannel
{
    public function send ($notifiable, Notification $notification) {
      $sms = $notification->toSms($notifiable);
      // $reciever = $notifiable->routeNotificationFor('sms');

      return Sms::send( [ $notifiable->mobile ], $sms->getView(), $sms->getParams() )->response();;
    }
}
