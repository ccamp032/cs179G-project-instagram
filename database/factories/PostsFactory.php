<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Posts;
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

$factory->define(Posts::class, function (Faker $faker) {
    return [
        'user_id' => $this->faker->numberBetween(1,300),
        'description' => substr($this->faker->sentence(3), 0, -1),
        'views' => $this->faker->numberBetween(1,1000),
        'created_at' => $this->faker->date,
        'created_at' => $this->faker->date,
    ];
});
