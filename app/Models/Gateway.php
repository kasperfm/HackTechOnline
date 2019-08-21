<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Gateway
 *
 * @property int $id
 * @property int $user_id
 * @property int $host_id
 * @property int $cpu_id
 * @property int $ram_id
 * @property int $hdd_id
 * @property int $inet_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\GatewayHardware $cpu
 * @property-read \App\Models\GatewayHardware $hdd
 * @property-read \App\Models\Host $host
 * @property-read \App\Models\GatewayHardware $inet
 * @property-read \App\Models\GatewayHardware $ram
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gateway newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gateway newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gateway query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gateway whereCpuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gateway whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gateway whereHddId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gateway whereHostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gateway whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gateway whereInetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gateway whereRamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gateway whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gateway whereUserId($value)
 * @mixin \Eloquent
 */
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

    public function hardware(){
        $hardwareList = [$this->cpu_id, $this->ram_id, $this->hdd_id, $this->inet_id];
        return GatewayHardware::whereIn('id', $hardwareList);
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
