<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Application
 *
 * @property int $id
 * @property string $app_name
 * @property int $app_group
 * @property int $on_market
 * @property-read \App\Models\ApplicationData $data
 * @property-read \App\Models\ApplicationGroup $group
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application byVersion($applicationId, $version)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application greaterThanVersion($applicationId, $version)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application ofGroup($type)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application onMarket()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereAppGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereAppName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereOnMarket($value)
 * @mixin \Eloquent
 */
class Application extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'app_name', 'app_group', 'on_market'
    ];

    public function group(){
        return $this->hasOne('App\Models\ApplicationGroup', 'id', 'app_group');
    }

    public function data(){
        return $this->hasOne('App\Models\ApplicationData', 'application_id', 'id');
    }

    public function getData($checkVersion = true){
        if($checkVersion){
            return ApplicationData::where('application_id', $this->id)->where('version', $this->data->version)->first();
        }

        return ApplicationData::where('application_id', $this->id)->first();
    }

    public function info($version){
       return $this->with(['data' => function ($query) use ($version) {
            $query->where('version', $version);
        }])->where('id', $this->id)->get();
    }

    public static function findSpecificVersion($id, $version)
    {
        return self::where('applications.id', $id)->byVersion($id, $version);
    }

    public function scopeByVersion($query, $applicationId, $version){
        return $query->join('application_datas', 'application_datas.application_id', '=', 'applications.id')
            ->where('application_datas.version', '=', $version)
            ->where('application_id', $applicationId)
            ->select('applications.*', 'application_datas.version', 'application_datas.id as variant_id');
    }


    public function scopeGreaterThanVersion($query, $applicationId, $version){
        return $query->join('application_datas', 'application_datas.application_id', '=', 'applications.id')
            ->where('application_datas.version', '>', $version)
            ->where('application_id', $applicationId)
            ->select('applications.*', 'application_datas.version');
    }

    public function scopeOnMarket($query){
        return $query->where('on_market', 1);
    }

    public function scopeOfGroup($query, $type){
        return $query->where('app_group', $type);
    }
}
