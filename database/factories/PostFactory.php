<?php

use App\Post;
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

$factory->define(Post::class, function (Faker $faker) {
    $user_id = App\User::where('role',1)->first();
    $menu_id = App\Menu::where('id',1)->pluck('id');//Pilih id dengan menu post
    return [
        'user_id' => $user_id->id,
        'menu_id' => $menu_id->random(),
        'title' => $faker->sentence(10),
        'slug' => str_slug($faker->sentence(10)),
        'description' => $faker->sentence(150),
        'img' => null,
        'comment' => 1,
        'status' => 1,
        'sticky' => 0,
    ];
});
