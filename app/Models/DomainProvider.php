<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DomainProvider extends Model
{
    protected $table = 'domain_providers';
    public $timestamps = false;

    public function host(){
        return $this->hasOne('App\Models\Host', 'id', 'host_id');
    }

    public function tlds(){
        return $this->hasMany('App\Models\DomainTld');
    }
}
