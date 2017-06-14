<?php

use Illuminate\Database\Seeder;

class DefaultAppsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // System > About
        DB::table('applications')->insert([
            'id' => 1,
            'app_name' => 'About',
            'app_group' => 2,
            'on_market' => 0
        ]);
        DB::table('application_datas')->insert([
            'application_id' => 1
        ]);

        // System > Webbrowser
        DB::table('applications')->insert([
            'id' => 2,
            'app_name' => 'Webbrowser',
            'app_group' => 2,
            'on_market' => 0
        ]);
        DB::table('application_datas')->insert([
            'application_id' => 2
        ]);

        // System > MyGateway
        DB::table('applications')->insert([
            'id' => 3,
            'app_name' => 'MyGateway',
            'app_group' => 2,
            'on_market' => 0
        ]);
        DB::table('application_datas')->insert([
            'application_id' => 3
        ]);
    }
}