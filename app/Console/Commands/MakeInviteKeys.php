<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invite;
use Illuminate\Support\Str;

class MakeInviteKeys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:makeinvite {numOfKeys}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate invite keys for new players';

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
     * @return mixed
     */
    public function handle()
    {
        $numberOfKeysToGenerate = $this->argument('numOfKeys');

        $this->info('Generated ' . $numberOfKeysToGenerate . ' codes:');

        for ($i = 0; $i < $numberOfKeysToGenerate; $i++){
            $newInvite = new Invite();
            $newInvite->key = Str::random(8);
            $newInvite->user_id = 0;
            $this->info($newInvite->key);
            $newInvite->save();
        }

        return 0;
    }
}
