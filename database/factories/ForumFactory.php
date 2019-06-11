<?php

use App\Forum;
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

$factory->define(Forum::class, function (Faker $faker) {
    $user_id = App\User::pluck('id');
    $category_id = App\Category::pluck('id');
    return [
        'user_id' => $user_id->random(),
        'category_id' => $category_id->random(),
        'title' => $faker->sentence(10),
        'slug' => str_slug($faker->sentence(10)),
        'description' => $faker->sentence(150),
        'comment' => 1,
        'status' => 1,
    ];
});
