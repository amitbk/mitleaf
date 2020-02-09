<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirmType extends Model
{
    public function firms()
    {
        return $this->hasMany(Firm::class);
    }
    public function templates()
    {
        return $this->hasManyThrough('App\Template', 'App\TemplateFirmType');
    }
    public function firm_plans()
    {
        return $this->hasMany(FirmPlan::class);
    }
}
