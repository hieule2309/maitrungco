@extends('admin.layouts.app')

@section('title', 'Quản lý Sản phẩm')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Quản lý Sản phẩm</h1>
        <p class="text-sm text-gray-500 mt-1">Danh sách tất cả sản phẩm trong cửa hàng.</p>
    </div>
    <div>
        <a href="/admin/products/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition shadow-sm">
            <i class="fas fa-plus mr-2"></i> Thêm Sản phẩm
        </a>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <!-- Tools -->
    <div class="p-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
        <div class="flex items-center space-x-3">
            <div class="relative">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" placeholder="Tìm kiếm sản phẩm..." class="w-64 border border-gray-300 rounded-lg pl-10 pr-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
            </div>
            <select class="border border-gray-300 rounded-lg py-1.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm bg-white">
                <option value="">Tất cả danh mục</option>
                <option value="1">Laptop Gaming</option>
                <option value="2">PC Lắp ráp</option>
            </select>
        </div>
        <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-500">Sắp xếp:</span>
            <select class="border border-gray-300 rounded-lg py-1.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm bg-white">
                <option>Mới nhất</option>
                <option>Giá cao - thấp</option>
                <option>Giá thấp - cao</option>
            </select>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white text-gray-500 text-xs uppercase tracking-wider border-b border-gray-200">
                    <th class="p-4 font-semibold w-10 text-center"><input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"></th>
                    <th class="p-4 font-semibold">Sản phẩm</th>
                    <th class="p-4 font-semibold">Danh mục</th>
                    <th class="p-4 font-semibold">Giá bán</th>
                    <th class="p-4 font-semibold text-center">Trạng thái</th>
                    <th class="p-4 font-semibold text-center w-28">Thao tác</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                <!-- Hàng 1 -->
                <tr class="hover:bg-gray-50 transition group">
                    <td class="p-4 text-center"><input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"></td>
                    <td class="p-4">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1603302576837-37561b2e2302?auto=format&fit=crop&q=80&w=100&h=100" class="w-12 h-12 rounded object-cover border border-gray-200 mr-3">
                            <div>
                                <a href="/admin/products/1/edit" class="font-bold text-gray-800 hover:text-blue-600 transition">Laptop Asus ROG Strix G15</a>
                                <p class="text-xs text-gray-500 mt-0.5">Kho: 45 | Đã bán: 120</p>
                            </div>
                        </div>
                    </td>
                    <td class="p-4">
                        <span class="text-xs font-medium bg-gray-100 text-gray-600 px-2.5 py-1 rounded">Laptop Gaming</span>
                    </td>
                    <td class="p-4">
                        <div class="font-semibold text-red-600">25.490.000₫</div>
                        <div class="text-xs text-gray-400 line-through">28.990.000₫</div>
                    </td>
                    <td class="p-4 text-center">
                        <span class="bg-green-100 text-green-700 py-1 px-2.5 rounded-full text-xs font-medium inline-block">Hiển thị</span>
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="/admin/products/1/edit" class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition tooltip" title="Chỉnh sửa">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <button class="w-8 h-8 rounded-full bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition tooltip" title="Xóa">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                
                <!-- Hàng 2 -->
                <tr class="hover:bg-gray-50 transition group">
                    <td class="p-4 text-center"><input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"></td>
                    <td class="p-4">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1595225476474-87563907a212?auto=format&fit=crop&q=80&w=100&h=100" class="w-12 h-12 rounded object-cover border border-gray-200 mr-3">
                            <div>
                                <a href="/admin/products/1/edit" class="font-bold text-gray-800 hover:text-blue-600 transition">Bàn phím cơ Akko 3098B</a>
                                <p class="text-xs text-gray-500 mt-0.5">Kho: 12 | Đã bán: 45</p>
                            </div>
                        </div>
                    </td>
                    <td class="p-4">
                        <span class="text-xs font-medium bg-gray-100 text-gray-600 px-2.5 py-1 rounded">Bàn phím</span>
                    </td>
                    <td class="p-4">
                        <div class="font-semibold text-gray-800">1.890.000₫</div>
                    </td>
                    <td class="p-4 text-center">
                        <span class="bg-green-100 text-green-700 py-1 px-2.5 rounded-full text-xs font-medium inline-block">Hiển thị</span>
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="/admin/products/1/edit" class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition tooltip" title="Chỉnh sửa">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <button class="w-8 h-8 rounded-full bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition tooltip" title="Xóa">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                
                <!-- Hàng 3 -->
                <tr class="hover:bg-gray-50 transition group">
                    <td class="p-4 text-center"><input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"></td>
                    <td class="p-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded bg-gray-100 border border-gray-200 mr-3 flex items-center justify-center text-gray-400">
                                <i class="fas fa-image"></i>
                            </div>
                            <div>
                                <a href="/admin/products/1/edit" class="font-bold text-gray-800 hover:text-blue-600 transition">PC Văn phòng Core i3</a>
                                <p class="text-xs text-red-500 font-medium mt-0.5">Hết hàng</p>
                            </div>
                        </div>
                    </td>
                    <td class="p-4">
                        <span class="text-xs font-medium bg-gray-100 text-gray-600 px-2.5 py-1 rounded">PC Lắp ráp</span>
                    </td>
                    <td class="p-4">
                        <div class="font-semibold text-gray-800">6.500.000₫</div>
                    </td>
                    <td class="p-4 text-center">
                        <span class="bg-gray-100 text-gray-500 py-1 px-2.5 rounded-full text-xs font-medium inline-block">Đã ẩn</span>
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="/admin/products/1/edit" class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition tooltip" title="Chỉnh sửa">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <button class="w-8 h-8 rounded-full bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition tooltip" title="Xóa">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="p-4 border-t border-gray-100 bg-gray-50 flex items-center justify-between">
        <span class="text-sm text-gray-500">Hiển thị 1 - 3 của 125 sản phẩm</span>
        <nav class="flex items-center space-x-1">
            <a href="#" class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 text-gray-500 hover:bg-gray-100 transition"><i class="fas fa-chevron-left text-xs"></i></a>
            <a href="#" class="w-8 h-8 flex items-center justify-center rounded bg-blue-600 text-white font-medium shadow text-sm">1</a>
            <a href="#" class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 text-gray-700 hover:bg-gray-100 transition font-medium text-sm">2</a>
            <a href="#" class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 text-gray-700 hover:bg-gray-100 transition font-medium text-sm">3</a>
            <span class="text-gray-500 px-1">...</span>
            <a href="#" class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 text-gray-500 hover:bg-gray-100 transition"><i class="fas fa-chevron-right text-xs"></i></a>
        </nav>
    </div>
</div>
@endsection
