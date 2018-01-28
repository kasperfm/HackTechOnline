<?php

use Illuminate\Database\Seeder;
use App\Classes\Game\Handlers\ServerHandler;
use App\Classes\Game\Handlers\DomainHandler;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $secuBank = ServerHandler::newServer(0, null, '112.186.23.176');
        DomainHandler::newSystemDomain($secuBank->host->id, 'secubank.com');
        DB::table('banks')->insert([
            'host_id' => $secuBank->host->id,
            'bank_name' => 'SecuBank International'
        ]);

        $modiBank = ServerHandler::newServer(0, null, '203.83.50.88');
        DomainHandler::newSystemDomain($modiBank->host->id, 'modibank.com');
        DB::table('banks')->insert([
            'host_id' => $modiBank->host->id,
            'bank_name' => 'ModiBank Inc.'
        ]);
    }
}
