<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\User\ProductService;
use App\Services\User\CategoryService;

class ProductController
{
    public function __construct(
        protected ProductService $productService,
        protected CategoryService $categoryService
    ) {
    }
    /**
     * Get the user list product
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $products = $this->productService->getListProduct($keyword);

        return view('user.products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Get the user product detail
     *
     * @param string $slug
     * @param Request $request
     * @return View
     */
    public function show(string $slug, Request $request)
    {
        $product = $this->productService->getProductBySlug($slug);

        $images = $product->images;

        $categories = $product->categories;
        $breadcrumbs = $this->categoryService->getBreadCrumbProduct($categories);

        $attributes = $product->filterValues->mapWithKeys(function ($filterValue) {
            return [
                $filterValue->filterGroup->name => $filterValue->value
            ];
        });

        return view('user.products.show', [
            'product'     => $product,
            'breadcrumbs' => $breadcrumbs,
            'images'      => $images,
            'attributes'  => $attributes,
        ]);
    }
}
