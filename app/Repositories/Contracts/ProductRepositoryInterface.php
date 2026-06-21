<?php

namespace App\Repositories\Contracts;

use App\Models\Product;
use  Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    /**
     * Get list product
     *
     * @param string|null $keyword
     * @return LengthAwarePaginator
     */
    public function getListProduct(?string $keyword = null);

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

    /**
     * Get favorite products by ids
     *
     * @param array $ids
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getFavoriteProducts(array $ids, int $perPage = 20);
}
