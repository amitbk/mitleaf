<?php

namespace App\Notifications\Marketers;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Channels\SmsInit;
use App\Channels\SmsChannel;

class PaymentProcessed extends Notification
{
    use Queueable;
    public $bill;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($bill)
    {
      $this->bill = $bill;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['mail'];
        return ['mail', SmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("✌ ".$notifiable->name.", Your payment of ".config('app.currency')." ".$this->bill->amount." is processed!" )
            ->markdown('emails.marketers.payment_processed',
                      ['self' => $notifiable, 'bill' => $this->bill]
                    );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return App\Channels\SmsInit
     */
    public function toSms($notifiable)
    {
      return (new SmsInit())->withView('sms.marketers.payment_processed', ['self' => $notifiable, 'bill' => $this->bill]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
