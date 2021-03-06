<?php

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->truncate();

        DB::table('services')->insert([
            'name' => 'Web',
            'description' => 'Web-server that serves websites to the client browser.',
            'default_port' => 80
        ]);

        DB::table('services')->insert([
            'name' => 'Admin',
            'description' => 'Remote control a system, for administration purposes.',
            'default_port' => 22
        ]);

        DB::table('services')->insert([
            'name' => 'FTP',
            'description' => 'Transfer files between systems.',
            'default_port' => 21
        ]);

        DB::table('services')->insert([
            'name' => 'Database',
            'description' => 'Store data in an organized way.',
            'default_port' => 3306
        ]);
    }
}
