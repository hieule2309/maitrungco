<?php

namespace App\Services\User;
use App\Repositories\Contracts\ProductRepositoryInterface;
use  Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function __construct(protected ProductRepositoryInterface $productRepository)
    {

    }

    /**
     * Get list product
     *
     * @param string|null $keyword
     * @return LengthAwarePaginator
     */
    public function getListProduct(?string $keyword = null)
    {
        return $this->productRepository->getListProduct($keyword);
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

    /**
     * Get favorite products by ids
     *
     * @param array $ids
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getFavoriteProducts(array $ids, int $perPage = PRODUCT_PER_PAGE)
    {
        return $this->productRepository->getFavoriteProducts($ids, $perPage);
    }
}
