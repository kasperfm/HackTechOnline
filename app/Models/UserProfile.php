<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserProfile
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $name
 * @property int|null $corporation_id
 * @property int $bank_id
 * @property string|null $profile_text
 * @property int $music
 * @property int $ai_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereAiStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereCorporationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereMusic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereProfileText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereUserId($value)
 * @mixin \Eloquent
 */
class UserProfile extends Model
{
    protected $table = 'user_profiles';

    protected $fillable = [
        'user_id', 'name', 'corporation_id', 'bank_id', 'profile_text', 'music'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
