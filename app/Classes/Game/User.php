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

use App\Classes\Game\Handlers\CorpHandler;
use App\Classes\Game\Types\UserTypes;
use App\Models\Message;
use App\Models\User as Model;
use App\Models\UserApp;
use App\Models\UserMission;
use App\Models\UserProfile;
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
     * @var string User role
     */
    public $userRole;


    /**
     * @var int User level
     */
    public $userLevel;

    /**
     * @var Corporation The corporation the user belongs to
     */
    public $corporation;

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
        $this->corporation = CorpHandler::getCorporation($user->profile->corporation_id);
        $this->userLevel = $user->userlevel;
        $this->userRole = UserTypes::$values[$user->userlevel];
        $this->model = $user;
    }

    /**
     * Join a new corporation.
     * @param $inviteKey
     * @return bool
     */
    public function joinCorporation($inviteKey)
    {
        $corpModel = \App\Models\Corporation::where('invite_key', $inviteKey)->first();

        if(!$corpModel){
            return false;
        }

        $profile = UserProfile::where('user_id', $this->userID)->first();
        $profile->corporation_id = $corpModel->id;
        $profile->save();

        $this->corporation = CorpHandler::getCorporation($corpModel->id);
        currentPlayer()->corporation = $this->corporation;

        return true;
    }

    /**
     * Leave the current corporation.
     * @return bool
     */
    public function leaveCorporation()
    {
        $profile = UserProfile::where('user_id', $this->userID)->first();
        $profile->corporation_id = null;
        $profile->save();

        $this->corporation = null;
        currentPlayer()->corporation = null;

        return true;
    }

    /**
     * Get the current trust point value from a corporation.
     * @param $corpID
     * @return int
     */
    public function getCorpTrust($corpID)
    {
        $userTrust = UserTrust::where('corp_id', $corpID)->where('user_id', $this->userID)->first();
        if($userTrust){
            return $userTrust->trust;
        }

        return 0;
    }

    /**
     * Reset the entire game account for this user.
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetAccount()
    {
        // Set money to default value.
        $this->economy->setMoney(config('hacktech.startingmoney'));

        // Reset gateway hardware
        $this->gateway->setHardwarePart(HardwareTypes::Gateway, 1);
        $this->gateway->setHardwarePart(HardwareTypes::Gateway, 2);
        $this->gateway->setHardwarePart(HardwareTypes::Gateway, 3);
        $this->gateway->setHardwarePart(HardwareTypes::Gateway, 4);
        $this->gateway->saveHardware();

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
