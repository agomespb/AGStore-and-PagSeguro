<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(AGStore\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'is_admin' => 0,
        'remember_token' => bcrypt(str_random(10)),
    ];
});

$factory->define(AGStore\Models\Category::class, function ($faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
    ];
});
