<?php

use Illuminate\Database\Seeder;
use App\Classes\Game\ServerHandler;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $secuBank = ServerHandler::newServer(0, null);
        DB::table('banks')->insert([
            'host_id' => $secuBank->host->id,
            'bank_name' => 'SecuBank International'
        ]);

        $modiBank = ServerHandler::newServer(0, null);
        DB::table('banks')->insert([
            'host_id' => $modiBank->host->id,
            'bank_name' => 'ModiBank International'
        ]);
    }
}
