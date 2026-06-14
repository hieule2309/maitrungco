<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Services\Admin\ProductService;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService)
    {
    }

    public function index()
    {
        $products   = $this->productService->getAll(request()->only(['search', 'active', 'category_id']));
        $categories = Category::orderBy('name')->get(['id', 'name']);
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $formData = $this->productService->getFormData();
        return view('admin.products.create', $formData);
    }

    public function store(ProductStoreRequest $request)
    {
        $this->productService->store($request->validated(), $request->allFiles());
        return redirect()->route('admin.products.index')
            ->with('success', 'Tạo sản phẩm thành công.');
    }

    public function edit(int $id)
    {
        $product  = $this->productService->getById($id);
        $formData = $this->productService->getFormData();
        return view('admin.products.edit', array_merge($formData, compact('product')));
    }

    public function update(ProductRequest $request, int $id)
    {
        $this->productService->update($id, $request->validated(), $request->allFiles());
        return redirect()->route('admin.products.index')
            ->with('success', 'Cập nhật sản phẩm thành công.');
    }

    public function destroy(int $id)
    {
        $this->productService->delete($id);
        return redirect()->route('admin.products.index')
            ->with('success', 'Xóa sản phẩm thành công.');
    }
}

