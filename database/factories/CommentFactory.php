<?php

use App\Comment;
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

$factory->define(Comment::class, function (Faker $faker) {
    $user_id = App\User::pluck('id');
    $commentable_id = App\Forum::pluck('id');
    $parent_id = App\Comment::where('commentable_type','App\Forum')->pluck('id');
    return [
        'user_id' => $user_id->random(),
        'commentable_id' => $commentable_id->random(),
        'commentable_type' => 'App\Forum',
        'description' => $faker->sentence(50),
        'status' => 1,
        'parent_id' => $parent_id->random(),
    ];
});
