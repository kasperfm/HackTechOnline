<?php

use App\Classes\Game\Handlers\CorpHandler;
use App\Classes\Game\Handlers\DomainHandler;
use App\Classes\Game\Handlers\ServerHandler;
use App\Models\FileData;
use App\Models\Mission;
use Illuminate\Database\Seeder;

class DefaultDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->line('Importing servers...');
        $this->importServers();
        $this->command->line('');
        $this->command->line('Importing missions...');
        $this->importMissions();
        $this->command->line('');
        $this->command->line('Importing files...');
        $this->importFiles();
    }

    private function importServers()
    {
        $serverFiles = \File::allFiles(storage_path('app/seederdata/servers'));
        foreach ($serverFiles as $server){
            if($server->getExtension() != "json") {
                continue;
            }

            $result = file_get_contents($server->getPathname());
            $newServer = $this->importServerJsonFile($result);

            $this->command->line('Created server: ' . $newServer->ip . ( isset($newServer->domain) ? ' ('.$newServer->domain.')' : '' ));
        }
    }

    private function importServerJsonFile($jsonData)
    {
        $rawServer = json_decode($jsonData);

        // This is always 0 in this case, since we only import system owned servers.
        $serverOwner = 0;

        $newServer = ServerHandler::newServer($serverOwner, $rawServer->rootpassword, $rawServer->ip);

        if($newServer && $rawServer->domain) {
            DomainHandler::newSystemDomain($newServer->host->id, $rawServer->domain);

            if(isset($rawServer->services)) {
                foreach ($rawServer->services as $service) {
                    ServerHandler::getServer($rawServer->ip)->addService($service->type, $service->port);
                }
            }
        }

        return $rawServer;
    }

    private function importMissionJsonFile($jsonData)
    {
        $rawMission = json_decode($jsonData);

        $corporation = CorpHandler::getCorporationByName($rawMission->corporation);

        if(!$corporation){
            return false;
        }

        if($rawMission->chain_parent_shortcode){
            $chainParentMission = App\Classes\Game\Handlers\MissionHandler::findMission($rawMission->chain_parent_shortcode);
        }

        DB::table('missions')->updateOrInsert(
            ['corp_id' => $corporation->corpID, 'shortcode' => $rawMission->shortcode],
            [
                'shortcode'         => $rawMission->shortcode,
                'title'             => $rawMission->title,
                'description'       => $rawMission->description,
                'complete_message'  => $rawMission->complete_message,
                'reward_trust'      => $rawMission->rewards->trust,
                'reward_credits'    => $rawMission->rewards->credits,
                'reward_item_id'    => $rawMission->rewards->item,
                'corp_id'           => $corporation->corpID,
                'type'              => $rawMission->type,
                'objective'         => $rawMission->objective,
                'minimum_trust'     => $rawMission->required_trust,
                'hidden'            => intval($rawMission->hidden),
                'chain_parent'      => $chainParentMission->missionID ?? null,
                'is_advanced'       => $rawMission->advanced_class ? 1 : 0,
                'advanced_class'    => $rawMission->advanced_class
            ]
        );

        return $rawMission;
    }

    private function importMissions()
    {
        $files = \File::allFiles(storage_path('app/seederdata/missions'));
        foreach ($files as $file) {
            if($file->getExtension() != "json") {
                continue;
            }

            $result = file_get_contents($file->getPathname());
            $newMission = $this->importMissionJsonFile($result);

            if(!$newMission){
                continue;
            }

            $this->command->line('Created mission: "' . $newMission->title . '" ('.$newMission->shortcode.')');
        }
    }

    private function importFiles()
    {
        $files = \File::allFiles(storage_path('app/seederdata/files'));
        foreach ($files as $file) {
            $result = include $file->getPathname();

            $createThisFile = $result;
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
                    'encrypted' => $result['encrypted'],
                    'placement' => 'server',
                    'host' => $result['host']
                ]
            );

            $this->command->line('Created file: "' . $result['filename'] . '"');
        }
    }
}
