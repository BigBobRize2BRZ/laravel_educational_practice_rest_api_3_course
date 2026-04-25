<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Route;
use App\Models\Trip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buses = Bus::pluck('id')->toArray();
        $routes = Route::pluck('id')->toArray();
        Trip::factory(50)->create([
            'bus_id'   => fn() => fake()->randomElement($buses),
            'route_id' => fn() => fake()->randomElement($routes),
        ]);
    }
}
