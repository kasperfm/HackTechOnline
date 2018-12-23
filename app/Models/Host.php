<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'online_state', 'game_ip', 'host_type', 'machine_id', 'ip_changed_at'
    ];

    protected $dates = [
        'ip_changed_at'
    ];

    public function machine(){
        if($this->host_type == 1){
            return $this->hasOne('App\Models\Server', 'id', 'machine_id')->first();
        }else{
            return $this->hasOne('App\Models\Gateway', 'id', 'machine_id')->first();
        }
    }

    public function scopeIsOnline($query){
        return $query->where('online_state', 1);
    }

    public function scopeIsOffline($query){
        return $query->where('online_state', 0);
    }

    public function scopeGateway($query){
        return $query->where('host_type', 2);
    }

    public function scopeServer($query){
        return $query->where('host_type', 1);
    }
}
