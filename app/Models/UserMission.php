<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserMission extends Model
{
    use SoftDeletes;

    protected $table = 'user_missions';

    protected $fillable = [
        'user_id',
        'mission_id',
        'done'
    ];

    public function mission()
    {
        return $this->hasOne(Mission::class, 'id', 'mission_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
