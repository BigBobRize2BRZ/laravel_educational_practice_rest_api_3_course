<?php

namespace Database\Factories;

use App\Models\Bus;
use App\Models\Route;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departure = fake()->dateTimeBetween('+1 minute', '+120 minutes');
        
        $durationMinutes = fake()->numberBetween(30, 120);
        
        // Клонируем и прибавляем минуты
        $arrival = (clone $departure)->modify('+' . $durationMinutes . ' minutes');

        return [
            'number_trip'     => fake()->unique()->regexify('TR[0-9]{4}'),
            'departure_date'  => $departure,
            'arrival_date'    => $arrival,
            'bus_id'          => Bus::factory(),
            'route_id'        => Route::factory(),
        ];
    }
}
