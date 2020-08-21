<?php

namespace App\Classes\Game\Missions;

class AdvancedTestClass extends AdvancedMissionBase
{
    // Default method that will be called when accepting the contract.
    public function accept()
    {
        broadcast(new \App\Events\Notification('TEST MESSAGE', 'You have accepted a new contract. This is just a sample text :-)'));
    }

    // This will automatically be called when aborting the contract.
    public function abort()
    {
        broadcast(new \App\Events\Notification('SAMPLE MESSAGE', 'We are sad to see you go... Bye for now then.'));
    }

    // Default method that is called when completing the contract with success.
    public function complete()
    {
        $this->user->economy->addMoney(42);
        broadcast(new \App\Events\Notification('EXTRA CREDITS', 'Here is a little extra credits for just being awesome, lol.'));
    }
}