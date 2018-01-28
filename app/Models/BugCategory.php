<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BugCategory extends Model
{
    public $table = 'bug_categories';
    public $timestamps = false;

    public function bugs()
    {
        return $this->hasMany('App\Models\Bug', 'id', 'category_id');
    }
}
