<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Corporation extends Model
{
    use CrudTrait;

    protected $fillable = [
        'owner_user_id', 'name', 'description', 'status', 'invite_key'
    ];

    protected $hidden = ['owner_user_id'];

    public function owner(){
        return $this->hasOne(User::class, 'id', 'owner_user_id');
    }
}
