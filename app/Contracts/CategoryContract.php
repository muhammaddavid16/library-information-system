<?php

namespace App\Contracts;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryContract
{
    public function getCategoryById(string $id): Category;
    public function getSortedCategories(string $row): Collection;
    public function getFilteredCategories(?string $keyword, int $perPage = 15): LengthAwarePaginator;
    public function createCategory(array $data): Category;
    public function updateCategory(Category $category, array $data): Category;
    public function deleteCategory(Category $category): bool;
}
