<?php

namespace App\Http\Controllers\Auth;

use App\Models\Host;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Invite;
use App\Models\Gateway;
use App\Models\BankAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;
use App\Classes\Helpers\NetworkHelper;
use App\Classes\Game\Handlers\EconomyHandler;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use VerifiesUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    // TODO: Correct this when out of alpha.
    private $startingMoney = 100000;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getVerification', 'getVerificationError']]);
    }

    private function useInviteKey($inviteKey, $userID){
        $invite = Invite::where('key', $inviteKey)->available()->first();

        if($invite->isEmpty == false) {
            $invite->used = 1;
            $invite->user_id = $userID;
            $invite->save();
        }
    }

    private function createNewBankAccount($userID){
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
        $newAccount->balance = $this->startingMoney;
        $newAccount->save();
    }

    private function fillUserProfile($userID){
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'invite' => 'required|valid_invite',
            'g-recaptcha-response' => 'required|recaptcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'userlevel' => 3, // TODO: Define different types with permissions (3 == GameTester)
        ]);
    }

    private function createNewGateway($userID){
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

    /**
    * Handle a registration request for the application.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        event(new Registered($user));

        $this->useInviteKey($request->invite, $user->id);
        
        $this->fillUserProfile($user->id);
        
        $this->createNewGateway($user->id);

        $this->createNewBankAccount($user->id);

        //$this->guard()->login($user);

        UserVerification::generate($user);

        UserVerification::send($user, 'Activate your HackTech Online account');

        Session::put('login_message', 'Please check your email inbox for an activation link');

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
}
