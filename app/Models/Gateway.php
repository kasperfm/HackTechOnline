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
        return $this->hasOne('App\Models\Host', 'id', 'host_id');
    }

    public function cpu(){
        return $this->hasOne(GatewayHardware::class, 'id', 'cpu_id');
    }

    public function ram(){
        return $this->hasOne(GatewayHardware::class, 'id', 'ram_id');
    }

    public function hdd(){
        return $this->hasOne(GatewayHardware::class, 'id', 'hdd_id');
    }

    public function inet(){
        return $this->hasOne(GatewayHardware::class, 'id', 'inet_id');
    }
}
