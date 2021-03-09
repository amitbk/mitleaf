<?php

namespace App\Notifications\Clients;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Channels\SmsInit;
use App\Channels\SmsChannel;

class NewFirmCreated extends Notification implements ShouldQueue
{
    use Queueable;
    public $firm;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($firm)
    {
      $this->firm = $firm;
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
            ->markdown('emails.clients.new_firm_created',
                      ['self' => $notifiable, 'firm' => $this->firm]
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
      return (new SmsInit())->withView('sms.clients.new_firm_created', ['self' => $notifiable, 'firm' => $this->firm]);
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
