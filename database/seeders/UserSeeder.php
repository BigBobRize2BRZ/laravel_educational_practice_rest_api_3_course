<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name'   => 'Admin',
            'email'  => 'admin@example.com',
            'status' => 'admin',
            'password' => Hash::make('123456'),
        ]);

        User::factory()->create([
            'name'   => 'Dispatcher',
            'email'  => 'dispatcher@example.com',
            'status' => 'dispatcher',
            'password' => Hash::make('123456'),
        ]);

        User::factory()->create([
            'name'   => 'User',
            'email'  => 'user@example.com',
            'status' => 'user',
            'password' => Hash::make('123456'),
        ]);

        User::factory(10)->state(['status' => 'user'])->create();

        // 3 диспетчера
        User::factory(3)->state(['status' => 'dispatcher'])->create();

        // 2 администратора
        User::factory(2)->state(['status' => 'admin'])->create();
    }
}
