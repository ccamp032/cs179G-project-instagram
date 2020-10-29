<?php

namespace Database\Seeders;

use App\Comments;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('comments')->insert([
          'post_id' => 1,
          'user_id' => 1,
          'comment' => 'This is a new comment!',
          'created_at' => now(),
          'updated_at' => now()
      ]);

      factory(Comments::class, 300)->create();
    }
}
