<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $admin = App\User::where('role',1)->first();
    return [
        'user_id' => $admin->id,
        'menu_id' => 1,//Setting manu_id
        'title'   => $faker->sentence,
        'slug'    => str_slug($faker->sentence),
        'description' => $faker->paragraph,
        'img'     => null,
        'comment' => 1,
        'status'  => 1,
        'sticky'  => 0,
    ];
});
