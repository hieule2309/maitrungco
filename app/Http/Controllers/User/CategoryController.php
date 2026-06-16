<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\User\CategoryService;
use App\Services\User\ProductService;

use App\Models\FilterGroup;

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

        $filterGroups = FilterGroup::whereHas('filterValues.products.categories', function ($q) use ($listChildCategory) {
            $q->whereIn('categories.id', $listChildCategory);
        })->with(['filterValues' => function ($q) use ($listChildCategory) {
            $q->whereHas('products.categories', function ($q2) use ($listChildCategory) {
                $q2->whereIn('categories.id', $listChildCategory);
            });
        }])->get();

        $filters = [];
        foreach ($filterGroups as $group) {
            if ($request->has($group->slug)) {
                $filters[$group->slug] = explode(',', $request->query($group->slug));
            }
        }

        $sort = $request->query('sort', 'newest');
        $minPrice = $request->query('min_price');
        $maxPrice = $request->query('max_price');
        
        $products = $this->productService->getListCategoryProduct($listChildCategory, $sort, $filters, $minPrice, $maxPrice);

        return view('user.categories.index', compact('category', 'products', 'sort', 'filterGroups', 'filters'));
    }
}
