<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ConstServiceProvider extends ServiceProvider
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
    public function boot(): void
    {
        define('SHOP_NAME', 'Mai Trung');
        define('SHOP_PHONE', '0918.55.41.58');
        define('SHOP_HOTLINE', '');
        define('SHOP_ADDRESS', '');
        define('SHOP_EMAIL', '');
    }
}
