<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\UserMission
 *
 * @property int $id
 * @property int $user_id
 * @property int $mission_id
 * @property int $done
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Mission $mission
 * @property-read \App\Models\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserMission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserMission newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserMission onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserMission query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserMission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserMission whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserMission whereDone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserMission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserMission whereMissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserMission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserMission whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserMission withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserMission withoutTrashed()
 * @mixin \Eloquent
 */
class UserMission extends Model
{
    use SoftDeletes;

    protected $table = 'user_missions';

    protected $fillable = [
        'user_id',
        'mission_id',
        'done'
    ];

    public function mission()
    {
        return $this->hasOne(Mission::class, 'id', 'mission_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
