<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'app_name', 'app_group', 'on_market'
    ];

    public function group(){
        return $this->hasOne('App\Models\ApplicationGroup', 'id', 'app_group');
    }

    public function dataOld(){
        return $this->hasOne('App\Models\ApplicationData', 'application_id', 'id');
    }

    public function data($checkVersion = true){
        if($checkVersion){
            return ApplicationData::where('application_id', $this->id)->where('version', $this->version)->first();
        }

        return ApplicationData::where('application_id', $this->id)->first();
    }

    public function info($version){
       return $this->with(['data' => function ($query) use ($version) {
            $query->where('version', $version);
        }])->where('id', $this->id)->get();
    }

    public function scopeByVersion($query, $applicationId, $version){
        return $query->join('application_datas', 'application_datas.application_id', '=', 'applications.id')
            ->where('application_datas.version', '=', $version)
            ->where('application_id', $applicationId)
            ->select('applications.*', 'application_datas.version');
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
