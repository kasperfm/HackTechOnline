<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hostname extends Model
{
    public function domainProvider(){
        return $this->hasOne('App\Models\DomainProvider', 'id', 'domain_provider_id');
    }

    public function host(){
        return $this->hasOne('App\Models\Host', 'id', 'host_id');
    }
}
