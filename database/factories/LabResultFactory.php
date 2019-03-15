<?php

use Faker\Generator as Faker;

$factory->define(App\Models\LabResult::class, function (Faker $faker) {
    return [
        'herd_number'       => $faker->numberBetween(10000, 50000),
        'date_of_arrival'   => $faker->date($format = 'Y-m-d', $max = 'now'),
        'date_of_test'      => $faker->date($format = 'Y-m-d', $max = 'now'),
        'animal_id'         => $faker->numberBetween(1, 1000),
        'lab_code'          => $faker->randomNumber,
        'test_name'         => $faker->word,
        'type_of_samples'   => $faker->word,
        'reading'           => $faker->word,
        'interpretation'    => $faker->sentence,
        'farmer_name'       => $faker->name,
        'vet_comment'       => $faker->text($maxNbChars = 255),
        'vet_indicator'     => $faker->text($maxNbChars = 255),
        'practice_id'       => $faker->randomNumber,
        'practice_name'     => $faker->company
    ];
});
