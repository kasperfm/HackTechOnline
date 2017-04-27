<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    protected $fillable = [
        'to_bank_id', 'to_account', 'from_bank_id', 'from_account', 'amount'
    ];
}
