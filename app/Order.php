<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function firm()
    {
        return $this->belongsTo(Firm::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }
    
}
