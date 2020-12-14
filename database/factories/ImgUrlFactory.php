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
    "https://randomwordgenerator.com/img/picture-generator/54e0d6424f51a514f1dc8460962e33791c3ad6e04e5074417c2e7dd1934dc2_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e6d0424950a914f1dc8460962e33791c3ad6e04e50744172287ad2964cc0_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/52e0d7414a5aad14f1dc8460962e33791c3ad6e04e507440712f7bd6954bc5_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/55e7d2464e57a814f1dc8460962e33791c3ad6e04e5074417c2d78d39545c6_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e7d54b4b51a514f1dc8460962e33791c3ad6e04e507441722978d69f48c6_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/54e8dd424b55ae14f1dc8460962e33791c3ad6e04e5074417c2f7dd6914fc3_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/54e1dc424b57a914f1dc8460962e33791c3ad6e04e50744074267ad09f44c1_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e9d04b4a5aaf14f1dc8460962e33791c3ad6e04e507440722d72d09245c7_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e4d0444255ae14f1dc8460962e33791c3ad6e04e5074417c2f7cd39044c4_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/54e0d1404d55af14f1dc8460962e33791c3ad6e04e507440752b7fd49548cc_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/53e3dd404c52ab14f1dc8460962e33791c3ad6e04e507440712c7add964dcd_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/52e2d3474c51b10ff3d8992cc12c30771037dbf85254794075297ad59e4e_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/5ee2d3424a57b10ff3d8992cc12c30771037dbf85254794e722679d7934d_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e5dd464d54ac14f1dc8460962e33791c3ad6e04e50744172297ed29f4bc4_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/55e1d7464c55ac14f1dc8460962e33791c3ad6e04e50744074267bd6934fc2_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/54e5d1464d56a914f1dc8460962e33791c3ad6e04e5074417d2e72d6904fc6_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e9d5444e5ba814f1dc8460962e33791c3ad6e04e50744172287ad2944cc3_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/55e3d24a4f55a414f1dc8460962e33791c3ad6e04e50744172287ad29749c3_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e8d64a4d56a514f1dc8460962e33791c3ad6e04e507440762e79d79649c7_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/55e4d545425aa514f1dc8460962e33791c3ad6e04e507440742f7cd0944fcd_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/53e6dc404951b10ff3d8992cc12c30771037dbf852547848702e7ed19348_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/54e6d6474e53ae14f1dc8460962e33791c3ad6e04e5074417c2e7dd19245c0_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/piranhas-123287_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/5ee2d1404d52b10ff3d8992cc12c30771037dbf85254784a70287fd2924f_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/54e3d0414b54a914f1dc8460962e33791c3ad6e04e507749712a72d3954dcd_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/52e3dd40435bb10ff3d8992cc12c30771037dbf85254794e702672d69f4b_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/53e1d24b4b51af14f1dc8460962e33791c3ad6e04e507440742f7cd0954ccc_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/joshua-coleman-qbO7Mlhq8PQ-unsplash.jpg",
    "https://randomwordgenerator.com/img/picture-generator/54e6d14b4d55a814f1dc8460962e33791c3ad6e04e507441722779d49448cd_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/55e0dc4a4c56aa14f1dc8460962e33791c3ad6e04e507440742f7cd79f48c3_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/51e1d2454256b10ff3d8992cc12c30771037dbf85254784973267ddd914b_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/53e9d1474c53b10ff3d8992cc12c30771037dbf85254784c772d7cdc9248_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/53e3d6414d52aa14f1dc8460962e33791c3ad6e04e507440762e7ad3964acc_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/54e6d5464f52ae14f1dc8460962e33791c3ad6e04e50744172297cdc9e48c3_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/52e0d0414852af14f1dc8460962e33791c3ad6e04e507440742f7cd7914ec0_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/5fe5dc474c56b10ff3d8992cc12c30771037dbf85257714b752d72dc9144_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/55e4d54a4e5baa14f1dc8460962e33791c3ad6e04e507440752f72d39344c0_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/5fe6dd404956b10ff3d8992cc12c30771037dbf85254794e7d2b78dd954f_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/55e8d146425bb10ff3d8992cc12c30771037dbf852547848702a7fd19545_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e6d04b4e51aa14f1dc8460962e33791c3ad6e04e507440752f73dd9544c5_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/52e8d14b4956ac14f1dc8460962e33791c3ad6e04e50744172297cdc9049c4_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e1d0434a56a914f1dc8460962e33791c3ad6e04e50744172287ed3974ccd_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e3d3474254a514f1dc8460962e33791c3ad6e04e50744172287ad2964cc0_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/52e4d1474351b10ff3d8992cc12c30771037dbf852547848702a7fd0904f_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e5dd464d54ac14f1dc8460962e33791c3ad6e04e50744172297ed29f4bc4_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/53e4d4404b54a914f1dc8460962e33791c3ad6e04e507749742c78d69e48c1_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/stones-167089_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e5d1444250a814f1dc8460962e33791c3ad6e04e5074417c2f7dd4914ac7_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/52e2d6414f51a814f1dc8460962e33791c3ad6e04e507440702d7edc9e4bc5_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e2d64a4d50a814f1dc8460962e33791c3ad6e04e507441722a72dd9f4dc1_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/54e8d74b4b54a914f1dc8460962e33791c3ad6e04e507749772772d6964dc0_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e1d14a4b52ac14f1dc8460962e33791c3ad6e04e50744074267bd6944bcc_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/54e3d0424e56a414f1dc8460962e33791c3ad6e04e507441722a72dc9f4ecd_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/54e4d6474356ad14f1dc8460962e33791c3ad6e04e5074417d2d73dc974fcc_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/54e3dd414d55a514f1dc8460962e33791c3ad6e04e5074417d2e72dd954fcd_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e4d0454853a814f1dc8460962e33791c3ad6e04e5074417c2a79dd944acc_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/55e1d2444856a514f1dc8460962e33791c3ad6e04e50744172297ed29248c7_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/53e3d342435baa14f1dc8460962e33791c3ad6e04e507440762673d69148cd_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/54e6d4474f50a814f1dc8460962e33791c3ad6e04e5074417c2c7fd59e48c3_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/52e1d04b4856a814f1dc8460962e33791c3ad6e04e507440762e7adc9249c5_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/55e1d74b4a55ab14f1dc8460962e33791c3ad6e04e5074417c2e7dd29145c3_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/54e6d14b4d55a814f1dc8460962e33791c3ad6e04e507441722779d49448cd_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e7d4414d51a814f1dc8460962e33791c3ad6e04e50744172287cd09e49cd_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/53e2d0464950aa14f1dc8460962e33791c3ad6e04e507440742a7ad59f49c3_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/52e2d0434f53b10ff3d8992cc12c30771037dbf852547941742673d2964b_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e4dd424f5baa14f1dc8460962e33791c3ad6e04e5074417c2d78d19748cd_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e4d5424850a914f1dc8460962e33791c3ad6e04e50744172297cd5914cc7_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e7d54a4b50ab14f1dc8460962e33791c3ad6e04e507440772d73d49745c0_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/54e9d1474354a814f1dc8460962e33791c3ad6e04e50744172297cdc9e4fc4_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e3dd424851ac14f1dc8460962e33791c3ad6e04e507441722a72dd914fc7_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e6d64b4c54a414f1dc8460962e33791c3ad6e04e507440752972d3934acc_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e2d74a4d55ae14f1dc8460962e33791c3ad6e04e507441722978d69f4ac2_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e0d6474e56ae14f1dc8460962e33791c3ad6e04e507440752f73dd9249c4_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/54e5d2434953a514f1dc8460962e33791c3ad6e04e507440742f7cd09645cc_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/57e5d74a4f57af14f1dc8460962e33791c3ad6e04e50744172297cd69745c5_640.jpg",
    "https://randomwordgenerator.com/img/picture-generator/55e6d04a4f56a414f1dc8460962e33791c3ad6e04e507440722d72d19548c1_640.jpg
  );

  $rand_keys = array_rand($photoList, 2);
  return [
      'id' => $order++,
      'url' => $photoList[$rand_keys[0]],
  ];
});
