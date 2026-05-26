<?php

namespace App\Services\Admin;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductService
{
    public function __construct(protected ProductRepositoryInterface $productRepository)
    {

    }
}
