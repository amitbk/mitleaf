<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    public function frames()
    {
        return $this->hasMany(Frame::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function firm()
    {
        return $this->belongsTo(Firm::class);
    }
}
