<?php

namespace App\Http\Requests\Bookshelf;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookshelfUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $bookshelf = $this->route('bookshelf');
        $unique = $this->input('name') !== $bookshelf->name ? 'unique:bookshelves,name' : '';

        return [
            'name' => ['required', 'max:100', $unique],
            'description' => ['nullable'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Rak buku',
            'description' => 'Keterangan',
        ];
    }
}
