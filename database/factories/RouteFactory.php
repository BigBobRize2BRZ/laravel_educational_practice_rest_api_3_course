<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Route>
 */
class RouteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number_route' => fake()->unique()->numberBetween(100, 999),
            'start_stop' => fake()->streetName(),
            'end_stop' => fake()->streetName(),
            'price' => fake()->numberBetween(500, 5000),
        ];
    }
}
