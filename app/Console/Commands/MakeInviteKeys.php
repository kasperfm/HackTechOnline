<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invite;

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
    protected $description = 'Command description';

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

        for ($i = 0; $i <= $numberOfKeysToGenerate; $i++){
            $newInvite = new Invite();
            $newInvite->key = str_random(8);
            $newInvite->user_id = 0;
            $this->info($newInvite->key);
            $newInvite->save();
        }
    }
}
