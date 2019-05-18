<?php

namespace App\Classes\Game\Modules\System\ProfileSettings;

use App\Classes\Game\Handlers\UserHandler;
use App\Classes\Game\Module;
use Illuminate\Http\Request;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class ProfileSettings extends Module
{
    public function setup(){
        $this->name = "ProfileSettings";
        $this->title = "Profile Settings";

        $this->size = array(
            "width"     => 385,
            "height"    => 450
        );
    }

}
