<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $admin = App\User::where('role',1)->first();
    return [
        'user_id' => $admin->id,
        'menu_id' => App\Menu::where('setting',0)->random()->id,
        'title'   => $faker->sentence,
        'slug'    => str_slug($faker->sentence),
        'description' => $faker->paragraph,
        'img'     => 'no-image.jpg',
        'comment' => 1,
        'status'  => 1,
        'sticky'  => rand(1,2),
    ];
});
