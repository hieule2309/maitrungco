<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Xóa dữ liệu cũ nếu cần (Cẩn thận khi dùng lệnh này)
        // DB::table('categories')->truncate();

        // ==========================================
        // KHỐI 1: ĐIỆN TỬ & CÔNG NGHỆ (LEVEL 1)
        // ==========================================
        $dienTuId = DB::table('categories')->insertGetId([
            'name' => 'Điện tử & Công nghệ',
            'slug' => Str::slug('Điện tử & Công nghệ'),
            'description' => 'Các sản phẩm công nghệ và linh kiện điện tử',
            'icon' => 'fa-laptop',
            'parent_id' => null, // Cấp 1 không có cha
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ---- LEVEL 2 (Con của Điện tử) ----
        $laptopId = DB::table('categories')->insertGetId([
            'name' => 'Máy tính & Laptop',
            'slug' => Str::slug('Máy tính & Laptop'),
            'description' => 'Máy tính để bàn và laptop xách tay',
            'parent_id' => $dienTuId, // Gán ID của cấp 1
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $phoneId = DB::table('categories')->insertGetId([
            'name' => 'Điện thoại & Máy tính bảng',
            'slug' => Str::slug('Điện thoại & Máy tính bảng'),
            'description' => 'Điện thoại di động, iPad, Tablet',
            'parent_id' => $dienTuId, // Gán ID của cấp 1
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ---- LEVEL 3 (Cháu của Điện tử - Con của Laptop) ----
        DB::table('categories')->insert([
            [
                'name' => 'Laptop Gaming',
                'slug' => Str::slug('Laptop Gaming'),
                'description' => 'Laptop cấu hình cao chuyên chơi game',
                'parent_id' => $laptopId, // Gán ID của cấp 2 (Laptop)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Laptop Văn Phòng',
                'slug' => Str::slug('Laptop Văn Phòng'),
                'description' => 'Laptop mỏng nhẹ cho dân văn phòng, học sinh',
                'parent_id' => $laptopId, // Gán ID của cấp 2 (Laptop)
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // ---- LEVEL 3 (Cháu của Điện tử - Con của Điện thoại) ----
        DB::table('categories')->insert([
            [
                'name' => 'Smartphone iOS (iPhone)',
                'slug' => Str::slug('Smartphone iOS iPhone'),
                'description' => 'Các dòng điện thoại iPhone từ Apple',
                'parent_id' => $phoneId, // Gán ID của cấp 2 (Điện thoại)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Điện thoại Android',
                'slug' => Str::slug('Điện thoại Android'),
                'description' => 'Điện thoại chạy hệ điều hành Android (Samsung, Oppo...)',
                'parent_id' => $phoneId, // Gán ID của cấp 2 (Điện thoại)
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);


        // ==========================================
        // KHỐI 2: Linh Kiện (LEVEL 1)
        // ==========================================
        $linhKienId = DB::table('categories')->insertGetId([
            'name' => 'Linh kiện',
            'slug' => Str::slug('Linh kiện'),
            'description' => 'Linh kiện',
            'icon' => 'fa-laptop',
            'parent_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ---- LEVEL 2 (Con của Linh kiện) ----
        $manHinhId = DB::table('categories')->insertGetId([
            'name' => 'Màn hình',
            'slug' => Str::slug('Màn hình'),
            'description' => 'Màn hình',
            'parent_id' => $linhKienId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $ramId = DB::table('categories')->insertGetId([
            'name'=> 'Ram',
            'slug'=> Str::slug('Ram'),
            'description'=> 'Ram',
            'parent_id' => $linhKienId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $romId = DB::table('categories')->insertGetId([
            'name'=> 'Rom',
            'slug'=> Str::slug('Rom'),
            'description'=> 'Rom',
            'parent_id' => $linhKienId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // ---- LEVEL 3 (Cháu của Linh Kiện - Màn hình) ----
        DB::table('categories')->insert([
            [
                'name' => 'Màn hình 24inch',
                'slug' => Str::slug('Màn hình 24inch'),
                'description' => 'Màn hình 24inch',
                'parent_id' => $manHinhId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Màn hình 27inch',
                'slug' => Str::slug('Màn hình 27inch'),
                'description' => 'Màn hình 27inch',
                'parent_id' => $manHinhId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Màn hình 32inch',
                'slug' => Str::slug('Màn hình 32inch'),
                'description' => 'Màn hình 32inch',
                'parent_id' => $manHinhId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Màn hình 36inch',
                'slug' => Str::slug('Màn hình 36inch'),
                'description' => 'Màn hình 36inch',
                'parent_id' => $manHinhId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Màn hình xách tay',
                'slug' => Str::slug('Màn hình xách tay'),
                'description' => 'Màn hình xách tay',
                'parent_id' => $manHinhId,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('categories')->insert([
            [
                'name' => 'Ram 4GB',
                'slug' => Str::slug('Ram 4GB'),
                'description' => 'Ram 4GB',
                'parent_id' => $ramId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ram 8GB',
                'slug' => Str::slug('Ram 8GB'),
                'description' => 'Ram 8GB',
                'parent_id' => $ramId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ram 16GB',
                'slug' => Str::slug('Ram 16GB'),
                'description' => 'Ram 16GB',
                'parent_id' => $ramId,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('categories')->insert([
            [
                'name' => 'SSD 256GB',
                'slug' => Str::slug('SSD 256GB'),
                'description' => 'SSD 256GB',
                'parent_id' => $romId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SSD 512GB',
                'slug' => Str::slug('SSD 512GB'),
                'description' => 'SSD 512GB',
                'parent_id' => $romId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'HDD 1TB',
                'slug' => Str::slug('HDD 1TB'),
                'description' => 'HDD 1TB',
                'parent_id' => $romId,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
