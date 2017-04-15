<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserApp extends Model
{
    protected $fillable = [
        'user_id', 'application_id', 'installed'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function application(){
        return $this->belongsTo('App\Models\Application');
    }

    public function scopeInstalled($query){
        return $query->where('installed', 1);
    }

    public function scopeOwnedBy($query, $owner){
        return $query->where('user_id', $owner);
    }
}
