<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function tag_type()
    {
        return $this->belongsTo(TagType::class);
    }

    public function templates()
    {
        return $this->belongsToMany(Template::class);
    }
    public function frames()
    {
        return $this->hasMany(Frame::class);
    }
    public function rules()
    {
        return $this->hasMany(Rule::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
