<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
