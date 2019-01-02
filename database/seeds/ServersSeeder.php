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
        // Germail.com
        $germail = ServerHandler::newServer(0, null, '87.49.178.1');
        if($germail) {
            DomainHandler::newSystemDomain($germail->host->id, 'germail.com');
        }
        $germailAdmin = ServerHandler::newServer(0, null, '87.49.178.2');
        if($germailAdmin) {
            DomainHandler::newSystemDomain($germailAdmin->host->id, 'admin.germail.com');
        }
        $germailMailServer = ServerHandler::newServer(0, null, '122.5.55.100');
        if($germailMailServer) {
            DomainHandler::newSystemDomain($germailMailServer->host->id, 'mail.germail.com');
        }

        // PsyBytes.org
        $psyBytes = ServerHandler::newServer(0, null, '31.113.213.227');
        if($psyBytes){
            DomainHandler::newSystemDomain($psyBytes->host->id,'psybytes.org');
        }

        // ShareMyPwd.info
        $shareMyPwd = ServerHandler::newServer(0, null, '78.45.107.4');
        if($shareMyPwd){
            DomainHandler::newSystemDomain($shareMyPwd->host->id,'shareMyPwd.info');
        }
    }
}
