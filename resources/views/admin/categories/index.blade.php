@extends('admin.layouts.app')

@section('title', 'Quản lý Danh mục')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Quản lý Danh mục</h1>
        <p class="text-sm text-gray-500 mt-1">Cấu trúc menu và danh mục phân cấp 3 tầng.</p>
    </div>
    <div>
        <a href="/admin/categories/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition shadow-sm">
            <i class="fas fa-plus mr-2"></i> Thêm Danh mục
        </a>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <!-- Tools -->
    <div class="p-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
        <div class="relative">
            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <input type="text" placeholder="Tìm kiếm danh mục..." class="w-64 border border-gray-300 rounded-lg pl-10 pr-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
        </div>
        <button class="text-sm text-blue-600 font-medium hover:underline">
            <i class="fas fa-sort-amount-down-alt mr-1"></i> Cập nhật thứ tự
        </button>
    </div>

    <!-- Category Tree (Table format) -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white text-gray-500 text-xs uppercase tracking-wider border-b border-gray-200">
                    <th class="p-4 font-semibold w-10 text-center"><input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"></th>
                    <th class="p-4 font-semibold">Tên Danh Mục (Cấu trúc tầng)</th>
                    <th class="p-4 font-semibold">Đường dẫn tĩnh (Slug)</th>
                    <th class="p-4 font-semibold text-center">Trạng thái</th>
                    <th class="p-4 font-semibold text-center w-28">Thao tác</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                
                <!-- Tầng 1 (Level 1) -->
                <tr class="hover:bg-gray-50 transition bg-blue-50/30">
                    <td class="p-4 text-center"><input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"></td>
                    <td class="p-4">
                        <div class="flex items-center font-bold text-gray-800">
                            <i class="fas fa-laptop w-6 text-gray-400 text-center mr-2"></i>
                            <a href="/admin/categories/1/edit" class="hover:text-blue-600 transition">Máy Tính & Laptop</a>
                            <span class="ml-2 text-xs font-normal text-gray-400 border border-gray-200 rounded px-1.5 py-0.5 bg-white">Tầng 1</span>
                        </div>
                    </td>
                    <td class="p-4 text-gray-500">may-tinh-laptop</td>
                    <td class="p-4 text-center">
                        <span class="bg-green-100 text-green-700 py-1 px-2.5 rounded-full text-xs font-medium inline-block">Kích hoạt</span>
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="/admin/categories/1/edit" class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition tooltip" title="Chỉnh sửa">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <button class="w-8 h-8 rounded-full bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition tooltip" title="Xóa">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                
                <!-- Tầng 2 (Level 2) -->
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 text-center"><input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"></td>
                    <td class="p-4">
                        <div class="flex items-center text-gray-800 ml-8">
                            <i class="fas fa-level-up-alt rotate-90 text-gray-300 mr-2"></i>
                            <a href="/admin/categories/1/edit" class="hover:text-blue-600 font-semibold transition">Laptop</a>
                        </div>
                    </td>
                    <td class="p-4 text-gray-500">laptop</td>
                    <td class="p-4 text-center">
                        <span class="bg-green-100 text-green-700 py-1 px-2.5 rounded-full text-xs font-medium inline-block">Kích hoạt</span>
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="/admin/categories/1/edit" class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition tooltip" title="Chỉnh sửa">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <button class="w-8 h-8 rounded-full bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition tooltip" title="Xóa">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                
                <!-- Tầng 3 (Level 3) -->
                <tr class="hover:bg-gray-50 transition text-gray-600">
                    <td class="p-4 text-center"><input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"></td>
                    <td class="p-4">
                        <div class="flex items-center ml-16">
                            <div class="w-2 h-2 rounded-full bg-gray-300 mr-3"></div>
                            <a href="/admin/categories/1/edit" class="hover:text-blue-600 transition">Laptop Gaming</a>
                        </div>
                    </td>
                    <td class="p-4 text-gray-500">laptop-gaming</td>
                    <td class="p-4 text-center">
                        <span class="bg-green-100 text-green-700 py-1 px-2.5 rounded-full text-xs font-medium inline-block">Kích hoạt</span>
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="/admin/categories/1/edit" class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition tooltip" title="Chỉnh sửa">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <button class="w-8 h-8 rounded-full bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition tooltip" title="Xóa">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Tầng 3 (Level 3) -->
                <tr class="hover:bg-gray-50 transition text-gray-600">
                    <td class="p-4 text-center"><input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"></td>
                    <td class="p-4">
                        <div class="flex items-center ml-16">
                            <div class="w-2 h-2 rounded-full bg-gray-300 mr-3"></div>
                            <a href="/admin/categories/1/edit" class="hover:text-blue-600 transition">Laptop Văn Phòng</a>
                        </div>
                    </td>
                    <td class="p-4 text-gray-500">laptop-van-phong</td>
                    <td class="p-4 text-center">
                        <span class="bg-green-100 text-green-700 py-1 px-2.5 rounded-full text-xs font-medium inline-block">Kích hoạt</span>
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="/admin/categories/1/edit" class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition tooltip" title="Chỉnh sửa">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <button class="w-8 h-8 rounded-full bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition tooltip" title="Xóa">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                
                <!-- Tầng 2 (Level 2) -->
                <tr class="hover:bg-gray-50 transition border-t border-gray-100">
                    <td class="p-4 text-center"><input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"></td>
                    <td class="p-4">
                        <div class="flex items-center text-gray-800 ml-8">
                            <i class="fas fa-level-up-alt rotate-90 text-gray-300 mr-2"></i>
                            <a href="/admin/categories/1/edit" class="hover:text-blue-600 font-semibold transition">PC Lắp ráp</a>
                        </div>
                    </td>
                    <td class="p-4 text-gray-500">pc-lap-rap</td>
                    <td class="p-4 text-center">
                        <span class="bg-green-100 text-green-700 py-1 px-2.5 rounded-full text-xs font-medium inline-block">Kích hoạt</span>
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="/admin/categories/1/edit" class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition tooltip" title="Chỉnh sửa">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <button class="w-8 h-8 rounded-full bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition tooltip" title="Xóa">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                
                <!-- Tầng 1 (Level 1) -->
                <tr class="hover:bg-gray-50 transition bg-blue-50/30 border-t-2 border-gray-200">
                    <td class="p-4 text-center"><input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"></td>
                    <td class="p-4">
                        <div class="flex items-center font-bold text-gray-800">
                            <i class="fas fa-keyboard w-6 text-gray-400 text-center mr-2"></i>
                            <a href="/admin/categories/1/edit" class="hover:text-blue-600 transition">Phụ Kiện Máy Tính</a>
                            <span class="ml-2 text-xs font-normal text-gray-400 border border-gray-200 rounded px-1.5 py-0.5 bg-white">Tầng 1</span>
                        </div>
                    </td>
                    <td class="p-4 text-gray-500">phu-kien-may-tinh</td>
                    <td class="p-4 text-center">
                        <span class="bg-green-100 text-green-700 py-1 px-2.5 rounded-full text-xs font-medium inline-block">Kích hoạt</span>
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="/admin/categories/1/edit" class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition tooltip" title="Chỉnh sửa">
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
</div>
@endsection
