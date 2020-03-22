<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialNetworkType extends Model
{
    public function social_networks()
    {
        return $this->hasMany(SocialNetwork::class);
    }
}
