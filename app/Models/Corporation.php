<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Corporation
 *
 * @property int $id
 * @property int|null $owner_user_id
 * @property string $name
 * @property string $description
 * @property string|null $invite_key
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $members
 * @property-read \App\Models\User $owner
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Corporation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Corporation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Corporation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Corporation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Corporation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Corporation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Corporation whereInviteKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Corporation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Corporation whereOwnerUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Corporation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Corporation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Corporation extends Model
{
    use CrudTrait;

    protected $fillable = [
        'owner_user_id', 'name', 'description', 'status', 'invite_key'
    ];

    protected $hidden = ['owner_user_id', 'invite_key'];

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_user_id');
    }

    public function members()
    {
        return $this->hasManyThrough(
            'App\Models\User',
            'App\Models\UserProfile',
            'corporation_id', // Foreign key on UserProfile table...
            'id', // Foreign key on User table...
            'id', // Local key on Corporation table...
            'user_id' // Local key on UserProfile table...
        );
    }
}
