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

    public function scopeAttachedTo($query, $host){
        return $query->where('host_id', $host);
    }

    public function scopeOpen($query, $portNumber){
        return $query->where('open_port', $portNumber)->where('active', 1);
    }

    public function scopeWithService($query, $serviceID){
        return $query->where('service_id', $serviceID);
    }
}
