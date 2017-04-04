<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'app_name', 'app_group', 'on_market'
    ];

    public function group(){
        return $this->hasOne('App\Models\ApplicationGroup', 'id', 'app_group');
    }

    public function scopeOnMarket($query){
        return $query->where('on_market', 1);
    }

    public function scopeOfGroup($query, $type){
        return $query->where('app_group', $type);
    }
}
