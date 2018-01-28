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
        // Clean the application tables!
        DB::table('applications')->truncate();
        DB::table('application_datas')->truncate();

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

        // System > SoftwareMarket
        DB::table('applications')->insert([
            'id' => 4,
            'app_name' => 'SoftwareMarket',
            'app_group' => 2,
            'on_market' => 0
        ]);
        DB::table('application_datas')->insert([
            'application_id' => 4
        ]);

        // Tools > Portscanner
        DB::table('applications')->insert([
            'id' => 5,
            'app_name' => 'Portscanner',
            'app_group' => 3,
            'on_market' => 1
        ]);
        DB::table('application_datas')->insert([
            'application_id' => 5,
            'version' => 1,
            'price' => 60,
            'hdd_req' => 15,
            'cpu_req' => 100,
            'ram_req' => 24
        ]);

        // System > Messenger
        DB::table('applications')->insert([
            'id' => 6,
            'app_name' => 'Messenger',
            'app_group' => 2,
            'on_market' => 0
        ]);
        DB::table('application_datas')->insert([
            'application_id' => 6
        ]);

        // System > Mailbox
        DB::table('applications')->insert([
            'id' => 7,
            'app_name' => 'Mailbox',
            'app_group' => 2,
            'on_market' => 0
        ]);
        DB::table('application_datas')->insert([
            'application_id' => 7
        ]);

        // System > Bug Report
        DB::table('applications')->insert([
            'id' => 8,
            'app_name' => 'BugReporter',
            'app_group' => 2,
            'on_market' => 0
        ]);
        DB::table('application_datas')->insert([
            'application_id' => 8
        ]);

        // System > My Software
        DB::table('applications')->insert([
            'id' => 9,
            'app_name' => 'MySoftware',
            'app_group' => 2,
            'on_market' => 0
        ]);
        DB::table('application_datas')->insert([
            'application_id' => 9
        ]);
    }
}