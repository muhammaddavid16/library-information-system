<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake('id-ID')->name(),
            'username' => fake('id-ID')->unique()->userName(),
            'password' => Hash::make('secret'),
            'role' => fake('id-ID')->randomElement(['admin', 'staff']),
        ];
    }
}
