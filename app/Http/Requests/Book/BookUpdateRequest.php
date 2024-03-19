<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $book = $this->route('book');
        $isbn_unique = $this->input('isbn') !== $book->isbn ? 'unique:books,isbn' : '';
        $title_unique = $this->input('title') !== $book->title ? 'unique:books,title' : '';
        $max = "max:" . date('Y');

        return [
            'category_id' => ['required', 'max:36'],
            'bookshelf_id' => ['required', 'max:36'],
            'isbn' => ['required', 'max:100', $isbn_unique],
            'title' => ['required', 'max:100', $title_unique],
            'publication_year' => ['required', 'integer', 'min:1900', $max],
            'quantity' => ['nullable', 'integer', 'min:0']
        ];
    }

    public function attributes(): array
    {
        return [
            'category_id' => 'Kategori',
            'bookshelf_id' => 'Rak buku',
            'isbn' => 'ISBN',
            'title' => 'Judul',
            'publication_year' => 'Tahun terbit',
            'quantity' => 'Stok buku',
        ];
    }
}
