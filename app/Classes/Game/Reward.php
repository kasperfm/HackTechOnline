<?php

/**
 * App\Classes\Game\Reward
 *
 * @package HackTech Online
 * @author Kasper F. Mikkelsen
 * @copyright 2019
 * @version 1.0
 * @access public
 */

namespace App\Classes\Game;

use App\Classes\Game\Handlers\FileHandler;
use App\Classes\Game\Handlers\ModuleHandler;
use App\Models\RewardItem;
use App\Classes\Game\Types\RewardItemTypes;
use App\Models\UserApp;

class Reward
{
    public $itemID;
    public $title;
    public $typeID;
    public $type;
    public $dropChance;
    public $item;


    public function __construct($itemID)
    {
        $this->itemID = $itemID;

        $reward = RewardItem::where('id', $itemID)->first();
        if($reward){
            $this->typeID = $this->getType($reward->item_type);
            $this->type = RewardItemTypes::$values[$this->typeID];

            switch ($this->typeID){
                case RewardItemTypes::File:
                    $this->item = FileHandler::getFile($reward->reference_id);
                    $this->title = $this->item->getFilenameOnly();
                    break;

                case RewardItemTypes::Application:
                    $this->item = ModuleHandler::make()->getApplication($reward->reference_id, auth()->id() ?? null, true);
                    $this->title = $this->item->title;
                    break;

                case RewardItemTypes::Script:
                    // TODO: Scripts not implemented yet.
                    break;
            }

            $this->dropChance = $reward->drop_chance;
        }else{
            return null;
        }

    }

    private function getType($typeID)
    {
        return RewardItemTypes::$types[$typeID];
    }

    public function rewardPlayerWithItem($userID)
    {
        switch ($this->typeID){
            case RewardItemTypes::File:
                FileHandler::downloadFile($this->item->fileID, $userID);
                break;

            case RewardItemTypes::Application:
                $newApp = UserApp::firstOrCreate(
                    [
                        'user_id' => $userID,
                        'application_id' => $this->item->moduleID
                    ],
                    [
                        'user_id' => $userID,
                        'application_id' => $this->item->moduleID,
                        'installed' => 0,
                        'application_datas_id' => $this->item->variantID
                    ]
                );

                break;

            case RewardItemTypes::Script:
                // TODO: Scripts not implemented yet.
                break;
        }
    }

    public function isDropped()
    {
        $randomChance = random_int(1, 99);
        if($randomChance < $this->dropChance){
            return true;
        }

        return false;
    }
}