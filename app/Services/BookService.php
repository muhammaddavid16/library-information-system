<?php

namespace App\Services;

use App\Contracts\BookContract;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;

class BookService implements BookContract
{
    public function getBookById(string $id): Book
    {
        return Book::find($id);
    }

    public function getAllBooks(): Collection
    {
        return Book::all();
    }

    public function getSortedBooks(string $row): Collection
    {
        return Book::all()->sortBy($row);
    }

    public function getFilteredBooks(?string $keyword, int $perPage = 15): LengthAwarePaginator
    {
        $books = Book::latest()
            ->with(['category:id,name', 'bookshelf:id,name'])
            ->filter($keyword)
            ->paginate($perPage)
            ->withQueryString();

        return $books;
    }

    public function createBook(array $data): Book
    {
        return Book::create($data);
    }

    public function updateBook(Book $book, array $data): Book
    {
        $book->update($data);

        return $book;
    }

    public function deleteBook(Book $book): bool
    {
        if ($book->loans()->get()->count() > 0) {
            throw ValidationException::withMessages([
                'error' => 'Tidak dapat menghapus buku karena terdapat riwayat peminjaman yang terkait.',
            ]);
        }

        return $book->delete();
    }

    public function validateBookQuantity(Book $book, int $totalBorrowed): void
    {
        if ($book->quantity < $totalBorrowed) {
            throw ValidationException::withMessages([
                'error' => 'Stok buku tidak cukup.'
            ]);
        }
    }

    public function incrementBookQuantity(Book $book, int $totalBorrowed): void
    {
        $book->increment('quantity', $totalBorrowed);
    }

    public function decrementBookQuantity(Book $book, int $totalBorrowed): void
    {
        $book->decrement('quantity', $totalBorrowed);
    }
}
