<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bus>
 */
class BusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'registration_number' => fake()->unique()->regexify('[A-Z]{2}[0-9]{3}[0-9]{2}'),
            'model' => fake()->randomElement(['Volvo 9700', 'Mercedes Travego', 'Scania Irizar', 'MAN Lion\'s Coach']),
            'seats' => fake()->numberBetween(30, 60),
        ];
    }
}
