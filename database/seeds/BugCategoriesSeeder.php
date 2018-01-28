<?php

use Illuminate\Database\Seeder;

class BugCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bug_categories')->truncate();

        DB::table('bug_categories')->insert([
            'title' => 'UI / Design',
        ]);
        DB::table('bug_categories')->insert([
            'title' => 'Applications',
        ]);
        DB::table('bug_categories')->insert([
            'title' => 'Report other player',
        ]);
        DB::table('bug_categories')->insert([
            'title' => 'Your HTO account',
        ]);
        DB::table('bug_categories')->insert([
            'title' => 'In-game finances',
        ]);
        DB::table('bug_categories')->insert([
            'title' => 'Other',
        ]);
    }
}
