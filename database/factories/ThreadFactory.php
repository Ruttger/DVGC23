<?php

namespace Database\Factories;

use App\Thread;
use Faker\Generator as Faker;


$factory->define(Thread::class, function (Faker $faker) {
    return [
        'title' => $faker->bs,
        'body' => $faker->text($maxNbChars = 200),
        'latest_reply' => '0',
        'forum_id' => $faker->numberBetween($min = 1, $max = 6),
        'user_id' => $faker->numberBetween($min = 1, $max = 10)
    ];
});
