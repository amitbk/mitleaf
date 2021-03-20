<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Firm extends Model
{
    protected $fillable = [
        'name', 'desc', 'address',
    ];
    protected $appends  = [ 'logo' ];
    public function users()
    {
      return $this->belongsToMany(User::class)->withTimestamps();
    }
    public function owner()
    {
      return $this->belongsTo(User::class);
    }
    public function social_networks()
    {
      return $this->hasMany(SocialNetwork::class);
    }

    public function assets()
    {
      return $this->hasMany(Asset::class);
    }
    public function getLogoAttribute()
    {
        $asset = $this->assets->where('asset_type_id',1)->first();
        return $asset ? ($asset->image ? $asset->image->url :  null) : null ;
    }
    public function strip()
    {
        $asset = $this->assets->where('asset_type_id',3)->first();
        return $asset ? ($asset->image ? $asset->image->url: null) : null ;
    }

    public function firm_type()
    {
      return $this->belongsTo(FirmType::class);
    }

    public function plans()
    {
      return $this->hasMany(FirmPlan::class);
    }
    public function posts()
    {
        return $this->hasManyThrough('App\Post', 'App\FirmPlan');
    }
    public function orders()
    {
      return $this->hasMany(Order::class);
    }

    public function active_plans()
    {
      return $this->plans()->where('date_start_from', '<=', Carbon::now())
                           ->where('date_expiry', '>=', Carbon::now())->get();
    }

    public function future_plans()
    {
      return $this->plans()->where('date_expiry', '>=', Carbon::now())->get();
    }

    public function date_expiry()
    {
      $date = $this->future_plans()->max('date_expiry');
      return $date ? $date->format('d M, Y') : '';
    }
}
