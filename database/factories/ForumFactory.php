<?php

use Faker\Generator as Faker;

$factory->define(App\Forum::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,103),
        'category_id' => rand(2,6),//Setting category_id
        'title'   => $faker->sentence,
        'slug'    => str_slug($faker->sentence),
        'description' => $faker->paragraph,
        'comment' => 1,
        'status'  => 1,
    ];
});
