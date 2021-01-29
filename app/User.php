<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'mobile', 'email', 'password', 'referrer_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function firms()
    {
        return $this->belongsToMany(Firm::class)->withTimestamps();
    }

    public function avatar()
    {
        return $this->belongsTo(Image::class, 'avatar_id');
    }

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function network()
    {
        return $this->hasMany(Network::class);
    }

    public function templates()
    {
        return $this->hasMany(Template::class);
    }

    /**
     * A user has a referrer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id', 'id');
    }

    /**
     * A user has many referrals.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referrals()
    {
        return $this->hasMany(User::class, 'referrer_id', 'id');
    }

    // public function routeNotificationFor($for) {
    //     switch ($for) {
    //       case 'sms':
    //         return $this->mobile;
    //         break;
    //
    //       case 'sms':
    //         return $this->email;
    //         break;
    //
    //       default:
    //         return null;
    //         break;
    //     }
    // }
}
