<?php

use App\LikesDislikes;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/


$factory->define(LikesDislikes::class, function (Faker $faker) {
    return [
        'post_id' => $this->faker->numberBetween(1,300),
        'user_id' => $this->faker->numberBetween(1,300),
        'like' => $this->faker->numberBetween(0,1),
        'created_at' => $this->faker->date,
        'updated_at' => $this->faker->date,
    ];
});
