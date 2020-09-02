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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getVerification', 'getVerificationError']]);
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

    protected function validatorForPreInvites(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users|preinvite_email',
            'password' => 'required|min:6|confirmed',
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
            'userlevel' => config('hacktech.default_user_type')
        ]);
    }



    /**
    * Handle a registration request for the application.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function register(Request $request)
    {
        if(in_array($request->get('email'), config('invites.emails'))){
            $this->validatorForPreInvites($request->all())->validate();
        }else{
            $this->validator($request->all())->validate();
        }

        $user = $this->create($request->all());

        event(new Registered($user));

        $user->useInviteKey($request->invite, $user->id);
        
        $user->fillUserProfile($user->id);
        
        $user->createNewGateway($user->id);

        $user->createNewBankAccount($user->id);

        //$this->guard()->login($user);

        UserVerification::generate($user);

        UserVerification::send($user, 'Activate your HackTech Online account');

        Session::put('login_message', 'Please check your email inbox for an activation link');

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
}
