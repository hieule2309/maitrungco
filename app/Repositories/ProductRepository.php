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
                // Assuming best selling could be sort by sales if such column exists, or just fallback
                // We'll sort by id desc for now if best_selling logic isn't fully defined.
                $query->orderBy('id', 'desc');
                break;
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
}
