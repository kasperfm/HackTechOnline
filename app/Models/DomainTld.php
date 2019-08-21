<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DomainTld
 *
 * @property int $id
 * @property int|null $domain_provider_id
 * @property string $tld
 * @property int|null $days_to_hold
 * @property-read \App\Models\DomainProvider $domainProvider
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DomainTld newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DomainTld newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DomainTld query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DomainTld whereDaysToHold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DomainTld whereDomainProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DomainTld whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DomainTld whereTld($value)
 * @mixin \Eloquent
 */
class DomainTld extends Model
{
    protected $table = 'domain_tlds';
    public $timestamps = false;

    public function domainProvider(){
        return $this->hasOne('App\Models\DomainProvider', 'id', 'domain_provider_id');
    }
}
