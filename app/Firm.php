<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firm extends Model
{
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
      return $this->belongsTo(Image::class, 'logo_id');
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
