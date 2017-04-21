<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    protected $fillable = [
        'user_id', 'host_id', 'cpu_id', 'ram_id', 'hdd_id', 'inet_id'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function host(){
        return $this->hasOne('App\Models\Host', 'machine_id', 'host_id');
    }

    public function cpu(){
        return $this->hasOne('App\Models\GatewayHardware', 'id', 'cpu_id');
    }

    public function ram(){
        return $this->hasOne('App\Models\GatewayHardware', 'id', 'ram_id');
    }

    public function hdd(){
        return $this->hasOne('App\Models\GatewayHardware', 'id', 'hdd_id');
    }

    public function inet(){
        return $this->hasOne('App\Models\GatewayHardware', 'id', 'inet_id');
    }
}