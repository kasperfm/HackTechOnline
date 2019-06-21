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
            'hdd_req' => 10,
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

        // System > Mission Center
        DB::table('applications')->insert([
            'id' => 10,
            'app_name' => 'MissionCenter',
            'app_group' => 2,
            'on_market' => 0
        ]);
        DB::table('application_datas')->insert([
            'application_id' => 10
        ]);

        // Tools > Password Cracker
        DB::table('applications')->insert([
            'id' => 11,
            'app_name' => 'PasswordCracker',
            'app_group' => 3,
            'on_market' => 1
        ]);
        DB::table('application_datas')->insert([
            'application_id' => 11,
            'version' => 1,
            'price' => 120,
            'hdd_req' => 20,
            'cpu_req' => 233,
            'ram_req' => 32
        ]);

        // Tools > File Viewer
        DB::table('applications')->insert([
            'id' => 12,
            'app_name' => 'FileViewer',
            'app_group' => 3,
            'on_market' => 1
        ]);
        DB::table('application_datas')->insert([
            'application_id' => 12,
            'version' => 1,
            'price' => 10,
            'hdd_req' => 4,
            'cpu_req' => 16,
            'ram_req' => 24
        ]);

        // Tools > IP Renewer
        DB::table('applications')->insert([
            'id' => 13,
            'app_name' => 'IpRenewer',
            'app_group' => 3,
            'on_market' => 1
        ]);
        DB::table('application_datas')->insert([
            'application_id' => 13,
            'version' => 1,
            'price' => 60,
            'hdd_req' => 16,
            'cpu_req' => 22,
            'ram_req' => 28
        ]);

        // System > Bug Report
        DB::table('applications')->insert([
            'id' => 14,
            'app_name' => 'AccountReset',
            'app_group' => 2,
            'on_market' => 0
        ]);
        DB::table('application_datas')->insert([
            'application_id' => 14
        ]);

        // Tools > Log Reader
        DB::table('applications')->insert([
            'id' => 15,
            'app_name' => 'LogReader',
            'app_group' => 3,
            'on_market' => 1
        ]);
        DB::table('application_datas')->insert([
            'application_id' => 15,
            'version' => 1,
            'price' => 100,
            'hdd_req' => 16,
            'cpu_req' => 30,
            'ram_req' => 28
        ]);

        // System > Profile Settings
        DB::table('applications')->insert([
            'id' => 16,
            'app_name' => 'ProfileSettings',
            'app_group' => 2,
            'on_market' => 0
        ]);
        DB::table('application_datas')->insert([
            'application_id' => 16
        ]);

        // System > Corp. Status
        DB::table('applications')->insert([
            'id' => 17,
            'app_name' => 'CorpStatus',
            'app_group' => 2,
            'on_market' => 0
        ]);
        DB::table('application_datas')->insert([
            'application_id' => 17
        ]);

        // System > AI
        DB::table('applications')->insert([
            'id' => 18,
            'app_name' => 'Ai',
            'app_group' => 2,
            'on_market' => 0
        ]);
        DB::table('application_datas')->insert([
            'application_id' => 18
        ]);
    }
}