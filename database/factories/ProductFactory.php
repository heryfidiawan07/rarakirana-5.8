<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    $admin = App\User::where('role',1)->first();
    return [
        'user_id' => $admin->id,
        'etalase_id' => rand(3,5),//Setting menu_id
        'title'   => $faker->sentence,
        'slug'    => str_slug($faker->sentence),
        'first_price' => $first = rand ( 10000 , 99999 ),
        'discount' => $disc = rand ( 1000 , 9999 ),
        'price' => $first-$disc,
        'weight' => 1,
        'description' => $faker->paragraph,
        'type' => rand(0,1),
        'comment' => rand(0,1),
        'status'  => rand(0,1),
        'sticky'  => rand(0,1),
    ];
});
