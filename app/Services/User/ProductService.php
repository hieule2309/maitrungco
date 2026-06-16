<?php

namespace App\Services\User;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use  Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function __construct(protected ProductRepositoryInterface $productRepository)
    {

    }

    /**
     * Get list product
     *
     * @return LengthAwarePaginator
     */
    public function getListProduct()
    {
        return $this->productRepository->getListProduct();
    }

    /**
     * Get list category product
     * @param array $categories
     * @param string $sort
     * @param array $filters
     * @param int|null $minPrice
     * @param int|null $maxPrice
     * @return LengthAwarePaginator
     */
    public function getListCategoryProduct(array $categories, string $sort = 'newest', array $filters = [], $minPrice = null, $maxPrice = null)
    {
        return $this->productRepository->getListCategoryProduct($categories, $sort, $filters, $minPrice, $maxPrice);
    }

    public function getProductBySlug(string $slug)
    {
        return $this->productRepository->getProductBySlug($slug);
    }
}
