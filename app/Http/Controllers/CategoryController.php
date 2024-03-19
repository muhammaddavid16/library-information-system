<?php

namespace App\Http\Controllers;

use App\Contracts\CategoryContract;
use App\Http\Requests\Category\CategoryAddRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    protected CategoryContract $categoryService;

    public function __construct(CategoryContract $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(): Response
    {
        return response()->view('categories.index', [
            'title' => 'Kategori',
            'categories' => $this->categoryService->getFilteredCategories(request('cari')),
        ]);
    }

    public function create(): Response
    {
        return response()->view('categories.create', [
            'title' => 'Tambah Kategori',
        ]);
    }

    public function store(CategoryAddRequest $request): RedirectResponse
    {
        $this->categoryService->createCategory($request->validated());

        return redirect()->route('categories')->with('success', 'Kategori berhasil ditambah.');
    }

    public function edit(Category $category): Response
    {
        return response()->view('categories.edit', [
            'title' => 'Edit Kategori',
            'category' => $category,
        ]);
    }

    public function update(CategoryUpdateRequest $request, Category $category): RedirectResponse
    {
        $this->categoryService->updateCategory($category, $request->validated());

        return redirect()->route('categories')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $this->categoryService->deleteCategory($category);

        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}
