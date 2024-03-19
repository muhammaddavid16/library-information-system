<?php

namespace App\Http\Controllers;

use App\Contracts\BookshelfContract;
use App\Http\Requests\Bookshelf\BookshelfAddRequest;
use App\Http\Requests\Bookshelf\BookshelfUpdateRequest;
use App\Models\Bookshelf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class BookshelfController extends Controller
{
    protected BookshelfContract $bookshelfService;

    public function __construct(BookshelfContract $bookshelfService)
    {
        $this->bookshelfService = $bookshelfService;
    }

    public function index(): Response
    {
        return response()->view('bookshelves.index', [
            'title' => 'Rak Buku',
            'bookshelves' => $this->bookshelfService->getFilteredBookshelves(request('cari')),
        ]);
    }

    public function create(): Response
    {
        return response()->view('bookshelves.create', [
            'title' => 'Tambah Rak Buku',
        ]);
    }

    public function store(BookshelfAddRequest $request): RedirectResponse
    {
        $this->bookshelfService->createBookshelf($request->validated());

        return redirect()->route('bookshelves')->with('success', 'Rak Buku berhasil ditambah.');
    }

    public function edit(Bookshelf $bookshelf): Response
    {
        return response()->view('bookshelves.edit', [
            'title' => 'Edit Rak Buku',
            'bookshelf' => $bookshelf,
        ]);
    }

    public function update(BookshelfUpdateRequest $request, Bookshelf $bookshelf): RedirectResponse
    {
        $this->bookshelfService->updateBookshelf($bookshelf, $request->validated());

        return redirect()->route('bookshelves')->with('success', 'Rak Buku berhasil diperbarui.');
    }

    public function destroy(Bookshelf $bookshelf): RedirectResponse
    {
        $this->bookshelfService->deleteBookshelf($bookshelf);

        return back()->with('success', 'Rak Buku berhasil dihapus.');
    }
}
