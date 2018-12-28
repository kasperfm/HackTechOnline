<?php

namespace App\Classes\Game\Types;

class HardwareTypes {
    const InternetConnection  = 0;
    const CPU 	              = 1;
    const RAM	              = 2;
    const Harddrive		      = 3;

    public static $types = array(
        self::InternetConnection 	=> "Internet Connection",
        self::CPU	                => "CPU",
        self::RAM                   => "RAM",
        self::Harddrive		        => "Storage"
    );

    public static $values = array(
        self::InternetConnection 	=> "Mbit/s",
        self::CPU	                => "MHz",
        self::RAM                   => "MB",
        self::Harddrive		        => "MB"
    );

    const System  = 0;
    const Server  = 1;
    const Gateway = 2;

    public static $machines = array(
        self::System  => "System",
        self::Server  => "Server",
        self::Gateway => "Gateway",
    );
}
