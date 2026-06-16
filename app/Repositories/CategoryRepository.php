<?php
namespace App\Repositories;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * Get all category
     *
     * @return array
     */
    public function getAll()
    {
        return Category::all()->toArray();
    }

    /**
     * Get Category tree
     *
     * @return Collection
     */
    public function getCategoryTree()
    {
        return Category::whereNull('parent_id')
                   ->with('allChildren')
                   ->get();
    }

    /**
     * Get category by slug
     *
     * @param string $slug
     * @return Category
     */
    public function getCategoryBySlug(string $slug)
    {
        return Category::where('slug', $slug)->firstOrFail();
    }
}
