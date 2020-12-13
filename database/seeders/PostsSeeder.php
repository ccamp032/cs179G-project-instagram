<?php

namespace Database\Seeders;

use App\Posts;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'user_id' => 1,
            'description' => 'Cute Pandas Sleeping',
            'views' => 3,
            'misc_tags' => 'test,cars,cute',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        factory(Posts::class, 300)->create();
    }
}
