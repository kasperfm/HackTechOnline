<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserApp extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'application_id', 'installed'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function application(){
        return $this->belongsTo('App\Models\Application');
    }

    public function scopeInstalled($query){
        return $query->where('installed', 1);
    }

    public function scopeOwnedBy($query, $owner){
        return $query->where('user_apps.user_id', $owner);
    }

    public function scopeByVersion($query, $version){
        return $query->join('application_datas', 'application_datas.id', '=', 'user_apps.application_id')->select('user_apps.*', 'version')->where('application_datas.version', '=', $version);
    }
}
