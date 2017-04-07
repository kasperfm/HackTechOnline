<?php

namespace App\Classes\Game;

use Illuminate\Http\Request;

class Requirements
{
    public $cpu;
    public $ram;
    public $hdd;

    private $appName;

    public function __construct($appName, $cpu, $ram, $hdd) {
        $this->appName = $appName;
        $this->cpu = $cpu;
        $this->ram = $ram;
        $this->hdd = $hdd;
    }

    public function validateRequirements(Request $request)
    {
        $runningApps = $request->session()->get('runningApps', array());
        if (!in_array($this->appName, $runningApps)) {
            // TODO: Get data from gateway !
            $availableCpu = 100;
            $availableRam = 100;

            $currentCpuUsage = $request->session()->get('cpuUsage');
            $currentRamUsage = $request->session()->get('ramUsage');

            if ((($availableCpu - $currentCpuUsage) >= $this->cpu) && (($availableRam - $currentRamUsage) >= $this->ram)) {
                $request->session()->push('runningApps', $this->appName);
                $request->session()->put('cpuUsage', $currentCpuUsage + $this->cpu);
                $request->session()->put('ramUsage', $currentRamUsage + $this->ram);

                return true;
            } else {
                return false;
            }
        }
    }
}