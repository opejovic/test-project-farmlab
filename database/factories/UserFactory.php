<?php

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

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'type' => App\Models\User::VET,
        'status' => 'NOT_VERIFIED',
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Practice::class, function (Faker $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(App\Models\LabResult::class, function (Faker $faker) {
    return [
        'herd_number' => $faker->randomNumber,
        'date_of_arrival' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'date_of_test' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'animal_id' => $faker->numberBetween(1, 1000),
        'lab_code' => $faker->randomNumber,
        'test_name' => $faker->word,
        'type_of_samples' => $faker->word,
        'reading' => $faker->word,
        'interpretation' => $faker->sentence,
        'farmer_name' => $faker->name,
        'vet_comment' => $faker->sentence,
        'vet_indicator' => $faker->sentence,
        'practice_id' => $faker->numberBetween(1,20),
        'practice_name' => $faker->word
    ];
});

