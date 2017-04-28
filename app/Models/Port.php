<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    public $timestamps = false;

    public function host(){
        return $this->hasOne('App\Models\Host');
    }

    public function service(){
        return $this->hasOne('App\Models\Service');
    }

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function scopeBelongsTo($query, $host){
        return $query->where('host_id', $host);
    }
}
