<?php

use App\Classes\Game\Handlers\DomainHandler;
use App\Classes\Game\Handlers\ServerHandler;
use App\Models\FileData;
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
        //
    }

    private function importServers()
    {
        $serverFiles = \File::allFiles(storage_path('app/seederdata/servers'));
        foreach ($serverFiles as $server){
            $result = include $server->getPathname();

            $newServer = ServerHandler::newServer($result['owner'], $result['rootpass'], $result['ip']);
            if($newServer) {
                DomainHandler::newSystemDomain($newServer->host->id, $result['domain']);

                if(isset($result['services'])) {
                    foreach ($result['services'] as $service) {
                        ServerHandler::getServer($result['ip'])->addService($service['type'], $service['port']);
                    }
                }
            }
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
        }
    }
}
