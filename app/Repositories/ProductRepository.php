<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll(array $filters = [])
    {
        $query = Product::with(['images' => fn($q) => $q->orderBy('sort')->limit(1), 'categories'])
            ->latest();

        if (!empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        if (isset($filters['active']) && $filters['active'] !== '') {
            $query->where('active', (bool) $filters['active']);
        }

        if (!empty($filters['category_id'])) {
            $query->whereHas('categories', fn($q) => $q->where('categories.id', $filters['category_id']));
        }

        return $query->paginate(15);
    }

    public function getById(int $id)
    {
        return Product::with(['images', 'categories', 'filterValues.group'])
            ->findOrFail($id);
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(int $id, array $data): Product
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function delete(int $id): void
    {
        Product::findOrFail($id)->delete();
    }
}
