<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetType extends Model
{
    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
    public function templates()
    {
        return $this->hasMany(Template::class);
    }
}
