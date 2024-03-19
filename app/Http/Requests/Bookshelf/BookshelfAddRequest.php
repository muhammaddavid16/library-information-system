<?php

namespace App\Http\Requests\Bookshelf;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookshelfAddRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'max:100', 'unique:bookshelves,name'],
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
