<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTrust extends Model
{
    protected $table = 'user_trust';

    protected $fillable = ['corp_id', 'user_id', 'trust'];

    public function corporation()
    {
        return $this->hasOne(Corporation::class, 'id', 'corp_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
