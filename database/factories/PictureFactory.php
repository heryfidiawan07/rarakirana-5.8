<?php

use App\Picture;
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

$factory->define(Picture::class, function (Faker $faker) {
    $product_id = App\Product::pluck('id');
    return [
        'product_id' => $product_id->random(),
        'img' => 'no-image.png',
        'main' => 0,
    ];
});
