<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firm extends Model
{
    protected $fillable = [
        'name', 'desc', 'address',
    ];
    public function users()
    {
      return $this->belongsToMany(User::class);
    }
    public function social_networks()
    {
      return $this->hasMany(SocialNetwork::class);
    }

    public function assets()
    {
      return $this->hasMany(Asset::class);
    }
    public function logo()
    {
        $asset = $this->assets->where('asset_type_id',1)->first();
        return $asset ? $asset->image->url : null ;
    }
    public function strip()
    {
        $asset = $this->assets->where('asset_type_id',3)->first();
        return $asset ? $asset->image->url : null ;
    }

    public function firm_type()
    {
      return $this->belongsTo(FirmType::class, 'logo_id');
    }

    public function plans()
    {
      return $this->hasMany(FirmPlan::class);
    }
    public function frames()
    {
        return $this->hasManyThrough('App\Frame', 'App\FirmPlan');
    }
    public function orders()
    {
      return $this->hasMany(Order::class);
    }
}
