<?php

namespace App\Classes\Game\Modules\Tools\PasswordCracker;

use App\Classes\Game\Module;
use Illuminate\Http\Request;

class PasswordCracker extends Module
{
    public function setup()
    {
        $this->name = "passwordcracker";
        $this->title = "Password Cracker";
        $this->group = "tools";
        $this->description = "A common password cracker. This should be in every hackers toolbox!";

        $this->size = array(
            "width" => 450,
            "height" => 300
        );
    }
}