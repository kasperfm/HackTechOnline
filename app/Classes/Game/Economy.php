<?php

namespace App\Classes\Game;

use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\BankTransaction;
use App\Models\User;

class Economy
{
    /**
     * @var User
     */
    public $user;

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
        $this->user = $user;
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
        return Bank::where('id', $this->user->profile->bank_id)->first();
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

        activity('game')
            ->performedOn($this->bankAccount)
            ->causedBy($this->user)
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

        activity('game')
            ->performedOn($this->bankAccount)
            ->causedBy($this->user)
            ->log('Removed ' . $amount . ' credits');

        return $this->getBalance();
    }
}
