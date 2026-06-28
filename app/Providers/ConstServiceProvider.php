<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ConstServiceProvider extends ServiceProvider
{
    const SHOP_NAME = 'Mai Trung';
    const SHOP_PHONE = '0918.55.41.58';
    const SHOP_HOTLINE = '';
    const SHOP_ADDRESS = '';
    const SHOP_EMAIL = '';
    
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
        // define('SHOP_NAME', 'Mai Trung');
        // define('SHOP_PHONE', '0918.55.41.58');
        // define('SHOP_HOTLINE', ' 028.627.92606');
        // define('SHOP_ADDRESS', '21 Phan Kế Bính, Phường Tân Định, TP.Hồ Chí Minh');
        // define('SHOP_MAIL', 'info@maitrung.com');
        // define('SHOP_TAX', '0313087418');
        // define('PRODUCT_PER_PAGE', 20);

        if (! defined('SHOP_NAME')) {
            define('SHOP_NAME', self::SHOP_NAME);
        }

        if (! defined('SHOP_PHONE')) {
            define('SHOP_PHONE', self::SHOP_PHONE);
        }

        if (! defined('SHOP_HOTLINE')) {
            define('SHOP_HOTLINE', self::SHOP_HOTLINE);
        }

        if (! defined('SHOP_ADDRESS')) {
            define('SHOP_ADDRESS', self::SHOP_ADDRESS);
        }

        if (! defined('SHOP_EMAIL')) {
            define('SHOP_EMAIL', self::SHOP_EMAIL);
        }
    }
}
