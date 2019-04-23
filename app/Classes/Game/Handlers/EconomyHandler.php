<?php

namespace App\Classes\Game\Handlers;

use App\Models\User;
use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\BankTransaction;
use App\Classes\Game\Handlers\UserHandler;

class EconomyHandler
{
    /**
     * Generate a new valid and unused account number.
     * @param $bankID
     * @return string|null
     */
    public static function generateAccountNumber($bankID){
        $bank_account_check_ok = false;
        $accountNumber = null;
        while ($bank_account_check_ok == false){
            $randInt = rand(1000, 99999900);
            $accountNumber = str_pad($randInt, 8, '0', STR_PAD_LEFT);

            $account_check = BankAccount::where('account_number', $accountNumber)->first();

            if (empty($account_check)){
                $bank_account_check_ok = true;
            }
        }

        return $accountNumber;
    }

    /**
     * Transfer money from one user to another.
     * @param $fromUserID
     * @param $toUserID
     * @param $amount
     * @return bool
     */
    public static function transferMoney($fromUserID, $toUserID, $amount){
        $fromUser = UserHandler::getUser($fromUserID);
        $toUser = UserHandler::getUser($toUserID);

        if($fromUser->economy->getBalance() >= $amount){
            $fromUser->economy->removeMoney($amount);
            $toUser->economy->addMoney($amount);

            $log = new BankTransaction();
            $newLogEntry = array(
                'to_bank_id'        => $toUser->economy->getBank()->id,
                'to_account'        => $toUser->economy->getAccountNumber(),
                'from_bank_id'      => $fromUser->economy->getBank()->id,
                'from_account'      => $fromUser->economy->getAccountNumber(),
                'amount'            => $amount
            );
            $log->fill($newLogEntry);
            $log->save();

            activity('economy')
                ->performedOn($log)
                ->withProperties([
                    'amount' => $amount,
                    'from_account' => $fromUser->economy->getAccountNumber(),
                    'to_account' => $toUser->economy->getAccountNumber(),
                ])
                ->causedBy(Auth::user() ? Auth::user() : null)
                ->log('Transferred ' . $amount . ' credits from ' . $fromUser->economy->getAccountNumber() . ' to ' . $toUser->economy->getAccountNumber());

            return true;
        }else{
            return false;
        }
    }

}
