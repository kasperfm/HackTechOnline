<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionData extends Model
{
    protected $table = 'mission_datas';
    public $timestamps = false;

    public function mission()
    {
        return $this->hasOne(Mission::class, 'id', 'mission_id');
    }
}
