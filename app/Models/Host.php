<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Host
 *
 * @property int $id
 * @property int $online_state
 * @property string $game_ip
 * @property int $host_type
 * @property int $machine_id
 * @property \Illuminate\Support\Carbon|null $ip_changed_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Host gateway()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Host isOffline()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Host isOnline()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Host newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Host newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Host query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Host server()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Host whereGameIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Host whereHostType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Host whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Host whereIpChangedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Host whereMachineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Host whereOnlineState($value)
 * @mixin \Eloquent
 */
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
