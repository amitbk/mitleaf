<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $dates = ['date_start_from', 'date_expiry'];

    public function plans()
    {
        return $this->hasMany(OrderPlan::class);
    }
    public function firm_plans()
    {
        return $this->hasManyThrough(FirmPlan::class, OrderPlan::class);
    }

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }


    public function firm()
    {
        return $this->belongsTo(Firm::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function create_posts_of_plans($days = 30)
    {
        $order_plans = $this->plans;

        var_dump("hello");die();
        return "ok";
    }
}
