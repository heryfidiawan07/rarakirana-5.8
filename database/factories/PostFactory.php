<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $admin = App\User::where('role',1)->first();
    return [
        'user_id' => $admin->id,
        'menu_id' => ,
        'title',
        'slug',
        'description',
        'img',
        'comment',
        'status',
        'sticky',
    ];
});
