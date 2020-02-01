<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagType extends Model
{
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
