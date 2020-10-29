<?php


use App\Following;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


$factory->define(Following::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,300),
        'follower_user_id' => $this->$faker->numberBetween(1,300),
        'created_at' => $this->$faker->date,
        'updated_at' => $this->$faker->date,
    ];
});
