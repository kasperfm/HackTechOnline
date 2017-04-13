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

    public function data(){
        return $this->hasOne('App\Models\ApplicationData', 'application_id', 'id');
    }

    public function scopeOnMarket($query){
        return $query->where('on_market', 1);
    }

    public function scopeOfGroup($query, $type){
        return $query->where('app_group', $type);
    }
}
