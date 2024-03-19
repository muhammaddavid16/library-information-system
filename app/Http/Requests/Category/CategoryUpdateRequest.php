<?php

namespace App\Http\Requests\Category;

use App\Contracts\CategoryContract;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CategoryUpdateRequest extends FormRequest
{
    protected CategoryContract $categoryService;

    public function __construct(CategoryContract $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $category = $this->route('category');
        $unique = $this->input('name') !== $category->name ? 'unique:categories,name' : '';

        return [
            'name' => ['required', 'max:100', $unique],
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
