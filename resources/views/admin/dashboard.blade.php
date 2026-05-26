@extends('admin.layouts.app')

@section('title', 'Bảng điều khiển')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Tổng quan hệ thống</h1>
        <p class="text-sm text-gray-500 mt-1">Xin chào Admin, dưới đây là tóm tắt hoạt động hôm nay.</p>
    </div>
    <div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition shadow-sm">
            <i class="fas fa-download mr-2"></i> Xuất báo cáo
        </button>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center">
        <div class="w-12 h-12 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xl mr-4 flex-shrink-0">
            <i class="fas fa-shopping-bag"></i>
        </div>
        <div>
            <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Đơn hàng mới</p>
            <h3 class="text-2xl font-bold text-gray-800">142 <span class="text-sm font-medium text-green-500 ml-2"><i class="fas fa-arrow-up"></i> 12%</span></h3>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center">
        <div class="w-12 h-12 rounded-lg bg-green-50 text-green-600 flex items-center justify-center text-xl mr-4 flex-shrink-0">
            <i class="fas fa-money-bill-wave"></i>
        </div>
        <div>
            <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Doanh thu</p>
            <h3 class="text-2xl font-bold text-gray-800">125.5M <span class="text-sm font-medium text-green-500 ml-2"><i class="fas fa-arrow-up"></i> 8%</span></h3>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center">
        <div class="w-12 h-12 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center text-xl mr-4 flex-shrink-0">
            <i class="fas fa-box-open"></i>
        </div>
        <div>
            <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Sản phẩm</p>
            <h3 class="text-2xl font-bold text-gray-800">1,245</h3>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center">
        <div class="w-12 h-12 rounded-lg bg-yellow-50 text-yellow-600 flex items-center justify-center text-xl mr-4 flex-shrink-0">
            <i class="fas fa-users"></i>
        </div>
        <div>
            <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Khách hàng mới</p>
            <h3 class="text-2xl font-bold text-gray-800">48 <span class="text-sm font-medium text-red-500 ml-2"><i class="fas fa-arrow-down"></i> 2%</span></h3>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Chart placeholder -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-bold text-gray-800">Thống kê doanh thu</h2>
            <select class="text-sm border-gray-300 rounded-lg bg-gray-50 py-1.5 pl-3 pr-8 focus:ring-blue-500">
                <option>7 ngày qua</option>
                <option>Tháng này</option>
                <option>Năm nay</option>
            </select>
        </div>
        <!-- Giả lập biểu đồ -->
        <div class="h-72 w-full flex items-end space-x-2 pb-6 relative">
            <div class="absolute inset-0 border-b border-l border-gray-200"></div>
            <!-- Cột -->
            <div class="w-1/7 bg-blue-100 hover:bg-blue-200 relative group h-[40%]" style="width: 14%">
                <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition">12M</div>
            </div>
            <div class="w-1/7 bg-blue-500 hover:bg-blue-600 relative group h-[70%]" style="width: 14%">
                <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition">35M</div>
            </div>
            <div class="w-1/7 bg-blue-200 hover:bg-blue-300 relative group h-[50%]" style="width: 14%"></div>
            <div class="w-1/7 bg-blue-400 hover:bg-blue-500 relative group h-[60%]" style="width: 14%"></div>
            <div class="w-1/7 bg-blue-300 hover:bg-blue-400 relative group h-[45%]" style="width: 14%"></div>
            <div class="w-1/7 bg-blue-600 hover:bg-blue-700 relative group h-[85%]" style="width: 14%"></div>
            <div class="w-1/7 bg-blue-500 hover:bg-blue-600 relative group h-[65%]" style="width: 14%"></div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-lg font-bold text-gray-800">Đơn hàng chờ xử lý</h2>
        </div>
        <div class="p-0">
            <ul class="divide-y divide-gray-100">
                <li class="p-4 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-semibold text-gray-800">#ORD-001</p>
                            <p class="text-xs text-gray-500 mt-1">Nguyễn Văn A - 2 phút trước</p>
                        </div>
                        <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-2 py-1 rounded">Chờ duyệt</span>
                    </div>
                    <div class="mt-2 text-sm text-gray-600">Tổng: <strong class="text-red-600">1.890.000₫</strong></div>
                </li>
                <li class="p-4 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-semibold text-gray-800">#ORD-002</p>
                            <p class="text-xs text-gray-500 mt-1">Trần Thị B - 15 phút trước</p>
                        </div>
                        <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-2 py-1 rounded">Chờ duyệt</span>
                    </div>
                    <div class="mt-2 text-sm text-gray-600">Tổng: <strong class="text-red-600">47.990.000₫</strong></div>
                </li>
                <li class="p-4 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-semibold text-gray-800">#ORD-003</p>
                            <p class="text-xs text-gray-500 mt-1">Lê Văn C - 1 giờ trước</p>
                        </div>
                        <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-2 py-1 rounded">Chờ duyệt</span>
                    </div>
                    <div class="mt-2 text-sm text-gray-600">Tổng: <strong class="text-red-600">2.990.000₫</strong></div>
                </li>
            </ul>
        </div>
        <div class="p-4 border-t border-gray-100 bg-gray-50 text-center">
            <a href="#" class="text-sm text-blue-600 font-medium hover:underline">Xem tất cả đơn hàng</a>
        </div>
    </div>
</div>
@endsection
