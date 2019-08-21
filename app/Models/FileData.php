<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\FileData
 *
 * @property int $id
 * @property string $filename
 * @property string $filetype
 * @property string $content
 * @property int $encrypted
 * @property string|null $password
 * @property int $filesize
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\File $data
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileData newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FileData onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileData query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileData whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileData whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileData whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileData whereEncrypted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileData whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileData whereFilesize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileData whereFiletype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileData wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileData whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FileData withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FileData withoutTrashed()
 * @mixin \Eloquent
 */
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
