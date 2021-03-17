<?php

namespace App\Notifications\Clients;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Channels\SmsInit;
use App\Channels\SmsChannel;

class NewOrder extends Notification implements ShouldQueue
{
    use Queueable;
    public $order;
    public $bill;
    public $firm;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order, $bill)
    {
      $this->order = $order;
      $this->firm = $order->firm;
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
            ->subject("💡 New Order of  ".config('app.currency')." ".$this->order->amount." completed successfully on ".config('app.name')." 🖐")
            ->markdown('emails.clients.new_order',
                      ['self' => $notifiable, 'firm' => $this->firm, 'order' => $this->order, 'bill' => $this->bill]
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
      return (new SmsInit())->withView('sms.clients.new_order', ['self' => $notifiable, 'firm' => $this->firm, 'order' => $this->order, 'bill' => $this->bill]);
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
