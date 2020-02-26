<?php

/**
 * App\Classes\Game\Economy
 *
 * @package HackTech Online
 * @author Kasper F. Mikkelsen
 * @copyright 2019
 * @version 1.0
 * @access public
 */

namespace App\Classes\Game;

use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\BankTransaction;
use App\Models\User;

class Economy
{
    /**
     * @var int
     */
    public $userID;

    /**
     * @var BankAccount
     */
    public $bankAccount;

    private $bank;

    /**
     * Economy constructor.
     * @param User $user
     */
    public function __construct(User $user){
        $this->userID = $user->id;
        $this->bankAccount = $user->bankAccount;
    }

    /**
     * Get the current account balance.
     * @return int
     */
    public function getBalance(){
        return $this->bankAccount->balance;
    }

    /**
     * Get bank object.
     * @return Bank
     */
    public function getBank(){
        return $this->bankAccount->bank;
    }

    /**
     * Get bank account number.
     * @return int
     */
    public function getAccountNumber(){
        return $this->bankAccount->account_number;
    }

    /**
     * Add money to the current bank account.
     * @param $amount
     * @return int
     */
    public function addMoney($amount){
        $this->bankAccount->balance += $amount;
        $this->bankAccount->save();

        activity('economy')
            ->performedOn($this->bankAccount)
            ->causedBy($this->userID)
            ->withProperties([
                'amount' => $amount,
            ])
            ->log('Added ' . $amount . ' credits');

        return $this->getBalance();
    }

    /**
     * Remove money from the current bank account.
     * @param $amount
     * @return int
     */
    public function removeMoney($amount){
        $this->bankAccount->balance -= $amount;
        $this->bankAccount->save();

        activity('economy')
            ->performedOn($this->bankAccount)
            ->causedBy($this->userID)
            ->withProperties([
                'amount' => $amount * -1,
            ])
            ->log('Removed ' . $amount . ' credits');

        return $this->getBalance();
    }

    /**
     * Set the balance to a fixed amount.
     * @param $amount
     * @return int
     */
    public function setMoney($amount)
    {
        $this->bankAccount->balance = $amount;
        $this->bankAccount->save();

        return $this->getBalance();
    }
}
