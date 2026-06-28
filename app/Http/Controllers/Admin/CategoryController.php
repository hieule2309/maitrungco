<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Services\Admin\CategoryService;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService)
    {
    }

    public function index()
    {
        $search       = request('search');
        $categories   = $this->categoryService->getAll();
        $categoryTree = $this->categoryService->getTreeForIndex($search);

        return view('admin.categories.index', compact('categories', 'categoryTree', 'search'));
    }

    public function create()
    {
        $parentOptions = $this->categoryService->getParentOptions();
        $defaultIcon = $this->categoryService->getDefaultIcon();

        return view('admin.categories.create', compact('parentOptions', 'defaultIcon'));
    }

    public function store(CategoryRequest $request)
    {
        $this->categoryService->store($request->validated());

        return redirect()->route('admin.categories.index')
            ->with('success', 'Tạo danh mục thành công.');
    }

    public function edit(Category $category)
    {
        $parentOptions = $this->categoryService->getParentOptions($category);
        $defaultIcon = $this->categoryService->getDefaultIcon();

        return view('admin.categories.edit', compact('category', 'parentOptions', 'defaultIcon'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $this->categoryService->update($category, $request->validated());

        return redirect()->route('admin.categories.index')
            ->with('success', 'Cập nhật danh mục thành công.');
    }

    public function destroy(Category $category)
    {
        $this->categoryService->delete($category);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Xóa danh mục thành công.');
    }
}