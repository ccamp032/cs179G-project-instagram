<?php

namespace Database\Seeders;

use App\LikesDislikes;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class LikesDislikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('likes_dislikes')->insert([
            'post_id' => 1,
            'user_id' => 1,
            'like' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        factory(LikesDislikes::class, 300)->create();
    }
}
