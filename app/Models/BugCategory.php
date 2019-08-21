<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BugCategory
 *
 * @property int $id
 * @property string $title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bug[] $bugs
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BugCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BugCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BugCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BugCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BugCategory whereTitle($value)
 * @mixin \Eloquent
 */
class BugCategory extends Model
{
    public $table = 'bug_categories';
    public $timestamps = false;

    public function bugs()
    {
        return $this->hasMany('App\Models\Bug', 'id', 'category_id');
    }
}
