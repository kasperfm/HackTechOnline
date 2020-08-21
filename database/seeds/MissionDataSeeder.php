<?php

use App\Classes\Game\Handlers\CorpHandler;
use App\Classes\Game\Handlers\DomainHandler;
use App\Classes\Game\Handlers\ServerHandler;
use App\Models\File;
use App\Models\Mission;
use App\Models\MissionData;
use App\Models\FileData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MissionDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('missions')->truncate();

        $psyBytesID = CorpHandler::getCorporationByName('PsychedelicBytes')->corpID;

        //PsychedelicBytes - Show us your skills
        $psyBytes_01_Mission = new Mission();
        $psyBytes_01_Mission->fill([
            'title' => 'Show us your skills',
            'description' => 'We think you are kind of interesting. If you can complete a few small tasks for us, and show what kind of hacker you are, we will reward you with some nice cash$$. And of course more jobs if you do this good enough... We "magically" got the admin login informations for the German email service "GerMail", and want you to connect to their administration system at http://admin.germail.com, and download the config file for their system. The username for the system is "gottfried-adm" and password "gg7320vb38f". If you complete that task without further questions, we will have plenty of jobs for you later on.',
            'complete_message' => 'Nice, you did it! Come back for the next task if you want...',
            'reward_trust' => 5,
            'reward_credits' => 100,
            'corp_id' => $psyBytesID,
            'type' => 'get',
            'objective' => 'get omnimail.conf from 87.49.178.2',
            'minimum_trust' => 0,
            'hidden' => 0,
            'chain_parent' => 0
        ]);
        $psyBytes_01_Mission->save();

        //PsychedelicBytes - Cr@ck dat konfig pazz
        $psyBytes_02_Mission = new Mission();
        $psyBytes_02_Mission->fill([
            'title' => 'Cr@ck dat konfig pazz',
            'description' => 'You completed our first task, but now the fun part begins! Open the configuration file you got from the GerMail admin system in your default text editor. Then look for the admin password to their root-domain, crack it using your favourite cracker tool, and send it to us. To send decrypted password to us, please don\'t use email or other crappy methods. But point your browser to "https://sharemypwd.info", and use the unique access token "shrooms4ever" and fill in the cracked password, to share it with us.',
            'complete_message' => 'Thank you for the password! You better hide your tracks a bit now.',
            'reward_trust' => 5,
            'reward_credits' => 175,
            'corp_id' => $psyBytesID,
            'type' => 'submit',
            'objective' => 'submit 34hYp19kfmd to 78.45.107.4',
            'minimum_trust' => 5,
            'hidden' => 0,
            'chain_parent' => $psyBytes_01_Mission->id
        ]);
        $psyBytes_02_Mission->save();

        //PsychedelicBytes - Cover your tracks
        $psyBytes_03_Mission = new Mission();
        $psyBytes_03_Mission->fill([
            'title' => 'Cover your tracks',
            'description' => 'As the very final task for now, you should change your gateway\'s IP address as soon as possible! We know it\'s not a very good way to try to be safe, but it\'s better than nothing. So get an IP Renewer tool, and change your IP... NOW!',
            'complete_message' => 'Phew, that was close. Let us hope that this will slow their tracers down a bit.',
            'reward_trust' => 10,
            'reward_credits' => 30,
            'corp_id' => $psyBytesID,
            'type' => 'renewip',
            'objective' => '',
            'minimum_trust' => 10,
            'hidden' => 0,
            'chain_parent' => $psyBytes_02_Mission->id
        ]);
        $psyBytes_03_Mission->save();

        $files = array(
            [
                'host' => ServerHandler::getServer('87.49.178.2')->hostID,
                'filename' => 'omnimail.conf',
                'filetype' => 'txt',
                'content' => '[server]
ip = 87.49.178.2
hostname = germail.com
port = 80
description = "GerMail - E-Mail für alle"
admin_hash = "NTJuX3Y3P21ga2I"

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
                'filesize' => 4
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
                    'owner_id' => 0,
                    'encrypted' => $newFile['encrypted'],
                    'placement' => 'server',
                    'host' => $newFile['host']
                ]
            );
        }
    }
}
