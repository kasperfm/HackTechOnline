<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EncryptPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:encryptpassword {string}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Encrypt a password, for use inside the game.';

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
        $inputString = $this->argument('string');

        $encPassword = $this->encryptText($inputString);
        $encPassword = str_replace('=', '', $encPassword);

        $this->info('Encoded password: ' . $encPassword);

        return 0;
    }

    private function charCodeAt($str, $index) {
        $utf16 = mb_convert_encoding($str, 'UTF-16LE', 'UTF-8');
        return ord($utf16[$index*2]) + (ord($utf16[$index*2+1]) << 8);
    }

    public function encryptText($string, $xorKey = 6)
    {
        $the_res = "";
        for($i = 0; $i < iconv_strlen($string); $i++)
        {
            $the_res .= chr($xorKey^$this->charCodeAt($string, $i));
        }

        return base64_encode($the_res);
    }
}
