<?php

namespace App\Http\Controllers;

use App\Contracts\BookContract;
use App\Contracts\BookshelfContract;
use App\Contracts\CategoryContract;
use App\Http\Requests\Book\BookAddRequest;
use App\Http\Requests\Book\BookUpdateRequest;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class BookController extends Controller
{
    protected BookContract $bookService;
    protected BookshelfContract $bookshelfService;
    protected CategoryContract $categoryService;

    public function __construct(
        BookContract $bookService,
        BookshelfContract $bookshelfService,
        CategoryContract $categoryService,
    ) {
        $this->bookService = $bookService;
        $this->bookshelfService = $bookshelfService;
        $this->categoryService = $categoryService;
    }

    public function index(): Response
    {
        return response()->view('books.index', [
            'title' => 'Buku',
            'books' => $this->bookService->getFilteredBooks(request('cari')),
        ]);
    }

    public function create(): Response
    {
        $bookshelves = $this->bookshelfService->getSortedBookshelves('name');
        $categories = $this->categoryService->getSortedCategories('name');

        return response()->view('books.create', [
            'title' => 'Tambah Buku',
            'bookshelves' => $bookshelves->toArray(),
            'categories' => $categories->toArray(),
        ]);
    }

    public function store(BookAddRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->bookService->createBook($validated);

        return redirect()->route('books')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book): Response
    {
        $bookshelves = $this->bookshelfService->getSortedBookshelves('name');
        $categories = $this->categoryService->getSortedCategories('name');

        return response()->view('books.edit', [
            'title' => 'Edit Buku',
            'book' => $book,
            'bookshelves' => $bookshelves->toArray(),
            'categories' => $categories->toArray(),
        ]);
    }

    public function update(BookUpdateRequest $request, Book $book): RedirectResponse
    {
        $validated = $request->validated();

        $this->bookService->updateBook($book, $validated);

        return redirect()->route('books')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $this->bookService->deleteBook($book);

        return back()->with('success', 'Buku berhasil dihapus.');
    }
}
