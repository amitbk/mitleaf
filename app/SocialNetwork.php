<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function Firm()
    {
        return $this->belongsTo(Firm::class);
    }
    public function social_network_type()
    {
        return $this->belongsTo(SocialNetworkType::class);
    }
}
