<?php

namespace App\Repositories\Contracts;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use  Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    /**
     * Get product by id
     *
     * @param int $id
     * @return array
     */
    public function getProductById(int $id);

    /**
     * Get list product
     *
     * @return LengthAwarePaginator
     */
    public function getListProduct();

    /**
     * Get list category product
     *
     * @param string $sort
     * @param array $filters
     * @param int|null $minPrice
     * @param int|null $maxPrice
     * @return LengthAwarePaginator
     */
    public function getListCategoryProduct(array $categories, string $sort = 'newest', array $filters = [], $minPrice = null, $maxPrice = null);

    /**
     * Get product by slug
     *
     * @param string $slug
     * @return Product
     */
    public function getProductBySlug(string $slug);
}
