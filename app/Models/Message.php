<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'from_user_id', 'to_user_id', 'subject', 'message', 'status'
    ];

    public function fromUser(){
        return $this->belongsTo('App\Models\User', 'id', 'from_user_id');
    }

    public function toUser(){
        return $this->belongsTo('App\Models\User', 'id', 'to_user_id');
    }
}
