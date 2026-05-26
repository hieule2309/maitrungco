@extends('admin.layouts.app')

@section('title', 'Thêm mới Sản phẩm')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Thêm Sản phẩm mới</h1>
        <p class="text-sm text-gray-500 mt-1">Nhập thông tin chi tiết cho sản phẩm mới.</p>
    </div>
    <div>
        <a href="#" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-300 transition mr-2">
            Hủy bỏ
        </a>
        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition shadow-sm">
            <i class="fas fa-save mr-2"></i> Lưu Sản phẩm
        </button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <!-- Cột chính -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Thông tin cơ bản -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Thông tin cơ bản</h2>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tên sản phẩm <span class="text-red-500">*</span></label>
                    <input type="text" placeholder="Nhập tên sản phẩm..." class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Giá bán (VNĐ) <span class="text-red-500">*</span></label>
                        <input type="number" placeholder="Ví dụ: 15000000" class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Giá gốc / Thị trường (VNĐ)</label>
                        <input type="number" placeholder="Ví dụ: 18000000" class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả ngắn</label>
                    <textarea rows="3" placeholder="Mô tả ngắn gọn về sản phẩm (hiển thị ở thẻ sản phẩm)..." class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"></textarea>
                </div>
            </div>
        </div>
        
        <!-- Mô tả chi tiết (Giả lập CKEditor) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Mô tả chi tiết</h2>
            <div class="border border-gray-300 rounded-lg overflow-hidden">
                <!-- Toolbar giả lập -->
                <div class="bg-gray-50 border-b border-gray-300 px-3 py-2 flex items-center space-x-2 text-gray-600">
                    <button class="w-8 h-8 rounded hover:bg-gray-200 flex items-center justify-center"><i class="fas fa-bold"></i></button>
                    <button class="w-8 h-8 rounded hover:bg-gray-200 flex items-center justify-center"><i class="fas fa-italic"></i></button>
                    <button class="w-8 h-8 rounded hover:bg-gray-200 flex items-center justify-center"><i class="fas fa-underline"></i></button>
                    <div class="w-px h-5 bg-gray-300 mx-1"></div>
                    <button class="w-8 h-8 rounded hover:bg-gray-200 flex items-center justify-center"><i class="fas fa-list-ul"></i></button>
                    <button class="w-8 h-8 rounded hover:bg-gray-200 flex items-center justify-center"><i class="fas fa-list-ol"></i></button>
                    <div class="w-px h-5 bg-gray-300 mx-1"></div>
                    <button class="w-8 h-8 rounded hover:bg-gray-200 flex items-center justify-center"><i class="fas fa-image"></i></button>
                    <button class="w-8 h-8 rounded hover:bg-gray-200 flex items-center justify-center"><i class="fas fa-link"></i></button>
                </div>
                <!-- Content area -->
                <textarea rows="10" placeholder="Viết mô tả chi tiết sản phẩm ở đây..." class="w-full border-none py-3 px-4 focus:outline-none focus:ring-0 text-sm resize-y"></textarea>
            </div>
        </div>
    </div>
    
    <!-- Cột bên phải -->
    <div class="space-y-6">
        
        <!-- Danh mục -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Danh mục & Thương hiệu</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Danh mục sản phẩm <span class="text-red-500">*</span></label>
                    <select id="categorySelect" multiple size="6" class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm bg-white">
                        <option value="1" class="font-bold">Máy Tính & Laptop</option>
                        <option value="2">&nbsp;&nbsp;&nbsp;Laptop</option>
                        <option value="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Laptop Gaming</option>
                        <option value="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Laptop Văn phòng</option>
                        <option value="5">&nbsp;&nbsp;&nbsp;PC Lắp Ráp</option>
                        <option value="6" class="font-bold">Phụ Kiện</option>
                        <option value="7">&nbsp;&nbsp;&nbsp;Bàn Phím</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Giữ phím Ctrl (Windows) hoặc Cmd (Mac) để chọn nhiều danh mục.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Thương hiệu</label>
                    <select class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm bg-white">
                        <option value="">-- Chọn thương hiệu --</option>
                        <option value="asus">Asus</option>
                        <option value="apple">Apple</option>
                        <option value="logitech">Logitech</option>
                        <option value="gigabyte">Gigabyte</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Hình ảnh -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Hình ảnh</h2>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Ảnh đại diện <span class="text-red-500">*</span></label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition cursor-pointer">
                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                    <p class="text-sm text-gray-500">Kéo thả ảnh vào đây hoặc <span class="text-blue-600 font-medium">Chọn file</span></p>
                    <p class="text-xs text-gray-400 mt-1">PNG, JPG, WEBP lên đến 2MB</p>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Thư viện ảnh (Gallery)</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:bg-gray-50 transition cursor-pointer">
                    <i class="fas fa-images text-2xl text-gray-400 mb-2"></i>
                    <p class="text-xs text-gray-500">Tải lên nhiều ảnh</p>
                </div>
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
                    <span class="text-gray-700 text-sm font-medium">Sản phẩm nổi bật</span>
                </label>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
    @vite(['resources/js/admin/products/create.js'])
@endpush