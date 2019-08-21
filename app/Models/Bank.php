<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Bank
 *
 * @property int $id
 * @property int $host_id
 * @property string $bank_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BankAccount[] $accounts
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bank query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bank whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bank whereHostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bank whereId($value)
 * @mixin \Eloquent
 */
class Bank extends Model
{
    public $timestamps = false;

    
    public function accounts(){
        return $this->hasMany('App\Models\BankAccount');
    }
}
