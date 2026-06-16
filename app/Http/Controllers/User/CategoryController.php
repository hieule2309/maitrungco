<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\User\CategoryService;
use App\Services\User\ProductService;

class CategoryController
{
    public function __construct(
        protected CategoryService $categoryService,
        protected ProductService $productService
    ) {

    }

    /**
     * Get list category products
     *
     * @param string $slug
     * @param Request $request
     * @return View
     */
    public function index(string $slug, Request $request)
    {
        $category = $this->categoryService->getCategoryBySlug($slug);

        $listChildCategory = $this->categoryService->getChildCategory($category);

        $products = $this->productService->getListCategoryProduct($listChildCategory);

        return view('user.categories.index', compact('category', 'products'));
    }
}
