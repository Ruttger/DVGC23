<?php

namespace Database\Factories;

use App\Category;
use Faker\Generator as Faker;


$factory->define(Category::class, function (Faker $faker) {
        return [
            'title' => $faker->company
        ];
});
