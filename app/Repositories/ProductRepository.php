<?php
namespace App\Repositories;

use App\Repositories\Contracts\ProductRepositoryInterface;

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
}
