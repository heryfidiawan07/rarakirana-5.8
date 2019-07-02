<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
    	'name' => $faker->name,
    	'slug' => str_slug($faker->name),
    	'email' => Str::random(10).'@gmail.com',
    	'provider' => null,
    	'provider_id' => null,
    	'img' => 'profile.jpg',
    	'email_verified_at' => now(),
    	'password' => bcrypt('secret'),
    	'token' => Str::random(10),
    	'role' => 0,
    	'status' => 1,
    ];
});
