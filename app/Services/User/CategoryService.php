<?php

namespace App\Services\User;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Category;

class CategoryService
{
    public function __construct(protected CategoryRepositoryInterface $categoryRepository)
    {

    }

    /**
     * Get category by slug
     *
     * @param string $slug
     * @return Category
     */
    public function getCategoryBySlug(string $slug)
    {
        return $this->categoryRepository->getCategoryBySlug($slug);
    }

    /**
     * Get list child category
     *
     * @param Category $category
     * @return array
     */
    public function getChildCategory(Category $category)
    {
        $categoryIds = [$category->id];

        foreach ($category->allChildren as $child) {
            $categoryIds[] = $child->id;
            foreach ($child->allChildren as $grandChild) {
                $categoryIds[] = $grandChild->id;
            }
        }

        return $categoryIds;
    }

    /**
     * Get breadcrumb product detail
     *
     * @param Collection $categories
     * @return array
     */
    public function getBreadCrumbProduct(Collection $categories)
    {
        if ($categories->isEmpty())
        {
            return [];
        }

        $firstCategory = $categories->firstWhere('parent_id', 0);
        return [$firstCategory];
    }
}
