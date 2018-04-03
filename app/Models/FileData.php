<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileData extends Model
{
    use SoftDeletes;
    protected $table = 'file_data';

    protected $fillable = [
        'filename', 'filetype', 'content', 'encrypted', 'password', 'filesize'
    ];

    public function data()
    {
        return $this->hasOne(File::class, 'file_id', 'id');
    }
}
