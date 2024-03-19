<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        DB::table('categories')->delete();
    }

    public function testInsert(): void
    {
        Category::query()->create([
            'name' => 'MTK',
        ]);

        $category = Category::query()->first();

        self::assertEquals('MTK', $category->name);
    }

    public function testInsertMany(): void
    {
        $categories = [
            ['name' => 'MTK'],
            ['name' => 'IPA'],
        ];

        $result = Category::query()->upsert($categories, ['name']);

        self::assertEquals(2, $result);
    }

    public function testUpdate(): void
    {
        Category::query()->create(['name' => 'MTK']);

        $category = Category::query()->first();
        $category->update(['name' => 'IPA']);

        self::assertEquals('IPA', $category->name);
    }

    public function testUpdateMany(): void
    {
        $categories = [
            ['name' => 'MTK'],
            ['name' => 'IPA'],
        ];

        $result = Category::query()->upsert($categories, ['name']);

        self::assertEquals(2, $result);

        $result = Category::query()->where('description', null)->update(['description' => 'Mata Pelajaran']);

        self::assertEquals(2, $result);
    }

    public function testDelete(): void
    {
        Category::query()->create(['name' => 'MTK']);

        Category::query()->first()->delete();

        $category = Category::query()->first();

        self::assertNull($category);
    }

    public function testDeleteMany(): void
    {
        $categories = [
            ['name' => 'MTK'],
            ['name' => 'IPA'],
        ];

        Category::query()->upsert($categories, ['name']);

        $categories = Category::all()->toArray();
        Category::destroy([$categories[0]['id'], $categories[1]['id']]);

        $categories = Category::all();

        self::assertEquals(0, $categories->count());
    }
}
