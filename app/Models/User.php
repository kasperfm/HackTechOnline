<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'userlevel'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function profile(){
        return $this->hasOne('App\Models\UserProfile');
    }

    public function logins(){
        return $this->hasOne('App\Models\UserLogin');
    }

    public function gateway(){
        return $this->hasOne(Gateway::class);
    }

    public function bankAccount(){
        return $this->hasOne('App\Models\BankAccount');
    }

    public function servers(){
        return $this->hasMany('App\Models\Server');
    }

    public function apps(){
        return $this->hasMany('App\Models\UserApp');
    }

    public function trustPoints(){
        return $this->hasMany(UserTrust::class);
    }
}
