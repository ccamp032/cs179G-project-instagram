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
        'img_url' => 'https://media.npr.org/assets/img/2011/09/27/506128252_8907911_wide-1c1f2822dfbc2e71c640269a8b842ecc916ba7be.jpg?s=1400',
        'created_at' => $this->faker->date,
        'created_at' => $this->faker->date,
    ];
});

