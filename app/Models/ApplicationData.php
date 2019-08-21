<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ApplicationData
 *
 * @property int $id
 * @property int $application_id
 * @property float $version
 * @property int $price
 * @property int $hdd_req
 * @property int $cpu_req
 * @property int $ram_req
 * @property-read \App\Models\Application $application
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApplicationData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApplicationData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApplicationData query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApplicationData whereApplicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApplicationData whereCpuReq($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApplicationData whereHddReq($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApplicationData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApplicationData wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApplicationData whereRamReq($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApplicationData whereVersion($value)
 * @mixin \Eloquent
 */
class ApplicationData extends Model
{
    protected $table = 'application_datas';
    public $timestamps = false;

    protected $fillable = [
        'application_id', 'version', 'price', 'hdd_req', 'cpu_req', 'ram_req'
    ];

    public function application(){
        return $this->belongsTo('App\Models\Application');
    }
}
