<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'social_network_type_id', 'token', 'avatar', 'name', 'social_profile_id', 'category'
    ];

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
