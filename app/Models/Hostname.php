<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Hostname
 *
 * @property int $id
 * @property string $hostname
 * @property int $host_id
 * @property int|null $domain_provider_id
 * @property string|null $expire_date
 * @property int $activated
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DomainProvider $domainProvider
 * @property-read \App\Models\Host $host
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hostname newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hostname newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hostname query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hostname whereActivated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hostname whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hostname whereDomainProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hostname whereExpireDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hostname whereHostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hostname whereHostname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hostname whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hostname whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Hostname extends Model
{
    public function domainProvider(){
        return $this->hasOne('App\Models\DomainProvider', 'id', 'domain_provider_id');
    }

    public function host(){
        return $this->hasOne('App\Models\Host', 'id', 'host_id');
    }
}
