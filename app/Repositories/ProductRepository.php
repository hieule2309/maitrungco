<?php
namespace App\Repositories;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use  Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Get product by id
     *
     * @param int $id
     * @return array
     */
    public function getProductById(int $id)
    {
        return [];
    }

    /**
     * Get list product
     *
     * @return LengthAwarePaginator
     */
    public function getListProduct()
    {
        return Product::active()->with('images', 'categories')->orderBy('id', 'desc')->paginate(PRODUCT_PER_PAGE);
    }

    /**
     * Get list category product
     *
     * @param array $categories
     * @return LengthAwarePaginator
     */
    public function getListCategoryProduct(array $categories)
    {
        $products = Product::whereHas('categories', function ($query) use ($categories) {
                        $query->whereIn('categories.id', $categories);
                    })
                    ->active()
                    ->with('images', 'categories')
                    ->paginate(PRODUCT_PER_PAGE);

        return $products;
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
}
