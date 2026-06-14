<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function getAll(array $filters = []);
    public function getById(int $id);
    public function create(array $data): \App\Models\Product;
    public function update(int $id, array $data): \App\Models\Product;
    public function delete(int $id): void;
}
