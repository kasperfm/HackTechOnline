<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'test',
            'email' => 'test@hacktechonline.com',
            'password' => bcrypt('test123!'),
            'userlevel' => config('hacktech.default_user_type')
        ]);

        $user->fillUserProfile($user->id);

        $user->createNewGateway($user->id);

        $user->createNewBankAccount($user->id);
    }
}
