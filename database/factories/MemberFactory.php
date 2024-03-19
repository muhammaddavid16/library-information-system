<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MemberFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nis' => Str::random(10),
            'class' => fake('id-ID')->randomElement(['A', 'B', 'C', 'D', 'E']),
            'name' => fake('id-ID')->name(),
            'address' => fake('id-ID')->address(),
            'phone_number' => fake('id-ID')->phoneNumber(),
        ];
    }
}
