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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Adjustment::class, function (Faker\Generator $faker) {
    return [
        'neighbourhood_id' => 1,
        'title' => $faker->city,
        'description' => $faker->sentence(5),
        'google_id' => "Ei1LYXN0YW5qZXNpbmdlbCAxMDEsIDMwNTMgUm90dGVyZGFtLCBOZWRlcmxhbmQ",
    ];
});

$factory->define(App\Reaction::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->sentence(2),
        'user_id' => 1,
    ];
});

$factory->define(App\Vote::class, function (Faker\Generator $faker) {
    $reaction = App\Reaction::take(1)->get();
    $user = App\User::take(1)->get();
    return [
        'vote' => $faker->boolean(),
        'reaction_id' => $reaction[0]->id,
        'user_id' => $user[0]->id,
    ];
});

