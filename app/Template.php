<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    public function frames()
    {
        return $this->hasMany(Frame::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
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
        return $this->hasMany(TemplateFirmType::class);
    }
    public function firm_types()
    {
        return $this->belongsToMany('App\FirmType', 'template_firm_types');
    }

    public function styles()
    {
        return $this->hasMany(TemplateStyle::class);
    }
}
