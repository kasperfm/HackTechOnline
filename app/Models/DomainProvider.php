<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DomainProvider
 *
 * @property int $id
 * @property string $title
 * @property int|null $host_id
 * @property int|null $max_domains
 * @property float $price_factor
 * @property-read \App\Models\Host $host
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DomainTld[] $tlds
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DomainProvider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DomainProvider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DomainProvider query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DomainProvider whereHostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DomainProvider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DomainProvider whereMaxDomains($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DomainProvider wherePriceFactor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DomainProvider whereTitle($value)
 * @mixin \Eloquent
 */
class DomainProvider extends Model
{
    protected $table = 'domain_providers';
    public $timestamps = false;

    public function host(){
        return $this->hasOne('App\Models\Host', 'id', 'host_id');
    }

    public function tlds(){
        return $this->hasMany('App\Models\DomainTld');
    }
}
