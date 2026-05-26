<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    /**
     * Get product by id
     *
     * @param int $id
     * @return array
     */
    public function getProductById(int $id);
}
