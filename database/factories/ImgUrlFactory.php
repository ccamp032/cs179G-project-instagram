<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\ImgUrl;
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

$factory->define(ImgUrl::class, function (Faker $faker) {
  static $order = 1;
  $photoList = array(
    "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTznJY42HY7TZWOtpXyK8qtNRCxOlqAdO-K2A&usqp=CAU",
    "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTiewTwkoI6MS1ubj4_YdkM9CIha4M4zWAucw&usqp=CAU",
    "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTxKguP5FQz3yazJle30XVWxS3UB-ln-t6Q7A&usqp=CAU",
    "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQBoTTo0ZYCnPKmPAYB7wlVAJzeeLZgwPKSIQ&usqp=CAU",
    "https://pbs.twimg.com/profile_images/643842097389404160/FtHFWCPm.jpg",
    "https://i.pinimg.com/originals/e3/fb/ef/e3fbef15feee2db849cc716baf4cfc1a.jpg",
    "https://cdn.pixabay.com/photo/2013/02/26/05/37/lavizzara-86229_960_720.jpg",
    "https://randomwordgenerator.com/img/picture-generator/51e8dd454c50b10ff3d8992cc12c30771037dbf85254784c772d7cdd9e45_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/52e0d4404e57ac14f1dc8460962e33791c3ad6e04e507440722d72d0914bc5_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/52e0dd414355b10ff3d8992cc12c30771037dbf852547940772c7dd69e4a_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/52e1d2464254a814f1dc8460962e33791c3ad6e04e507440702d79d2914bcd_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/52e3d6464353a414f1dc8460962e33791c3ad6e04e50744172287ad39644cc_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/52e3d7434b51aa14f1dc8460962e33791c3ad6e04e5074417c2f7cd3944dc4_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/52e3dd404354b10ff3d8992cc12c30771037dbf852547940772c7cd59649_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/52e4d1424f5aa914f1dc8460962e33791c3ad6e04e5074417d2e72d2954ac5_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/52e4d2464356af14f1dc8460962e33791c3ad6e04e5074417d2e72d6934cc5_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/53e0d5464f51a814f1dc8460962e33791c3ad6e04e507441722a72dc9e48c3_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/53e2d34a4956a514f1dc8460962e33791c3ad6e04e50744076297cd5964fc6_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/53e2d6434952aa14f1dc8460962e33791c3ad6e04e507440742f7cd79249c7_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/53e3d7474b56a514f1dc8460962e33791c3ad6e04e507440762e7ad3964acc_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/53e7d4464d52aa14f1dc8460962e33791c3ad6e04e50774971267bd19549c6_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/53e9d1404f52b10ff3d8992cc12c30771037dbf85254794e702673d0934d_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/54e0d1464e54a514f1dc8460962e33791c3ad6e04e507440762e7adc934bc7_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/54e0d6424f51a514f1dc8460962e33791c3ad6e04e5074417c2e7dd1934dc2_640.jpg"
  );

  $rand_keys = array_rand($photoList, 2);
  return [
      'id' => $order++,
      'url' => $photoList[$rand_keys[0]],
  ];
});
