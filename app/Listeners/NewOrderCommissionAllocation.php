<?php

namespace App\Listeners;

use App\Events\NewOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewOrderCommissionAllocation
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
      // add refferal commission
      $referrer = $event->order->user->referrer;
      $commissions = $this->calculateCommission($event->order->amount);
      $users = [$referrer, $referrer->referrer ?? null, $referrer->referrer->referrer ?? null];

      foreach ($users as $key => $user) {
        if($user == null) continue;

        // $wallet = new \App\Wallet;
        // $wallet->user_id = $user->id;
        // $wallet->amount = $commissions[$key];
        // $wallet->order_id = $event->order->id;
        // $wallet->save();

        $bill = new \App\Bill;
        $bill->user_id = $user->id;
        $bill->amount = $commissions[$key];
        $bill->order_id = $event->order->id;
        $bill->creditor_id = 4;
        $bill->debtor_id = $user->id;
        $bill->transaction_type_id = 4;
        $bill->firm_id = $event->order->firm->id;
        $bill->save();

      }
    }

    public function calculateCommission($amount, $commission = [40, 35, 20])
    {
      //$commision = [40, 30, 0];
      $amount1 = $amount*$commission[0]/100;
      $amount2 = $amount1*$commission[1]/100;
      $amount3 = $amount2*$commission[2]/100;

      $commission1 = $amount1-$amount2;
      $commission2 = $amount2-$amount3;
      $commission3 = $amount3;

      return [$commission1, $commission2, $commission3];
    }
}
