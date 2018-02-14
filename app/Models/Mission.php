<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    public $timestamps = false;

    public function corporation()
    {
        return $this->hasOne(Corporation::class, 'id', 'corp_id');
    }

    public function parent()
    {
        return $this->hasOne(Mission::class, 'id', 'chain_parent');
    }
}
