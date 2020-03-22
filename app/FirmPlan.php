<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirmPlan extends Model
{
    protected $dates = ['date_start_from', 'date_scheduled_upto', 'date_expiry'];

    public function frames()
    {
        return $this->hasMany(Frame::class);
    }
    public function firm()
    {
        return $this->belongsTo(Firm::class);
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
    public function firm_type()
    {
        return $this->belongsTo(FirmType::class);
    }
    public function order_plan()
    {
        return $this->belongsTo(OrderPlan::class);
    }
}
