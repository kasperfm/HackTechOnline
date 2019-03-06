<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table = 'bank_accounts';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'bank_id', 'account_number', 'active'
    ];

    protected $hidden = [
        'balance'
    ];

    public function bank(){
        return $this->hasOne('App\Models\Bank');
    }
}
