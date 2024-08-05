<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PlansFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->title(),
            'description' => fake()->text(),
            'date' => fake()->date('Y-m-d', '1 year'),
            'participants' => fake()->randomElement([['Samy', 'Maria'], ['Bros', 'Mario']]),
            'location' => fake()->randomElement(['waterpark', 'show park', 'park', 'beach']),
            'user_id' => 1,
        ];
    }
}
