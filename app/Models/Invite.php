<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use CrudTrait;

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
