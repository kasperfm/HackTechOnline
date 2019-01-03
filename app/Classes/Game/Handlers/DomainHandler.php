<?php

namespace App\Classes\Game\Handlers;

use Carbon\Carbon;
use App\Models\Host;
use App\Models\Hostname;
use App\Models\DomainTld;
use App\Classes\Helpers\NetworkHelper;
use App\Classes\Game\Handlers\ServerHandler;
use App\Classes\Game\Server as ServerObj;

class DomainHandler
{
    /**
     * Create a new domain.
     * @param $hostID
     * @param $domain
     * @param $tld
     * @param $providerID
     * @return Hostname|bool
     */
    public static function newDomain($hostID, $domain, $tld, $providerID){
        $tldLookup = DomainTld::where('domain_provider_id', $providerID)->where('tld', $tld)->first();
        if (!empty($tldLookup)) {
            $newHostname = new Hostname();
            $newHostname->hostname = $domain . '.' . $tld;
            $newHostname->host_id = $hostID;
            $newHostname->expire_date = Carbon::now()->addDays($tldLookup->days_to_hold);
            $newHostname->domain_provider_id = $providerID;
            $newHostname->activated = 1;
            $newHostname->save();

            return $newHostname;
        }else{
            return false;
        }
    }

    /**
     * Make a new system domain. This is a domain without expire date.
     * @param $hostID
     * @param $domain
     */
    public static function newSystemDomain($hostID, $domain){
        $newHostname = new Hostname();
        $newHostname->hostname = $domain;
        $newHostname->host_id = $hostID;
        $newHostname->expire_date = null;
        $newHostname->domain_provider_id = null;
        $newHostname->activated = 1;
        $newHostname->save();

        self::addWebserverService($hostID);
    }

    /**
     * Add a webserver to the current domain.
     * @param $hostID
     */
    private static function addWebserverService($hostID){
        $server = new ServerObj($hostID);
        $server->addService(1, 80);
    }
}
