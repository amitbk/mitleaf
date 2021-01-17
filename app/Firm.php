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
      return $this->belongsToMany(User::class)->withTimestamps();
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
    public function frames()
    {
        return $this->hasManyThrough('App\Frame', 'App\FirmPlan');
    }
    public function orders()
    {
      return $this->hasMany(Order::class);
    }

    public function date_expiry()
    {
      $date = date('Y-m-d 00:00:00', strtotime( date('Y-m-d'). " + 0 days"));
      // return $date;
      // return $this->whereHas('plans', function($q)
      //         {
      //             $date = date('Y-m-d 23:59:59', strtotime( date('Y-m-d'). " + 7 days"));
      //         })->get();

      return $r = \App\FirmPlan::where('firm_id', $this->id)
                 ->whereDate('date_start_from', '<=',  date('Y-m-d 23:59:59') )
                 ->whereDate('date_expiry', '>=', $date )->get();
      return $this->plans->whereDate('date_expiry', '>', $date );
      // $frames = Frame::whereNull('image_id')
      //               ->where('error_count', '<=', 3)
      //               ->whereDate('schedule_on', '<=', $date )
      //               ->limit(30)->get();

      $date = $this->plans->max('date_expiry');
      return $date ? $date->format('d M, Y') : '';
    }
}
