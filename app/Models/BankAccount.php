<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BankAccount
 *
 * @property int $id
 * @property int $bank_id
 * @property int $user_id
 * @property int $account_number
 * @property int $active
 * @property int $balance
 * @property-read \App\Models\Bank $bank
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BankAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BankAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BankAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BankAccount whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BankAccount whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BankAccount whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BankAccount whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BankAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BankAccount whereUserId($value)
 * @mixin \Eloquent
 */
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
