<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLogin extends Model
{
    protected $fillable = [
        'user_id', 'last_date', 'last_ip'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
