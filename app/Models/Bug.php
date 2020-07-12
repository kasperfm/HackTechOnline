<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Bug
 *
 * @property int $id
 * @property int $user_id
 * @property int $fixed
 * @property string $subject
 * @property string $description
 * @property int $category_id
 * @property string|null $user_agent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BugCategory $category
 * @property-read \App\Models\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bug newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bug newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Bug onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bug query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bug whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bug whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bug whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bug whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bug whereFixed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bug whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bug whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bug whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bug whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bug whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Bug withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Bug withoutTrashed()
 * @mixin \Eloquent
 */
class Bug extends Model
{
    use CrudTrait;
    use SoftDeletes;

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
