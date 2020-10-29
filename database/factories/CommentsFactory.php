<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Comments;
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

$factory->define(Comments::class, function (Faker $faker) {
  return [
      'post_id' => $faker->numberBetween(1,300),
      'user_id' => $faker->numberBetween(1,300),
      'comment' => substr($faker->sentence(3), 0, -1),
      'created_at' => $faker->date,
      'updated_at' => $faker->date,
  ];
});
