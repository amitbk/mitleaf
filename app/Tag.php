<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function templates()
    {
        return $this->belongsToMany(Template::class);
    }
}
