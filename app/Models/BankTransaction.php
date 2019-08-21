<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BankTransaction
 *
 * @property int $id
 * @property int $to_bank_id
 * @property int $to_account
 * @property int|null $from_bank_id
 * @property int|null $from_account
 * @property int $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BankTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BankTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BankTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BankTransaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BankTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BankTransaction whereFromAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BankTransaction whereFromBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BankTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BankTransaction whereToAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BankTransaction whereToBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BankTransaction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BankTransaction extends Model
{
    protected $table = 'bank_transactions';
    protected $fillable = [
        'to_bank_id', 'to_account', 'from_bank_id', 'from_account', 'amount'
    ];
}
