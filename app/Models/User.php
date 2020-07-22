<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $username
 * @property string $email
 * @property string $password
 * @property int $userlevel
 * @property int $is_admin
 * @property int $verified
 * @property string|null $verification_token
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $email_verified_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserApp[] $apps
 * @property-read \App\Models\BankAccount $bankAccount
 * @property-read \App\Models\Gateway $gateway
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserLogin[] $logins
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Message[] $messagesFromUser
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Message[] $messagesToUser
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Models\UserProfile $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Server[] $servers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserTrust[] $trustPoints
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserlevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereVerificationToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereVerified($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use CrudTrait;
    use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'userlevel'
    ];

    protected $dates = [
        'created_at'
    ];

    // Identifier for admin panel usage
    public function identifiableAttribute() {
        return 'username';
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function profile(){
        return $this->hasOne('App\Models\UserProfile');
    }

    public function logins(){
        return $this->hasMany('App\Models\UserLogin');
    }

    public function gateway(){
        return $this->hasOne(Gateway::class);
    }

    public function bankAccount(){
        return $this->hasOne('App\Models\BankAccount');
    }

    public function servers(){
        return $this->hasMany('App\Models\Server');
    }

    public function apps(){
        return $this->hasMany('App\Models\UserApp');
    }

    public function trustPoints(){
        return $this->hasMany(UserTrust::class);
    }

    public function messagesFromUser(){
        return $this->hasMany(Message::class, 'from_user_id', 'id');
    }

    public function messagesToUser(){
        return $this->hasMany(Message::class, 'to_user_id', 'id');
    }
}
