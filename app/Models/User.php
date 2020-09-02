<?php

namespace App\Models;

use App\Classes\Game\Handlers\EconomyHandler;
use App\Classes\Helpers\NetworkHelper;
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
        'username', 'email', 'password', 'userlevel', 'verified', 'email_verified_at', 'verification_token'
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

    public function createNewGateway($userID){
        $newIP = NetworkHelper::generateIP();

        $newGateway = new Gateway();
        $newGateway->user_id = $userID;
        $newGateway->inet_id = 1;
        $newGateway->cpu_id = 2;
        $newGateway->ram_id = 3;
        $newGateway->hdd_id = 4;
        $newGateway->host_id = 0;
        $newGateway->save();

        $newHost = new Host();
        $newHost->online_state = 1;
        $newHost->game_ip = $newIP;
        $newHost->host_type = 2;
        $newHost->machine_id = $newGateway->id;
        $newHost->save();

        $newGateway->host_id = $newHost->id;
        $newGateway->save();
    }

    public function fillUserProfile($userID){
        $emptyProfile = array(
            'user_id'           => $userID,
            'name'              => null,
            'corporation_id'    => null,
            'bank_id'           => 1,
            'profile_text'      => null
        );

        $userProfile = new UserProfile();
        $userProfile->fill($emptyProfile);
        $userProfile->save();
    }

    public function createNewBankAccount($userID){
        $defaultBankID = 1;
        $newAccountNumber = EconomyHandler::generateAccountNumber($defaultBankID);

        $accountInfo = array(
            'user_id'           => $userID,
            'bank_id'           => $defaultBankID,
            'account_number'    => $newAccountNumber,
            'active'            => 1
        );

        $newAccount = new BankAccount();
        $newAccount->fill($accountInfo);
        $newAccount->balance = config('hacktech.startingmoney', 10000);
        $newAccount->save();
    }

    public function useInviteKey($inviteKey, $userID){
        $invite = Invite::where('key', $inviteKey)->available()->first();

        if($invite) {
            $invite->used = 1;
            $invite->user_id = $userID;
            $invite->save();
        }
    }
}
