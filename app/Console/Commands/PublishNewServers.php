<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublishNewServers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:publish:servers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish new created servers to the game.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $serverFiles = File::files(storage_path('app/seederdata/servers/new'));
        foreach ($serverFiles as $server) {
            if ($server->getExtension() != "json") {
                continue;
            }

            $file = file_get_contents($server->getPathname());
            $serverJsonData = json_decode($file);

            if(!empty($serverJsonData->domain)) {
                $renameTo = Str::slug(str_replace('.', '_', $serverJsonData->domain), '_') . '.json';
            } else {
                $renameTo = Str::slug(str_replace('.', '_', $serverJsonData->ip), '_') . '.json';
            }

            File::move(storage_path('app/seederdata/servers/new/' . $server->getFilename()), storage_path('app/seederdata/servers/' . $renameTo));
            $this->info('Published new server: "' . $serverJsonData->domain . '"');
        }

        return 0;
    }
}
