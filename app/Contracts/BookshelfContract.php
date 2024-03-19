<?php

namespace App\Contracts;

use App\Models\Bookshelf;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface BookshelfContract
{
    public function getBookshelfById(string $id): Bookshelf;
    public function getSortedBookshelves(string $row): Collection;
    public function getFilteredBookshelves(?string $keyword, int $perPage = 15): LengthAwarePaginator;
    public function createBookshelf(array $data): Bookshelf;
    public function updateBookshelf(Bookshelf $bookshelf, array $data): Bookshelf;
    public function deleteBookshelf(Bookshelf $bookshelf): bool;
}
