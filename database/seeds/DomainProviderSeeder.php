<?php

use Illuminate\Database\Seeder;
use App\Classes\Game\Handlers\ServerHandler;
use App\Classes\Game\Handlers\DomainHandler;
use App\Models\DomainProvider;
use App\Models\DomainTld;

class DomainProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!ServerHandler::hostnameToIP('omnitech.net')) {
            $omniTechHost = ServerHandler::newServer(0, null);
            DomainHandler::newSystemDomain($omniTechHost->host->id, 'omnitech.net');
            DB::table('domain_providers')->insert([
                'title' => 'OmniTech Domain Services',
                'host_id' => $omniTechHost->host->id,
                'max_domains' => null,
                'price_factor' => 1
            ]);
            DB::table('domain_tlds')->insert([
                'domain_provider_id' => 1,
                'tld' => 'hto',
                'days_to_hold' => 60
            ]);
            DB::table('domain_tlds')->insert([
                'domain_provider_id' => 1,
                'tld' => 'web',
                'days_to_hold' => 30
            ]);
        }

        if(!ServerHandler::hostnameToIP('hugesoft.net')) {
            $hugeSoftIncHost = ServerHandler::newServer(0, null);
            DomainHandler::newSystemDomain($hugeSoftIncHost->host->id, 'hugesoft.net');
            DB::table('domain_providers')->insert([
                'title' => 'HugeSoft Inc. Hosting Solutions',
                'host_id' => $hugeSoftIncHost->host->id,
                'max_domains' => 100,
                'price_factor' => 2.5
            ]);
            DB::table('domain_tlds')->insert([
                'domain_provider_id' => 2,
                'tld' => 'com',
                'days_to_hold' => 30
            ]);
        }
    }
}
