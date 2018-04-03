<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;
    protected $table = 'files';

    protected $fillable = [
        'file_id', 'owner', 'encrypted', 'placement', 'host'
    ];

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner');
    }

    public function data()
    {
        return $this->hasOne(FileData::class, 'id', 'file_id');
    }

}
