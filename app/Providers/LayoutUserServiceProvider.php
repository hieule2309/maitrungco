<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class LayoutUserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(CategoryRepositoryInterface $categoryRepository): void
    {
        View::composer('user.layouts.category', function ($view) use ($categoryRepository) {
            $categories = $categoryRepository->getCategoryTree();
            $view->with('categories', $categories);
        });
    }
}
