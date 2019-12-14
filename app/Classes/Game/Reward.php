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

use App\Models\RewardItem;
use App\Classes\Game\Types\RewardItemTypes;

class Reward
{
    public $itemID;
    public $type;

    public function __construct($itemID)
    {
        $this->itemID = $itemID;

        $reward = RewardItem::where('id', $itemID)->first();
        if($reward){
            $this->type = $this->getType($reward->item_type);
        }else{
            return null;
        }

    }

    private function getType($typeID)
    {
        return RewardItemTypes::$types[$typeID];
    }
}