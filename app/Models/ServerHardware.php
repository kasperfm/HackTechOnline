<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServerHardware extends Model
{
    protected $table = 'server_hardwares';
    public $timestamps = false;

    protected $fillable = [
        'part_name', 'price', 'type', 'value'
    ];

    public function scopeIsCpu($query){
        return $query->where('type', 1);
    }

    public function scopeIsRam($query){
        return $query->where('type', 2);
    }

    public function scopeIsHdd($query){
        return $query->where('type', 3);
    }

    public function scopeIsNet($query){
        return $query->where('type', 0);
    }

    public function scopeDefaultPart($query){
        return $query->where('price', 0);
    }
}
