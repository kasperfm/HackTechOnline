<?php

/**
 * App\Classes\Game\Corporation
 *
 * @package HackTech Online
 * @author Kasper F. Mikkelsen
 * @copyright 2019
 * @version 1.0
 * @access public
 */

namespace App\Classes\Game;

use App\Models\Corporation as Model;
use App\Models\User;
use App\Models\UserTrust;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Corporation
{
    protected $model = null;

    public $corpID;
    public $name;
    public $description;
    public $status;
    public $owner;
    public $inviteKey;

    public function __construct(Model $corpModel)
    {
        $this->model = $corpModel;

        $this->corpID = $corpModel->id;
        $this->name = $corpModel->name;
        $this->description = $corpModel->description;
        $this->status = $corpModel->status;
        $this->owner = $corpModel->owner;
        $this->inviteKey = $corpModel->invite_key;
    }

    /**
     * Add trust points to a player
     * @param $userID
     * @param $points
     */
    public function addTrust($userID, $points)
    {
        $trustObj = UserTrust::firstOrCreate(['user_id' => $userID, 'corp_id' => $this->corpID]);
        $trustObj->trust += $points;
        $trustObj->save();

        activity('game')
            ->withProperties(['corp_id' => $this->corpID])
            ->causedBy(Auth::user() ? Auth::user() : null)
            ->log('Gained ' . $points . ' trust points');
    }

    /**
     * Remove trust points from a player
     * @param $userID
     * @param $points
     */
    public function removeTrust($userID, $points)
    {
        $trustObj = UserTrust::firstOrCreate(['user_id' => $userID, 'corp_id' => $this->corpID]);
        $trustObj->trust -= $points;
        $trustObj->save();

        activity('game')
            ->withProperties(['corp_id' => $this->corpID])
            ->causedBy(Auth::user() ? Auth::user() : null)
            ->log('Lost ' . $points . ' trust points');
    }

    /**
     * Generate and save a new invite key for the corporation
     * @return string
     */
    public function newInviteKey()
    {
        $inviteKey = strtolower(Str::random('24'));

        $isKeyDuplicate = Model::where('invite_key', $inviteKey)->first();

        if($isKeyDuplicate) {
            $this->newInviteKey();
        }

        $this->model->invite_key = $inviteKey;
        $this->model->save();

        return $inviteKey;
    }

}
