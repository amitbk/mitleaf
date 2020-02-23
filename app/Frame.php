<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    protected $dates = ['schedule_on'];
    public function image()
    {
        return $this->belongsTo(Image::class);
    }
    public function firm_plan()
    {
        return $this->belongsTo(FirmPlan::class);
    }
    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
