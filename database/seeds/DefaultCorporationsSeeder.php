<?php

use Illuminate\Database\Seeder;
use App\Models\Corporation;

class DefaultCorporationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $corporations = array(
            [
                'name' => 'T42',
                'description' => 'Terminal-42 ("T42") is a newly formed Danish cracker group. There isn\'t much information available about them at the moment.',
                'owner_user_id' => null,
                'status' => 1
            ],
            [
                'name' => 'NetForce',
                'description' => 'NetForce is a corporation operated by the UK and Chinese government. Their goal is to make the net safer place to be.',
                'owner_user_id' => null,
                'status' => 1
            ],
            [
                'name' => 'TeamAnubis',
                'description' => 'One of the old-school blackhat groups. TeamAnubis is famous for their well crafted malware, tools and keygens.',
                'owner_user_id' => null,
                'status' => 1
            ],
            [
                'name' => 'PsychedelicBytes',
                'description' => 'Originally formed by some script-kiddies from Germany, but now includes people from all around the world. You don\'t want to mess with these guys. They have more CPU power available than you can imagine.',
                'owner_user_id' => null,
                'status' => 1
            ],
            [
                'name' => 'The Keyboard Cowboys',
                'description' => 'The Keyboard Cowboys (TKC) are one of the few good and well respected hacker groups out there. They use their skills to find security issues in important and critical systems. And if the software companies need their help, they do it for a small fee.',
                'owner_user_id' => null,
                'status' => 1
            ],
            [
                'name' => 'LaidBackCoderz',
                'description' => 'The LBC crew is known by being highly skilled in low level software development. Their code is super fast, and very effective. If you find a piece of their software, be sure to keep it - or sell it for a good price!',
                'owner_user_id' => null,
                'status' => 1
            ]);

        foreach($corporations as $corp){
            Corporation::firstOrCreate($corp);
        }
    }
}
