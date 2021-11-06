<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->company(),
            'admin_id' => $this->faker->unique()->randomDigit() + 1,
            'tag' => $this->faker->unique()->word()
        ];
    }
}
