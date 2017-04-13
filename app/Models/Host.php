<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'online_state', 'game_ip', 'host_type', 'machine_id'
    ];

    public function scopeIsOnline($query){
        return $query->where('online_state', 1);
    }

    public function scopeIsOffline($query){
        return $query->where('online_state', 0);
    }

    public function scopeGateway($query){
        return $query->where('host_type', 0);
    }

    public function scopeServer($query){
        return $query->where('host_type', 1);
    }
}
