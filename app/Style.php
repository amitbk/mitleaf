<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    public function templates()
    {
        return $this->belongsToMany(Template::class);
    }
}
