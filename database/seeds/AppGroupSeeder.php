<?php

use Illuminate\Database\Seeder;

class AppGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('application_groups')->truncate();

        DB::table('application_groups')->insert([
            'name' => 'demo',
        ]);
        DB::table('application_groups')->insert([
            'name' => 'system',
        ]);
        DB::table('application_groups')->insert([
            'name' => 'tools',
        ]);
        DB::table('application_groups')->insert([
            'name' => 'pvp',
        ]);
        DB::table('application_groups')->insert([
            'name' => 'homebrew',
        ]);
    }
}
