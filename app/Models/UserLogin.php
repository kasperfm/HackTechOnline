<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLogin extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'last_date', 'last_ip'
    ];

    protected $dates = [
        'last_date'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
