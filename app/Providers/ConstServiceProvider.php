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
        define('SHOP_HOTLINE', ' 028.627.92606');
        define('SHOP_ADDRESS', '21 Phan Kế Bính, Phường Tân Định, TP.Hồ Chí Minh');
        define('SHOP_MAIL', 'info@maitrung.com');
        define('SHOP_TAX', '0313087418');
        define('PRODUCT_PER_PAGE', 20);
    }
}
