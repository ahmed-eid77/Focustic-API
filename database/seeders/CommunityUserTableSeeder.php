<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommunityUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('community_user')->insert([
            ['community_id' => 1, 'user_id' => 1],
            ['community_id' => 1, 'user_id' => 2],
            ['community_id' => 1, 'user_id' => 3],
            ['community_id' => 1, 'user_id' => 4],
            ['community_id' => 2, 'user_id' => 8],
            ['community_id' => 2, 'user_id' => 9],
            ['community_id' => 2, 'user_id' => 10],
            ['community_id' => 2, 'user_id' => 11],
            ['community_id' => 3, 'user_id' => 12],
            ['community_id' => 3, 'user_id' => 13],
            ['community_id' => 3, 'user_id' => 14],
            ['community_id' => 3, 'user_id' => 15],
            ['community_id' => 4, 'user_id' => 16],
            ['community_id' => 4, 'user_id' => 17],
            ['community_id' => 4, 'user_id' => 18],
            ['community_id' => 4, 'user_id' => 19],
            ['community_id' => 4, 'user_id' => 20],
            ['community_id' => 5, 'user_id' => 21],
            ['community_id' => 5, 'user_id' => 22],
            ['community_id' => 5, 'user_id' => 23],
            ['community_id' => 5, 'user_id' => 24],
            ['community_id' => 5, 'user_id' => 25],
            ['community_id' => 5, 'user_id' => 26],
            ['community_id' => 5, 'user_id' => 27],
        ]);
    }
}
