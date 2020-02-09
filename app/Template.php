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

    public function template_firm_types()
    {
        return $this->hasMany(TemplatesFirmType::class);
    }
    public function firm_types()
    {
        return $this->hasManyThrough('App\Firm', 'App\TemplateFirmType');
    }

    public function styles()
    {
        return $this->hasMany(TemplateStyle::class);
    }
}
