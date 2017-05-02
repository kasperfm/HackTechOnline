<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DomainProvider extends Model
{
    public $timestamps = false;

    public function host(){
        return $this->hasOne('App\Models\Host', 'id', 'host_id');
    }
}
