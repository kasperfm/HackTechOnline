<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title', 'description', 'complete_message', 'reward_trust', 'reward_credits', 'corp_id',
        'type', 'objective', 'minimum_trust', 'hidden', 'chain_parent'
    ];

    public function corporation()
    {
        return $this->hasOne(Corporation::class, 'id', 'corp_id');
    }

    public function parent()
    {
        return $this->hasOne(Mission::class, 'id', 'chain_parent');
    }
}
