<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bug extends Model
{
    use SoftDeletes;
    use CrudTrait;

    protected $fillable = ['user_id', 'subject', 'fixed', 'description', 'category_id', 'user_agent'];

    protected $hidden = ['user_agent'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\BugCategory');
    }
}
