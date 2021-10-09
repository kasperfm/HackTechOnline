<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GatewayHardware
 *
 * @property int $id
 * @property string $part_name
 * @property int $price
 * @property int $type
 * @property int $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GatewayHardware defaultPart()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GatewayHardware isCpu()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GatewayHardware isHdd()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GatewayHardware isNet()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GatewayHardware isRam()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GatewayHardware newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GatewayHardware newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GatewayHardware query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GatewayHardware whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GatewayHardware wherePartName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GatewayHardware wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GatewayHardware whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GatewayHardware whereValue($value)
 * @mixin \Eloquent
 */
class GatewayHardware extends Model
{
    use CrudTrait;
    protected $table = 'gateway_hardwares';

    public $timestamps = false;

    protected $fillable = [
        'part_name', 'price', 'type', 'value'
    ];

    public function scopeIsCpu($query){
        return $query->where('type', 1);
    }

    public function scopeIsRam($query){
        return $query->where('type', 2);
    }

    public function scopeIsHdd($query){
        return $query->where('type', 3);
    }

    public function scopeIsNet($query){
        return $query->where('type', 0);
    }

    public function scopeDefaultPart($query){
        return $query->where('price', 0);
    }

}
