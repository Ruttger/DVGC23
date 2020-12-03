<?php

namespace Database\Factories;

use App\Models\Thread;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThreadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Thread::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->bs,
            'body' => $this->faker->text($maxNbChars = 200),
            'latest_reply' => '0',
            'forum_id' => $this->faker->numberBetween($min = 1, $max = 6),
            'user_id' => $this->faker->numberBetween($min = 1, $max = 10)
        ];
    }
}
