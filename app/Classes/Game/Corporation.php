<?php

namespace App\Classes\Game;

use App\Models\Corporation as Model;
use App\Models\User;
use App\Models\UserTrust;

class Corporation
{
    protected $model = null;

    public $corpID;
    public $name;
    public $description;
    public $status;
    public $owner;

    public function __construct(Model $corpModel)
    {
        $this->model = $corpModel;

        $this->corpID = $corpModel->id;
        $this->name = $corpModel->name;
        $this->description = $corpModel->description;
        $this->status = $corpModel->status;
        $this->owner = $corpModel->owner;
    }

    public function addTrust($userID, $points)
    {
        $trustObj = UserTrust::firstOrCreate(['user_id' => $userID, 'corp_id' => $this->corpID]);
        $trustObj->trust += $points;
        $trustObj->save();
    }

    public function removeTrust($userID, $points)
    {
        $trustObj = UserTrust::firstOrCreate(['user_id' => $userID, 'corp_id' => $this->corpID]);
        $trustObj->trust -= $points;
        $trustObj->save();
    }

}
