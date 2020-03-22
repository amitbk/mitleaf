<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public function firm_plans()
    {
        return $this->hasMany(FirmPlan::class);
    }
    public function templates()
    {
        return $this->hasMany(Template::class);
    }
    public function order_plans()
    {
        return $this->hasMany(OrderPlan::class);
    }
}
