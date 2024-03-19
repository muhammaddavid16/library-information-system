<?php

namespace Database\Seeders;

use App\Models\Bookshelf;
use Illuminate\Database\Seeder;

class BookshelfSeeder extends Seeder
{
    public function run(): void
    {
        Bookshelf::query()->upsert([
            ['name' => 'Rak A'],
            ['name' => 'Rak B'],
            ['name' => 'Rak C'],
            ['name' => 'Rak D'],
            ['name' => 'Rak E'],
        ], ['name']);
    }
}
