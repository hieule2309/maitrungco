<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Category;

interface CategoryRepositoryInterface
{
    /**
     * Get all category
     *
     * @return array
     */
    public function getAll();

    /**
     * Get category with recursive child
     *
     * @return Collection
     */
    public function getCategoryTree();

    /**
     * Get category by slug
     *
     * @param string $slug
     * @return Category
     */
    public function getCategoryBySlug(string $slug);

}
