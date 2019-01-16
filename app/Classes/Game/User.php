<?php

/**
 * App\Classes\Game\User
 *
 * @package HackTech Online
 * @author Kasper F. Mikkelsen
 * @copyright 2019
 * @version 1.0
 * @access public
 */

namespace App\Classes\Game;

use App\Models\Message;
use App\Models\User as Model;
use App\Models\UserApp;
use App\Models\UserMission;
use App\Models\UserTrust;
use App\Classes\Game\Types\HardwareTypes;
use App\Models\File;
use Illuminate\Support\Facades\Auth;

class User
{
    public $userID;
    public $username;
    public $model;

    /**
     * @var Economy
     */
    public $economy;

    /**
     * @var Gateway
     */
    public $gateway;

    /**
     * @var Mailbox
     */
    public $mailbox;

    /**
     * @var BugReport
     */
    public $bugreporter;

    public function __construct(Model $user)
    {
        $this->userID = $user->id;
        $this->username = $user->username;
        $this->economy = new Economy($user);
        $this->gateway = new Gateway($user->id);
        $this->mailbox = new Mailbox($user);
        $this->bugreporter = new BugReport($user);
        $this->model = $user;
    }

    public function getCorpTrust($corpID)
    {
        $userTrust = UserTrust::where('corp_id', $corpID)->where('user_id', $this->userID)->first();
        if($userTrust){
            return $userTrust->trust;
        }

        return 0;
    }

    public function resetAccount()
    {
        // Set money to default value.
        $this->economy->setMoney(config('hacktech.startingmoney'));

        // Reset gateway hardware
        $this->gateway->setHardwarePart(HardwareTypes::Gateway, 1);
        $this->gateway->setHardwarePart(HardwareTypes::Gateway, 2);
        $this->gateway->setHardwarePart(HardwareTypes::Gateway, 3);
        $this->gateway->setHardwarePart(HardwareTypes::Gateway, 4);

        // Clean all messages sent to and from the user.
        Message::where('from_user_id', $this->userID)->delete();
        Message::where('to_user_id', $this->userID)->delete();

        // Clear user generated content.
        UserMission::where('user_id', $this->userID)->delete();
        UserApp::where('user_id', $this->userID)->delete();
        File::where('owner', $this->userID)->delete();
        UserTrust::where('user_id', $this->userID)->delete();

        activity('system')
            ->causedBy(Auth::user())
            ->log(Auth::user()->username . ' reset his account');

        return response()->json('OK');
    }
}
