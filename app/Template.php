<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    public function frames()
    {
        return $this->hasMany(Frame::class);
    }



    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function image()
    {
        return $this->belongsTo(Image::class);
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function firm_type()
    {
        return $this->belongsTo(FirmType::class);
    }

    public function styles()
    {
        return $this->hasMany(TemplateStyle::class);
    }
}
