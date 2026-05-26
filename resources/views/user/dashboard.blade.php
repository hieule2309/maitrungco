@extends('user.layouts.app')

@section('title', 'Bảng điều khiển cá nhân')

@section('content')
<!-- Breadcrumb -->
<nav class="flex text-sm text-gray-500 mb-6" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="/" class="hover:text-blue-600 transition"><i class="fas fa-home mr-2"></i>Trang chủ</a>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <i class="fas fa-chevron-right text-xs mx-2"></i>
                <span class="text-gray-800 font-medium">Bảng điều khiển</span>
            </div>
        </li>
    </ol>
</nav>

<div class="flex flex-col md:flex-row gap-8">
    
    <!-- User Sidebar -->
    <aside class="w-full md:w-64 flex-shrink-0">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
            <div class="p-6 text-center border-b border-gray-50 bg-gradient-to-b from-blue-50 to-white">
                <div class="w-24 h-24 rounded-full bg-blue-100 mx-auto mb-4 border-4 border-white shadow-sm overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name=Nguyen+Van+A&background=random&size=96" alt="Avatar" class="w-full h-full object-cover">
                </div>
                <h3 class="font-bold text-gray-800 text-lg">Nguyễn Văn A</h3>
                <p class="text-sm text-gray-500">Khách hàng VIP</p>
            </div>
            <nav class="p-4">
                <ul class="space-y-1">
                    <li>
                        <a href="/dashboard" class="flex items-center px-4 py-3 bg-blue-50 text-blue-700 rounded-lg font-medium transition">
                            <i class="fas fa-home w-6 text-center mr-2"></i> Tổng quan
                        </a>
                    </li>
                    <li>
                        <a href="/profile" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg font-medium transition">
                            <i class="fas fa-user w-6 text-center mr-2"></i> Hồ sơ cá nhân
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg font-medium transition">
                            <i class="fas fa-box-open w-6 text-center mr-2"></i> Đơn hàng của tôi
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-between px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg font-medium transition">
                            <div class="flex items-center">
                                <i class="fas fa-heart w-6 text-center mr-2"></i> Yêu thích
                            </div>
                            <span class="bg-red-100 text-red-600 text-xs py-1 px-2 rounded-full font-bold">3</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg font-medium transition">
                            <i class="fas fa-map-marker-alt w-6 text-center mr-2"></i> Sổ địa chỉ
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="p-4 border-t border-gray-50">
                <a href="#" class="flex items-center px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg font-medium transition">
                    <i class="fas fa-sign-out-alt w-6 text-center mr-2"></i> Đăng xuất
                </a>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tổng quan tài khoản</h1>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
                <div class="w-14 h-14 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-2xl mr-4 flex-shrink-0">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Tổng đơn hàng</p>
                    <h3 class="text-2xl font-bold text-gray-800">12</h3>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
                <div class="w-14 h-14 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-2xl mr-4 flex-shrink-0">
                    <i class="fas fa-wallet"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Tổng chi tiêu</p>
                    <h3 class="text-2xl font-bold text-gray-800">32.5M <span class="text-sm font-normal">VNĐ</span></h3>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
                <div class="w-14 h-14 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center text-2xl mr-4 flex-shrink-0">
                    <i class="fas fa-star"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Điểm tích lũy</p>
                    <h3 class="text-2xl font-bold text-gray-800">1,250</h3>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-lg font-bold text-gray-800">Đơn hàng gần đây</h2>
                <a href="#" class="text-sm text-blue-600 hover:underline font-medium">Xem tất cả</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600 text-sm">
                            <th class="p-4 font-semibold border-b">Mã đơn hàng</th>
                            <th class="p-4 font-semibold border-b">Ngày đặt</th>
                            <th class="p-4 font-semibold border-b">Sản phẩm</th>
                            <th class="p-4 font-semibold border-b">Tổng tiền</th>
                            <th class="p-4 font-semibold border-b">Trạng thái</th>
                            <th class="p-4 font-semibold border-b text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 font-medium text-blue-600">#ORD-20260515</td>
                            <td class="p-4">15/05/2026</td>
                            <td class="p-4">
                                <div class="flex items-center">
                                    <img src="https://images.unsplash.com/photo-1595225476474-87563907a212?auto=format&fit=crop&q=80&w=100&h=100" class="w-10 h-10 rounded object-cover mr-3">
                                    <span class="truncate max-w-[200px]">Bàn phím cơ Akko 3098B</span>
                                </div>
                            </td>
                            <td class="p-4 font-semibold">1.890.000₫</td>
                            <td class="p-4">
                                <span class="bg-green-100 text-green-700 py-1 px-2.5 rounded-full text-xs font-medium">Đã giao hàng</span>
                            </td>
                            <td class="p-4 text-center">
                                <button class="text-gray-400 hover:text-blue-600 transition"><i class="fas fa-eye"></i></button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 font-medium text-blue-600">#ORD-20260422</td>
                            <td class="p-4">22/04/2026</td>
                            <td class="p-4">
                                <div class="flex items-center">
                                    <img src="https://images.unsplash.com/photo-1527814050087-3793815473c4?auto=format&fit=crop&q=80&w=100&h=100" class="w-10 h-10 rounded object-cover mr-3">
                                    <span class="truncate max-w-[200px]">Chuột Logitech G Pro X...</span>
                                </div>
                            </td>
                            <td class="p-4 font-semibold">2.990.000₫</td>
                            <td class="p-4">
                                <span class="bg-green-100 text-green-700 py-1 px-2.5 rounded-full text-xs font-medium">Đã giao hàng</span>
                            </td>
                            <td class="p-4 text-center">
                                <button class="text-gray-400 hover:text-blue-600 transition"><i class="fas fa-eye"></i></button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 font-medium text-blue-600">#ORD-20260518</td>
                            <td class="p-4">18/05/2026</td>
                            <td class="p-4">
                                <div class="flex items-center">
                                    <img src="https://images.unsplash.com/photo-1587202372634-32705e3bf49c?auto=format&fit=crop&q=80&w=100&h=100" class="w-10 h-10 rounded object-cover mr-3">
                                    <span class="truncate max-w-[200px]">PC Gaming Core i5 13400F</span>
                                </div>
                            </td>
                            <td class="p-4 font-semibold">21.500.000₫</td>
                            <td class="p-4">
                                <span class="bg-blue-100 text-blue-700 py-1 px-2.5 rounded-full text-xs font-medium">Đang xử lý</span>
                            </td>
                            <td class="p-4 text-center">
                                <button class="text-gray-400 hover:text-blue-600 transition"><i class="fas fa-eye"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
