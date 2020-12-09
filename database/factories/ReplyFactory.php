<?php

namespace Database\Factories;

use App\Reply;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'body' => $faker->text($maxNbChars = 200),
        'thread_id' => $faker->numberBetween($min = 1, $max = 20),
        'user_id' => $faker->numberBetween($min = 1, $max = 10)
    ];
});
