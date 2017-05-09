<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DomainTld extends Model
{
    public $timestamps = false;

    public function domainProvider(){
        return $this->hasOne('App\Models\DomainProvider', 'id', 'domain_provider_id');
    }
}
