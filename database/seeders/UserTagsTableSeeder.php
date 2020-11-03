<?php

namespace Database\Seeders;

use App\UserTags;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('user_tags')->insert([
          'post_id' => 1,
          'user_id' => 1,
          'user_name' => 'Franklin Joey',
          'created_at' => now(),
          'updated_at' => now()
      ]);

      factory(UserTags::class, 300)->create();
    }
}
