<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Corporation extends Model
{
    use CrudTrait;

    protected $fillable = [
        'owner_user_id', 'name', 'description', 'status', 'invite_key'
    ];

    protected $hidden = ['owner_user_id', 'invite_key'];

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_user_id');
    }

    public function members()
    {
        return $this->hasManyThrough(
            'App\Models\User',
            'App\Models\UserProfile',
            'corporation_id', // Foreign key on UserProfile table...
            'id', // Foreign key on User table...
            'id', // Local key on Corporation table...
            'user_id' // Local key on UserProfile table...
        );
    }
}
