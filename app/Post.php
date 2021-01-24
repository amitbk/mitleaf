<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // protected $dateFormat = 'd';
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
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // public function getScheduleOnFormatAttribute($value)
    // {
    //     return $this->schedule_on->format('d,m Y H:i:s a');
    // }
}
