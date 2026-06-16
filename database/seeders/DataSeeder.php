<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DataSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('vi_VN');

        // ==========================================
        // 1. SEED CATEGORIES
        // ==========================================
        $laptopId = DB::table('categories')->insertGetId([
            'name' => 'Laptops',
            'slug' => Str::slug('Laptops'),
            'description' => 'Máy tính xách tay các loại',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $gamingLaptopId = DB::table('categories')->insertGetId([
            'name' => 'Gaming Laptops',
            'slug' => Str::slug('Gaming Laptops'),
            'description' => 'Laptop cấu hình cao chơi game',
            'parent_id' => $laptopId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $phoneId = DB::table('categories')->insertGetId([
            'name' => 'Điện thoại',
            'slug' => Str::slug('Điện thoại'),
            'description' => 'Điện thoại thông minh',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ==========================================
        // 2. SEED FILTER GROUPS & FILTER VALUES
        // ==========================================
        // Nhóm CPU
        $cpuGroupId = DB::table('filter_groups')->insertGetId([
            'name' => 'CPU',
            'slug' => Str::slug('CPU'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $cpuFilters = [];
        foreach (['Core i3', 'Core i5', 'Core i7', 'Ryzen 5'] as $cpu) {
            $cpuFilters[] = DB::table('filter_values')->insertGetId([
                'filter_group_id' => $cpuGroupId,
                'value' => $cpu,
                'slug' => Str::slug($cpu),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Nhóm RAM
        $ramGroupId = DB::table('filter_groups')->insertGetId([
            'name' => 'RAM',
            'slug' => Str::slug('RAM'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $ramFilters = [];
        foreach (['8GB', '16GB', '32GB'] as $ram) {
            $ramFilters[] = DB::table('filter_values')->insertGetId([
                'filter_group_id' => $ramGroupId,
                'value' => $ram,
                'slug' => Str::slug($ram),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ==========================================
        // 3. SEED PRODUCTS & PIVOT TABLES
        // ==========================================
        $productNames = [
            'Asus ROG Strix G15',
            'Dell XPS 13',
            'MacBook Pro 14',
            'Lenovo ThinkPad X1',
            'iPhone 14 Pro Max',
            'Samsung Galaxy S23 Ultra'
        ];

        foreach ($productNames as $index => $name) {
            // Tạo Product
            $productId = DB::table('products')->insertGetId([
                'name' => $name,
                'slug' => Str::slug($name) . '-' . Str::random(5),
                'description' => $faker->realText(200),
                'price' => $faker->randomFloat(2, 500, 3000), // Giá từ 500 đến 3000
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Phân loại danh mục (Category)
            $categoryId = str_contains($name, 'iPhone') || str_contains($name, 'Galaxy')
                            ? $phoneId
                            : (str_contains($name, 'ROG') ? $gamingLaptopId : $laptopId);

            DB::table('category_product')->insert([
                'product_id' => $productId,
                'category_id' => $categoryId,
                'created_at' => now(),
            ]);

            // Gán giá trị bộ lọc (Filters) - Chỉ gán cho Laptop
            if ($categoryId == $laptopId || $categoryId == $gamingLaptopId) {
                // Random 1 CPU và 1 RAM
                DB::table('filter_value_product')->insert([
                    [
                        'product_id' => $productId,
                        'filter_value_id' => $faker->randomElement($cpuFilters),
                        'created_at' => now(),
                    ],
                    [
                        'product_id' => $productId,
                        'filter_value_id' => $faker->randomElement($ramFilters),
                        'created_at' => now(),
                    ]
                ]);
            }
        }
    }
}
