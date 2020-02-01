<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    public function firm()
    {
        return $this->belongsTo(Firm::class);
    }
    public function rule()
    {
        return $this->belongsTo(Rule::class);
    }
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
    public function template()
    {
        return $this->belongsTo(Template::class);
    }
    public function image()
    {
        return $this->belongsTo(Image::class);
    }
    
}
