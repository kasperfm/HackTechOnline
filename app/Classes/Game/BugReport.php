<?php

/**
 * App\Classes\Game\BugReport
 *
 * @package HackTech Online
 * @author Kasper F. Mikkelsen
 * @copyright 2019
 * @version 1.0
 * @access public
 */

namespace App\Classes\Game;

use App\Models\Bug;
use App\Models\BugCategory;
use App\Models\User;

class BugReport
{
    public $userID;

    /**
     * BugReport constructor.
     * @param int $userID
     */
    public function __construct($userID)
    {
        $this->userID = $userID;
    }

    public function newReport($subject, $description, $category)
    {
        if(empty($subject) || empty($description) || empty($category)){
            return null;
        }

        $bug = new Bug();

        $bug->subject = strip_tags($subject);
        $bug->description = strip_tags(nl2br($description), '<br>');
        $bug->category_id = (int)$category;
        $bug->user_id = $this->userID;
        $bug->user_agent = $_SERVER['HTTP_USER_AGENT'];

        $bug->save();

        return $bug;
    }

}
