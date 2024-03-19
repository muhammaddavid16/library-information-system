<?php

namespace App\Services;

use App\Contracts\BookshelfContract;
use App\Models\Bookshelf;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;

class BookshelfService implements BookshelfContract
{
    public function getBookshelfById(string $id): Bookshelf
    {
        return Bookshelf::findOrFail($id);
    }

    public function getSortedBookshelves(string $row): Collection
    {
        return Bookshelf::all()->sortBy($row);
    }

    public function getFilteredBookshelves(?string $keyword, int $perPage = 15): LengthAwarePaginator
    {
        $bookshelves = Bookshelf::latest()
            ->filter($keyword)
            ->paginate($perPage)
            ->withQueryString();

        return $bookshelves;
    }

    public function createBookshelf(array $data): Bookshelf
    {
        return Bookshelf::create($data);
    }

    public function updateBookshelf(Bookshelf $bookshelf, array $data): Bookshelf
    {
        $bookshelf->update($data);

        return $bookshelf;
    }

    public function deleteBookshelf(Bookshelf $bookshelf): bool
    {
        if ($bookshelf->books()->get()->count() > 0) {
            throw ValidationException::withMessages([
                'error' => 'Tidak dapat menghapus rak buku karena terdapat referensi buku terkait.',
            ]);
        }

        return $bookshelf->delete();
    }
}
