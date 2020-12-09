<?php

namespace Database\Factories;

use App\Forum;
use App\Category;
use Faker\Generator as Faker;


$factory->define(Forum::class, function (Faker $faker) {
        return [
            'title' => $faker->catchPhrase,
            'subtitle' => $fakerfaker->jobTitle,
            'category_id' => $faker->faker->numberBetween($min = 1, $max = 3)
        ];
});