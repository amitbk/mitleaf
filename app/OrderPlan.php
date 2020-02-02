<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPlan extends Model
{
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
