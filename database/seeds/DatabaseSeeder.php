<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AppGroupSeeder::class);
        $this->call(DefaultAppsSeeder::class);
        $this->call(HardwareSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(ServiceSeeder::class); 
    }
}
