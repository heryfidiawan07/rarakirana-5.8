<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,103),
        'commentable_id' => rand(1,200),
        'commentable_type'   => 'App\Forum',
        'description' => $faker->paragraph,
        'status'  => 1,
        'parent_id' => rand(2051,2400),//get from comment->id
    ];
});
