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
            'img_url' => 'https://media.npr.org/assets/img/2011/09/27/506128252_8907911_wide-1c1f2822dfbc2e71c640269a8b842ecc916ba7be.jpg?s=1400',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        factory(Posts::class, 300)->create();
    }
}
