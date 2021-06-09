<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublishNewFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:publish:files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish new created files to the game.';

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
        $newFiles = File::files(storage_path('app/seederdata/files/new'));
        foreach ($newFiles as $newFile) {
            if ($newFile->getExtension() != "json") {
                continue;
            }

            $file = file_get_contents($newFile->getPathname());
            $fileJsonData = json_decode($file);

            if(empty($fileJsonData->filename)) {
                $this->error('Filename not defined for: ' . $newFile->getFilename());
                return 0;
            } else {
                $renameTo = Str::slug(str_replace('.', '_', $fileJsonData->filename), '_') . '-' . time() . '.json';
            }

            File::move(storage_path('app/seederdata/files/new/' . $newFile->getFilename()), storage_path('app/seederdata/files/' . $renameTo));
            $this->info('Published new file: "' . $fileJsonData->filename . '"');
        }

        return 0;
    }
}
