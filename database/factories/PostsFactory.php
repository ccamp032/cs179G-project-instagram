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
    $miscList = array(
      "cars",
      "trucks",
      "beach",
      "cute",
      "ugly",
      "school",
      "liberal",
      "hippo",
      "test",
      "california",
      "love",
      "instagood",
      "photooftheday",
      "fashion",
      "beautiful",
      "happy",
      "cute",
      "tbt",
      "like4like",
      "followme",
      "picoftheday",
      "follow",
      "me",
      "selfie",
      "summer",
      "art",
      "instadaily",
      "friends",
      "repost",
      "nature",
      "girl",
      "fun",
      "style",
      "smile",
      "food",
      "instalike",
      "likeforlike",
      "family",
      "travel",
      "fitness",
      "igers",
      "tagsforlikes",
      "follow4follow",
      "nofilter",
      "life",
      "beauty",
      "amazing",
      "instamood",
      "instagram",
      "photography"
    );

    $rand_keys = array_rand($miscList, 2);

    return [
        'user_id' => $this->faker->numberBetween(1,300),
        'description' => substr($this->faker->sentence(3), 0, -1),
        'views' => $this->faker->numberBetween(1,1000),
        'misc_tags' => $miscList[$rand_keys[0]] . "," . $miscList[$rand_keys[1]],
        'created_at' => $this->faker->date,
        'created_at' => $this->faker->date,
    ];
});
