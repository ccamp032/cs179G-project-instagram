<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class FollowersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('followers')->insert([
            'user_id' => 1,
            'follower_user_id' => 2,
            'created_at' => now(), 
            'updated_at' => now(),
        ]);

        factory(Followers::class, 300)->create();
    }
}
