<?php

namespace App\Classes\Game;

use App\Models\Bug;
use App\Models\BugCategory;
use App\Models\User;

class BugReport
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function newReport($subject, $description, $category)
    {
        if(empty($subject) || empty($description) || empty($category)){
            return null;
        }

        $bug = new Bug();

        $bug->subject = $subject;
        $bug->description = $description;
        $bug->category_id = $category;
        $bug->user_id = $this->user->id;
        $bug->user_agent = $_SERVER['HTTP_USER_AGENT'];

        $bug->save();

        return $bug;
    }

}
