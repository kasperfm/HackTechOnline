<?php

use Illuminate\Database\Seeder;
use App\Classes\Game\Handlers\ServerHandler;
use App\Classes\Game\Handlers\DomainHandler;

class ServersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $germail = ServerHandler::newServer(0, null, '87.49.178.2');
        if($germail) {
            DomainHandler::newSystemDomain($germail->host->id, 'germail.com');
        }
    }
}
