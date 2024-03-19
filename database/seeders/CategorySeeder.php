<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::query()->upsert([
            ['name' => 'MTK'],
            ['name' => 'IPA'],
            ['name' => 'IPS'],
        ], ['name']);
    }
}
