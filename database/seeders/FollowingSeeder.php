<?php

namespace Database\Seeders;

use App\Following;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FollowingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('followings')->insert([
            'user_id' => 1,
            'follower_user_id' => 2,
            'created_at' => now(), 
            'updated_at' => now(),
        ]);
        factory(Following::class, 300)->create();
    }
}
