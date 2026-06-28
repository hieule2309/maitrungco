<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use  Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll(array $filters = [])
    {
        $query = Product::with(['images' => fn($q) => $q->orderBy('sort')->limit(1), 'categories'])
            ->latest();

        if (!empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        if (isset($filters['active']) && $filters['active'] !== '') {
            $query->where('active', (bool) $filters['active']);
        }

        if (!empty($filters['category_id'])) {
            $query->whereHas('categories', fn($q) => $q->where('categories.id', $filters['category_id']));
        }

        return $query->paginate(15);
    }

    public function getById(int $id)
    {
        return Product::with(['images', 'categories', 'filterValues.group'])
            ->findOrFail($id);
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(int $id, array $data): Product
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function delete(int $id): void
    {
        Product::findOrFail($id)->delete();
    }

    /**
     * Get list product
     *
     * @param string|null $keyword
     * @return LengthAwarePaginator
     */
    public function getListProduct(?string $keyword = null)
    {
        $query = Product::active()->with('images', 'categories');

        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('slug', 'like', "%{$keyword}%");
            });
        }

        return $query->orderBy('id', 'desc')->paginate(PRODUCT_PER_PAGE);
    }

    /**
     * Get list category product
     *
     * @param array $categories
     * @param string $sort
     * @param array $filters
     * @param int|null $minPrice
     * @param int|null $maxPrice
     * @return LengthAwarePaginator
     */
    public function getListCategoryProduct(array $categories, string $sort = 'newest', array $filters = [], $minPrice = null, $maxPrice = null)
    {
        $query = Product::whereHas('categories', function ($q) use ($categories) {
                        $q->whereIn('categories.id', $categories);
                    })
                    ->active()
                    ->with('images', 'categories');

        if (!empty($minPrice) && is_numeric($minPrice)) {
            $query->where('price', '>=', $minPrice);
        }

        if (!empty($maxPrice) && is_numeric($maxPrice)) {
            $query->where('price', '<=', $maxPrice);
        }

        if (!empty($filters)) {
            foreach ($filters as $groupSlug => $valueSlugs) {
                if (!empty($valueSlugs)) {
                    $query->whereHas('filterValues', function($q) use ($valueSlugs) {
                        $q->whereIn('filter_values.slug', $valueSlugs);
                    });
                }
            }
        }

        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'best_selling':
            case 'newest':
            default:
                $query->orderBy('id', 'desc');
                break;
        }

        return $query->paginate(PRODUCT_PER_PAGE);
    }

    /**
     * Get product by slug
     *
     * @param string $slug
     * @return Product
     */
    public function getProductBySlug(string $slug)
    {
        return Product::where('slug', $slug)->active()->with('images', 'categories', 'filterValues.filterGroup')->firstOrFail();
    }

    /**
     * Get favorite products by ids
     *
     * @param array $ids
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getFavoriteProducts(array $ids, int $perPage = 20)
    {
        return Product::whereIn('id', $ids)->active()->with('images', 'categories')->orderBy('id', 'desc')->paginate($perPage);
    }
}
