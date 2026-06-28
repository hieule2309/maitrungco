import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/css/user/products/show.css',


                'resources/js/app.js',
                'resources/js/admin/products/create.js',
                'resources/js/admin/products/edit.js',
                'resources/js/user/products/show.js',
            ],
            refresh: true,
        }),
    ],
});
