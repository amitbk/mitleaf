<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirmPlan extends Model
{
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
}
