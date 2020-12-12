<?php

namespace Database\Seeders;

use App\ImgUrl;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ImgUrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(ImgUrl::class, 301)->create();
    }
}
