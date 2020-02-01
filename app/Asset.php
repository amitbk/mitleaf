<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    public function image()
    {
        return $this->belongsTo(Image::class);
    }
    public function asset_types()
    {
        return $this->belongsTo(AssetType::class);
    }
    public function firms()
    {
        return $this->belongsTo(Firm::class);
    }
}
