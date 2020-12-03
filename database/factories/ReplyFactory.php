<?php

namespace Database\Factories;

use App\Models\Reply;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'body' => $this->faker->text($maxNbChars = 200),
            'thread_id' => $this->faker->numberBetween($min = 1, $max = 20),
            'user_id' => $this->faker->numberBetween($min = 1, $max = 10)
        ];
    }
}
