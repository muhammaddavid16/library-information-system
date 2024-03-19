<?php

namespace App\Services;

use App\Contracts\CategoryContract;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;

class CategoryService implements CategoryContract
{
    public function getCategoryById(string $id): Category
    {
        return Category::findOrFail($id);
    }

    public function getSortedCategories(string $row): Collection
    {
        return Category::all()->sortBy($row);
    }

    public function getFilteredCategories(?string $keyword, int $perPage = 15): LengthAwarePaginator
    {
        $categories = Category::latest()
            ->filter($keyword)
            ->paginate($perPage)
            ->withQueryString();

        return $categories;
    }

    public function createCategory(array $data): Category
    {
        return Category::create($data);
    }

    public function updateCategory(Category $category, array $data): Category
    {
        $category->update($data);

        return $category;
    }

    public function deleteCategory(Category $category): bool
    {
        if ($category->books()->get()->count() > 0) {
            throw ValidationException::withMessages([
                'error' => 'Tidak dapat menghapus kategori karena terdapat referensi buku terkait.',
            ]);
        }

        return $category->delete();
    }
}
