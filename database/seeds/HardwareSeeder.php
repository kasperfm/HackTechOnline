<?php

use Illuminate\Database\Seeder;

class HardwareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default hardware components.
        DB::table('gateway_hardwares')->insert([
            'part_name' => 'Standard connection',
            'price'     => 0,
            'type'      => 0,
            'value'     => 2
        ]);
        DB::table('gateway_hardwares')->insert([
            'part_name' => 'Xylon G1 CPU',
            'price'     => 0,
            'type'      => 1,
            'value'     => 500
        ]);
        DB::table('gateway_hardwares')->insert([
            'part_name' => 'K2 memory',
            'price'     => 0,
            'type'      => 2,
            'value'     => 64
        ]);
        DB::table('gateway_hardwares')->insert([
            'part_name' => 'Mondo-755 SSD',
            'price'     => 0,
            'type'      => 3,
            'value'     => 8
        ]);
    }
}
