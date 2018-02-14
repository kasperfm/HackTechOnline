<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Corporation extends Model
{
    protected $fillable = [
        'owner_user_id', 'name', 'description', 'status'
    ];

    public function owner(){
        return $this->hasOne(User::class, 'id', 'owner_user_id');
    }
}
