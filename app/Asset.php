<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    public function firm()
    {
        return $this->belongsTo(Firm::class);
    }
    public function asset_type()
    {
        return $this->belongsTo(AssetType::class);
    }
    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
