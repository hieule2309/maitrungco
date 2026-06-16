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
     * @param array $categories
     * @return LengthAwarePaginator
     */
    public function getListCategoryProduct(array $categories);

    /**
     * Get product by slug
     *
     * @param string $slug
     * @return Product
     */
    public function getProductBySlug(string $slug);
}
