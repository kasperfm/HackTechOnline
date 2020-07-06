<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\Command;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:importdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all default files, servers and missions.';

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
        Artisan::call('db:seed', ['--class' => 'DefaultDataSeeder']);
        $this->line(Artisan::output());
    }
}
