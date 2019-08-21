<?php

namespace App\Models;

use App\Models\User;
use Backpack\Base\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;
use Backpack\Base\app\Models\Traits\InheritsRelationsFromParentModel;

/**
 * App\Models\BackpackUser
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BackpackUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BackpackUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BackpackUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BackpackUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BackpackUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BackpackUser whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BackpackUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BackpackUser whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BackpackUser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BackpackUser whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BackpackUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BackpackUser whereUserlevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BackpackUser whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BackpackUser whereVerificationToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BackpackUser whereVerified($value)
 * @mixin \Eloquent
 */
class BackpackUser extends User
{
    use InheritsRelationsFromParentModel;

    protected $table = 'users';

    /**
     * Send the password reset notification.
     *
     * @param string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }
}
