<?php

/**
 * App\Classes\Game\Requirements
 *
 * @package HackTech Online
 * @author Kasper F. Mikkelsen
 * @copyright 2019
 * @version 1.0
 * @access public
 */

namespace App\Classes\Game;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function validateRequirements(Request $request) {
        $runningApps = $request->session()->get('runningApps', array());
        if (!in_array($this->appName, $runningApps)) {
            $user = currentPlayer();
            $availableCpu = $user->gateway->hardware['cpu']->hardwareData['value'];
            $availableRam = $user->gateway->hardware['ram']->hardwareData['value'];

            $currentCpuUsage = $request->session()->get('cpuUsage');
            $currentRamUsage = $request->session()->get('ramUsage');

            if ((($availableCpu - $currentCpuUsage) >= $this->cpu) && (($availableRam - $currentRamUsage) >= $this->ram)) {
                $request->session()->push('runningApps', $this->appName);
                $request->session()->put('cpuUsage', $currentCpuUsage + $this->cpu);
                $request->session()->put('ramUsage', $currentRamUsage + $this->ram);

                return true;
            }
        }

        return false;
    }
}