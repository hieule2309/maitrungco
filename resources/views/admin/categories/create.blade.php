@extends('admin.layouts.app')

@section('title', 'Thêm mới Danh mục')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Thêm Danh mục mới</h1>
        <p class="text-sm text-gray-500 mt-1">Quản lý cấu trúc danh mục sản phẩm (Hỗ trợ 3 tầng).</p>
    </div>
    <div>
        <a href="#" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-300 transition mr-2">
            Hủy bỏ
        </a>
        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition shadow-sm">
            <i class="fas fa-save mr-2"></i> Lưu Danh mục
        </button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <!-- Cột chính -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Thông tin Danh mục</h2>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tên danh mục <span class="text-red-500">*</span></label>
                    <input type="text" placeholder="Ví dụ: Laptop Gaming" class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Đường dẫn tĩnh (Slug)</label>
                    <input type="text" placeholder="Ví dụ: laptop-gaming (Tự động tạo nếu để trống)" class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm bg-gray-50">
                    <p class="text-xs text-gray-500 mt-1">Đường dẫn hiển thị trên URL. Ví dụ: /products/category/laptop-gaming</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả danh mục</label>
                    <textarea rows="3" placeholder="Mô tả ngắn gọn về danh mục này..." class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"></textarea>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Cột bên phải -->
    <div class="space-y-6">
        
        <!-- Cấu trúc phân cấp -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Phân cấp (Cấu trúc 3 tầng)</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Danh mục cha</label>
                    <select class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm bg-white">
                        <option value="">-- Không có (Danh mục gốc) --</option>
                        <option value="1" class="font-bold">Máy Tính & Laptop</option>
                        <option value="2">&nbsp;&nbsp;&nbsp;Laptop</option>
                        <option value="5">&nbsp;&nbsp;&nbsp;PC Lắp Ráp</option>
                        <option value="6" class="font-bold">Phụ Kiện</option>
                        <option value="7">&nbsp;&nbsp;&nbsp;Bàn Phím</option>
                        <option value="8">&nbsp;&nbsp;&nbsp;Chuột máy tính</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-2">Chọn "Không có" nếu đây là danh mục cao nhất (Tầng 1). Chọn các mục có sẵn để làm danh mục con (Tầng 2, Tầng 3).</p>
                </div>
            </div>
        </div>

        <!-- Biểu tượng -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Biểu tượng (Icon)</h2>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">FontAwesome Class</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-laptop text-gray-400"></i>
                    </div>
                    <input type="text" placeholder="Ví dụ: fas fa-laptop" class="w-full border border-gray-300 rounded-lg py-2 pl-10 pr-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                </div>
                <p class="text-xs text-gray-500 mt-2">Sử dụng class của FontAwesome để hiển thị ở menu Tầng 1.</p>
            </div>
        </div>
        
        <!-- Trạng thái -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Tùy chọn</h2>
            <div class="space-y-3">
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" checked class="form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500 transition">
                    <span class="text-gray-700 text-sm font-medium">Kích hoạt (Hiển thị)</span>
                </label>
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500 transition">
                    <span class="text-gray-700 text-sm font-medium">Hiển thị lên Menu chính</span>
                </label>
            </div>
        </div>

    </div>
</div>
@endsection
