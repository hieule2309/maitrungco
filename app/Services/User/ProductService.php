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
     *
     * @param array $categories
     * @return LengthAwarePaginator
     */
    public function getListCategoryProduct(array $categories)
    {
        return $this->productRepository->getListCategoryProduct($categories);
    }

    public function getProductBySlug(string $slug)
    {
        return $this->productRepository->getProductBySlug($slug);
    }
}
