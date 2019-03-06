<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profiles';
    protected $fillable = [
        'user_id', 'name', 'corporation_id', 'bank_id', 'profile_text', 'music'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
