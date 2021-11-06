<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rating = mt_rand(1000,6000);
        if($rating >= 2000 && $rating < 2500){
           $bracket = 2;
        } else if($rating >= 2500 && $rating < 3000){
            $bracket = 3;
        } else if($rating >= 3000 && $rating < 4000){
            $bracket = 4;
        } else if($rating >= 4000 && $rating < 4500){
            $bracket = 5;
        } else if($rating >= 4500 && $rating < 5000){
            $bracket = 6;
        } else if($rating >= 5000 && $rating < 5500){
            $bracket = 7;
        } else if($rating >= 5500){
           $bracket = 8;
        } else {
            $bracket = 1;
        }

        return [
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->freeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'rating' => $rating,
            'remember_token' => Str::random(10),
            'bracket_id' => $bracket,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
