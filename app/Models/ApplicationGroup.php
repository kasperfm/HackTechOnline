<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ApplicationGroup
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApplicationGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApplicationGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApplicationGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApplicationGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApplicationGroup whereName($value)
 * @mixin \Eloquent
 */
class ApplicationGroup extends Model
{
    protected $table = 'application_groups';
    public $timestamps = false;
}
