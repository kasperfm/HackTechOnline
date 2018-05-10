<?php

use App\Classes\Game\Handlers\ServerHandler;
use App\Models\File;
use App\Models\FileData;
use Illuminate\Database\Seeder;

class MissionDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = array(
            [
                'host' => ServerHandler::getServer('87.49.178.2')->hostID,
                'filename' => 'omnimail.conf',
                'filetype' => 'txt',
                'content' => '[server]
ip = 122.5.55.101
hostname = germail.com
port = 80
description = "GerMail - E-Mail für alle"
admin_hash = "YWExNTQ2cGQ1PmA"

[database]
db_host = 122.5.55.100
db_port = 5989
db_keyfile = secukey.cert

[externals]
load_config = {
     cfg/omni.smtp.conf
     cfg/omni.pop.conf
     cfg/omni.imap.conf
     cfg/omni.webmail.conf
     cfg/coco.antispam.conf
     cfg/coco.antivirus.conf
     cfg/omni.quota.conf
     cfg/omni.authmodules.conf
     cfg/global.domains.conf
     cfg/global.security.conf
}
load_module = {
     modules/omni.*.omod
     modules/coco.antispam.omod
     modules/coco.antivirus.omod
}

[logs]
log_dir = /mnt/srv_logs/omnimail
max_size = 64M
max_age = 1Y',
                'encrypted' => 0,
                'password' => null,
                'filesize' => 27
            ],
            [
                'host' => ServerHandler::getServer('31.113.213.227')->hostID,
                'filename' => 'red_pill.bin',
                'filetype' => 'bin',
                'content' => 'PLACEHOLDER',
                'encrypted' => 0,
                'password' => null,
                'filesize' => 58
            ]
        );

        foreach ($files as $newFile){
            $createThisFile = $newFile;
            unset($createThisFile['host']);

            DB::table('file_data')->updateOrInsert(
                ['filename' => $createThisFile['filename'], 'filetype' => $createThisFile['filetype']],
                $createThisFile
            );

            $insertedFile = FileData::where('filename', $createThisFile['filename'])->where('filetype', $createThisFile['filetype'])->first();

            DB::table('files')->updateOrInsert(
                ['file_id' => $insertedFile->id],
                [
                    'file_id' => $insertedFile->id,
                    'owner' => 0,
                    'encrypted' => $newFile['encrypted'],
                    'placement' => 'server',
                    'host' => $newFile['host']
                ]
            );
        }
    }
}
