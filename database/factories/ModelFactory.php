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
$factory->define(Lendings\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->state(\Lendings\User::class, 'admin', function (\Faker\Generator $faker) {
    return [
        'admin' => true,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Lendings\Item::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Lendings\Lending::class, function (Faker\Generator $faker) {
    return [
        'user_id' => (factory(\Lendings\User::class)->create())->id,
        'item_id' => (factory(\Lendings\Item::class)->create())->id,
    ];
});
