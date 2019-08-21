<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserTrust
 *
 * @property int $id
 * @property int $corp_id
 * @property int $user_id
 * @property int $trust
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Corporation $corporation
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserTrust newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserTrust newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserTrust query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserTrust whereCorpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserTrust whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserTrust whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserTrust whereTrust($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserTrust whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserTrust whereUserId($value)
 * @mixin \Eloquent
 */
class UserTrust extends Model
{
    protected $table = 'user_trust';

    protected $fillable = ['corp_id', 'user_id', 'trust'];

    public function corporation()
    {
        return $this->hasOne(Corporation::class, 'id', 'corp_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
