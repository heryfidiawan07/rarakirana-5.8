<?php

use App\Product;
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

$factory->define(Product::class, function (Faker $faker) {
    $user_id     = App\User::where('role',1)->first();
    $etalase_id  = App\Etalase::pluck('id');
    $first_price = $faker->randomNumber(5);
    $discount    = $faker->randomNumber(3);
    return [
        'user_id' => $user_id->id,
        'etalase_id' => $etalase_id->random(),
        'title' => $faker->sentence(10),
        'slug' => str_slug($faker->sentence(10)),
        'first_price' => $first_price,
        'discount' => $discount,
        'price' => $first_price-$discount,
        'weight' => $faker->randomNumber(3),
        'description' => $faker->sentence(100),
        'type' => 0,
        'comment' => 1,
        'status' => 1,
        'sticky' => 0,
    ];
});
