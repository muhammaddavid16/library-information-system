<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CategoryAddRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'max:100', 'unique:categories,name'],
            'description' => ['nullable'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Kategori',
            'description' => 'Keterangan',
        ];
    }
}
