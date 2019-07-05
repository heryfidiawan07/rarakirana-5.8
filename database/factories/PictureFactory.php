<?php

use Faker\Generator as Faker;

$factory->define(App\Picture::class, function (Faker $faker) {
    return [
        'product_id' => rand(1,200),
        'img' => 'no-image.png',
        'main' => 0,
    ];
});
