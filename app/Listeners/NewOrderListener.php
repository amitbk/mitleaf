<?php

namespace App\Listeners;

use App\Events\NewOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewOrderListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewOrder  $event
     * @return void
     */
    public function handle(NewOrder $event)
    {
        // $event->order

        // Sale entry
        $bill = new \App\Bill;
        $bill->user_id = $event->order->user->id;
        $bill->amount = $event->order->amount;
        $bill->order_id = $event->order->id;
        $bill->creditor_id = $event->order->user->id;
        $bill->debtor_id = 1;
        $bill->transaction_type_id = 1;
        $bill->firm_id = $event->order->firm->id;
        $bill->save();

        // Service entry
        $bill = new \App\Bill;
        $bill->user_id = $event->order->user->id;
        $bill->amount = $event->order->amount;
        $bill->order_id = $event->order->id;
        $bill->creditor_id = 3;
        $bill->debtor_id = $event->order->user->id;
        $bill->transaction_type_id = 3;
        $bill->firm_id = $event->order->firm->id;
        $bill->save();

        // Commission entry
        $bill = new \App\Bill;
        $bill->user_id = $event->order->user->id;
        $bill->amount = $event->order->amount;
        $bill->order_id = $event->order->id;
        $bill->creditor_id = 1;
        $bill->debtor_id = 4;
        $bill->transaction_type_id = 4;
        $bill->firm_id = $event->order->firm->id;
        $bill->save();

        // notifications and other
    }
}
