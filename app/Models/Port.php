<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Port
 *
 * @property int $id
 * @property int $host_id
 * @property int $service_id
 * @property int $open_port
 * @property int $active
 * @property-read \App\Models\Host $host
 * @property-read \App\Models\Service $service
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Port active()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Port attachedTo($host)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Port newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Port newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Port open($portNumber)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Port hasPort($portNumber)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Port query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Port whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Port whereHostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Port whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Port whereOpenPort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Port whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Port withService($serviceID)
 * @mixin \Eloquent
 */
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

    public function scopeHasPort($query, $portNumber){
        return $query->where('open_port', $portNumber);
    }
}
