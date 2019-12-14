<?php

namespace App\Classes\Game\Types;

class RewardItemTypes {
    const File          = 1;
    const Application   = 2;
    const Script        = 3;

    public static $types = array(
        self::File        => "File",
        self::Application => "Application",
        self::Script      => "Script"
    );

    public static $values = array(
        self::File        => "File",
        self::Application => "Application",
        self::Script      => "Script"
    );
}
