<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ServerHardware
 *
 * @property int $id
 * @property string $part_name
 * @property int $price
 * @property int $type
 * @property int $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerHardware defaultPart()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerHardware isCpu()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerHardware isHdd()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerHardware isNet()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerHardware isRam()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerHardware newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerHardware newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerHardware query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerHardware whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerHardware wherePartName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerHardware wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerHardware whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerHardware whereValue($value)
 * @mixin \Eloquent
 */
class ServerHardware extends Model
{
    use CrudTrait;
    protected $table = 'server_hardwares';

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
