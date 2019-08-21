<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Server
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $host_id
 * @property int $cpu_id
 * @property int $ram_id
 * @property int $hdd_id
 * @property int $inet_id
 * @property string|null $root_password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ServerHardware $cpu
 * @property-read \App\Models\ServerHardware $hdd
 * @property-read \App\Models\Host $host
 * @property-read \App\Models\ServerHardware $inet
 * @property-read \App\Models\ServerHardware $ram
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereCpuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereHddId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereHostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereInetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereRamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereRootPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereUserId($value)
 * @mixin \Eloquent
 */
class Server extends Model
{
    protected $fillable = [
        'user_id', 'host_id', 'cpu_id', 'ram_id', 'hdd_id', 'inet_id', 'root_password',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function host(){
        return $this->hasOne('App\Models\Host', 'id', 'host_id');
    }

    public function cpu(){
        return $this->hasOne('App\Models\ServerHardware', 'id', 'cpu_id');
    }

    public function ram(){
        return $this->hasOne('App\Models\ServerHardware', 'id', 'ram_id');
    }

    public function hdd(){
        return $this->hasOne('App\Models\ServerHardware', 'id', 'hdd_id');
    }

    public function inet(){
        return $this->hasOne('App\Models\ServerHardware', 'id', 'inet_id');
    }
}
