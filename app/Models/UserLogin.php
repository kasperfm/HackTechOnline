<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserLogin
 *
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon $last_date
 * @property string $last_ip
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLogin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLogin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLogin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLogin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLogin whereLastDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLogin whereLastIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLogin whereUserId($value)
 * @mixin \Eloquent
 */
class UserLogin extends Model
{
    protected $table = 'user_logins';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'last_date', 'last_ip'
    ];

    protected $dates = [
        'last_date'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
