<?php

namespace app\Classes\Game;


class Requirements
{
    public $cpu;
    public $ram;
    public $hdd;

    public function __construct($cpu, $ram, $hdd) {
        $this->cpu = $cpu;
        $this->ram = $ram;
        $this->hdd = $hdd;
    }
}