<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    public function frames()
    {
        return $this->hasMany(Frame::class);
    }
    public function styles()
    {
        return $this->belongsToMany(Style::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function image()
    {
        return $this->belongsTo(Image::class);
    }
    public function asset_type()
    {
        return $this->belongsTo(AssetType::class);
    }
}
