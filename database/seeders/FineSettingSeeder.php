<?php

namespace Database\Seeders;

use App\Models\FineSetting;
use Illuminate\Database\Seeder;

class FineSettingSeeder extends Seeder
{
    public function run(): void
    {
        FineSetting::query()->create([
            'is_active' => false,
            'fine_rate' => 3000,
        ]);
    }
}
