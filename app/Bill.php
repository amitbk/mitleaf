<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{


  public function transaction_type()
  {
      return $this->belongsTo(TransactionType::class);
  }

  public function order()
  {
      return $this->belongsTo(Order::class);
  }

  public function user()
  {
      return $this->belongsTo(User::class);
  }
}
