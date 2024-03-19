<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookAddRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $max = "max:" . date('Y');
        return [
            'category_id' => ['required', 'max:36', 'exists:categories,id'],
            'bookshelf_id' => ['required', 'max:36', 'exists:bookshelves,id'],
            'isbn' => ['required', 'max:100', 'unique:books,isbn'],
            'title' => ['required', 'max:100', 'unique:books,title'],
            'publisher' => ['required', 'max:100'],
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
            'publisher' => 'Penerbit',
            'publication_year' => 'Tahun terbit',
            'quantity' => 'Stok buku',
        ];
    }
}
