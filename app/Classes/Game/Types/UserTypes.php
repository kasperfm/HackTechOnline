<?php

namespace App\Classes\Game\Types;

class UserTypes {
    const System        = 0;
    const Administrator = 1;
    const Moderator     = 2;
    const GameTester    = 3;
    const User          = 4;

    public static $types = array(
        self::System        => "System",
        self::Administrator => "Administrator",
        self::Moderator     => "Moderator",
        self::GameTester	=> "GameTester",
        self::User	        => "User"
    );

    public static $values = array(
        self::System        => "System",
        self::Administrator => "Administrator",
        self::Moderator     => "Game Moderator",
        self::GameTester	=> "Alpha/Beta Tester",
        self::User	        => "Normal User"
    );
}
