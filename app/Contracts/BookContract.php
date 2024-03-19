<?php

namespace App\Contracts;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface BookContract
{
    public function getAllBooks(): Collection;
    public function getBookById(string $id): Book;
    public function getSortedBooks(string $row): Collection;
    public function getFilteredBooks(?string $keyword, int $perPage = 15): LengthAwarePaginator;
    public function createBook(array $data): Book;
    public function updateBook(Book $book, array $data): Book;
    public function deleteBook(Book $book): bool;
    public function validateBookQuantity(Book $book, int $totalBorrowed): void;
    public function incrementBookQuantity(Book $book, int $totalBorrowed): void;
    public function decrementBookQuantity(Book $book, int $totalBorrowed): void;
}
