<?php

namespace App\Classes\Game;

use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\BankTransaction;
use App\Models\User;

class Economy
{
    public $user;
    public $bankAccount;
    private $bank;

    public function __construct(User $user){
        $this->user = $user;
        $this->bankAccount = $user->bankAccount;
    }

    public function getBalance(){
        return $this->bankAccount->balance;
    }

    public function getBank(){
        return Bank::where('id', $this->user->profile->bank_id)->first();
    }

    public function getAccountNumber(){
        return $this->bankAccount->account_number;
    }

    public function addMoney($amount){
        $this->bankAccount->balance += $amount;
        $this->bankAccount->save();

        return $this->getBalance();
    }

    public function removeMoney($amount){
        $this->bankAccount->balance -= $amount;
        $this->bankAccount->save();

        return $this->getBalance();
    }
}
