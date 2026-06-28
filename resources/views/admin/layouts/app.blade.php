<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị - @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 antialiased flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col flex-shrink-0 transition-all duration-300 z-20">
        <!-- Logo -->
        <div class="h-16 flex items-center px-6 border-b border-gray-800 bg-gray-950">
            <a href="/admin" class="text-xl font-bold text-white flex items-center gap-2">
                <i class="fas fa-microchip text-blue-500"></i> TechAdmin
            </a>
        </div>

        <!-- Navigation -->
        <div class="flex-1 overflow-y-auto py-4">
            <ul class="space-y-1 px-3">
                <li class="mb-2 px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Dashboard</li>
                <li>
                    <a href="/admin" class="flex items-center px-3 py-2.5 rounded-lg {{ request()->is('admin') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition">
                        <i class="fas fa-tachometer-alt w-6 text-center mr-2"></i> Dashboard
                    </a>
                </li>

                <li class="mt-6 mb-2 px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Quản lý Sản phẩm</li>
                <li>
                    <a href="/admin/products" class="flex items-center px-3 py-2.5 rounded-lg {{ request()->is('admin/products*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition">
                        <i class="fas fa-box w-6 text-center mr-2"></i> Sản phẩm
                    </a>
                </li>
                <li>
                    <a href="/admin/categories" class="flex items-center px-3 py-2.5 rounded-lg {{ request()->is('admin/categories*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition">
                        <i class="fas fa-tags w-6 text-center mr-2"></i> Danh mục
                    </a>
                </li>

                <li>
                    <a href="/admin/filter-groups" class="flex items-center px-3 py-2.5 rounded-lg {{ request()->is('admin/filter-groups*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition">
                        <i class="fas fa-layer-group w-6 text-center mr-2"></i> Nhóm Filter
                    </a>
                </li>
                <li>
                    <a href="/admin/filter-values" class="flex items-center px-3 py-2.5 rounded-lg {{ request()->is('admin/filter-values*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition">
                        <i class="fas fa-sliders-h w-6 text-center mr-2"></i> Giá trị Filter
                    </a>
                </li>

                <li class="mt-6 mb-2 px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Bán hàng</li>
                <li>
                    <a href="#" class="flex items-center px-3 py-2.5 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition">
                        <i class="fas fa-shopping-cart w-6 text-center mr-2"></i> Đơn hàng
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center px-3 py-2.5 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition">
                        <i class="fas fa-users w-6 text-center mr-2"></i> Khách hàng
                    </a>
                </li>
            </ul>
        </div>

        <!-- User Profile in Sidebar -->
        <div class="p-4 border-t border-gray-800 bg-gray-950">
            <div class="flex items-center">
                <img src="https://ui-avatars.com/api/?name=Admin&background=random" alt="Admin" class="w-10 h-10 rounded-full border-2 border-gray-700">
                <div class="ml-3">
                    <p class="text-sm font-medium text-white">Administrator</p>
                    <form method="POST" action="{{ route('logout') }}" id="logout-form" class="inline">
                        @csrf
                        <a href="{{ route('logout') }}"
                        class="text-xs text-gray-400 hover:text-white"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                            Đăng xuất
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden bg-gray-50">

        <!-- Header -->
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6 z-10 flex-shrink-0">
            <!-- Search -->
            <div class="flex-1 max-w-lg relative">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" placeholder="Tìm kiếm nhanh..." class="w-full bg-gray-100 border-none rounded-lg pl-10 pr-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
            </div>

            <!-- Actions -->
            <div class="flex items-center space-x-4">
                <a href="/" target="_blank" class="flex items-center text-sm font-medium text-gray-600 hover:text-blue-600 transition bg-gray-100 px-3 py-1.5 rounded-lg">
                    <i class="fas fa-external-link-alt mr-2"></i> Xem trang chủ
                </a>
            </div>
        </header>

        <!-- Main Area -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
            @yield('content')
        </main>
    </div>
    @stack('scripts')
    @stack('styles')
</body>
</html>
