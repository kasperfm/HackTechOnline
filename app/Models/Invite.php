<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = [
        'key', 'user_id', 'used'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeAvailable($query)
    {
        return $query->where('used', 0);
    }
}
