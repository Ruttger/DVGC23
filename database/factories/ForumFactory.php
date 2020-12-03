<?php

namespace Database\Factories;

use App\Models\Forum;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ForumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Forum::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->catchPhrase,
            'subtitle' => $this->faker->jobTitle,
            'category_id' => $this->faker->numberBetween($min = 1, $max = 3)
        ];
    }
}
