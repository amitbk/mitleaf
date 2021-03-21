<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Notifications\Clients\OrderEndReminder as OrderEndReminderNf;
use App\Notifications\Clients\OrderEnded as OrderEndedNf;
use Illuminate\Support\Facades\Notification;

class OrderEndReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:order_end_reminder {days}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send order end reminder to clients';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $days = $this->argument('days');
        $date_only = date('Y-m-d');
        $date = date('Y-m-d', strtotime($date_only . " + $days days") );

        // get orders, whose expiry date is after $days and reminder is not sent today ($date_only)
        $orders = \App\Order::whereDate('date_expiry', '=', $date)
                              ->where(function ($q) use($date_only) {
                                   $q->whereNull('date_order_end_reminder_sent')
                                     ->orWhereDate('date_order_end_reminder_sent', '!=', $date_only );
                               })->get();

        $count = 0;
        foreach ($orders as $key => $order) {

          if($days == 0)
            Notification::send($order->firm->users, new OrderEndedNf($order));
          else
            Notification::send($order->firm->users, new OrderEndReminderNf($order));

          $order->date_order_end_reminder_sent = date('Y-m-d H:i:s');
          $order->save();
          $count++;
        }
        echo "CRON: $count reminder mails sent for $days days.";
    }
}
