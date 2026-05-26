<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ SHOP_NAME }} - @yield('title', 'Cửa hàng Thiết bị Điện tử')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Hiệu ứng smooth cho dropdown */
        .group:hover .group-hover\:block,
        .group\/sub:hover .group-hover\/sub\:block,
        .group\/sub2:hover .group-hover\/sub2\:block {
            display: block;
            animation: fadeIn 0.2s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <!-- Top bar -->
        <div class="border-b bg-gray-900 text-white text-xs py-2">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <span><i class="fas fa-phone-alt mr-2"></i> Hotline: {{ SHOP_PHONE }}</span>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-blue-400 transition">Khuyến mãi</a>
                    <a href="#" class="hover:text-blue-400 transition">Bảo hành</a>
                    <a href="#" class="hover:text-blue-400 transition">Giới thiệu</a>
                </div>
            </div>
        </div>

        <!-- Main Header -->
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Logo -->
            <a href="/" class="text-2xl font-bold text-blue-600 flex items-center gap-2">
                <i class="fas fa-microchip"></i> {{ SHOP_NAME }}
            </a>

            <!-- Search -->
            <div class="flex-1 max-w-2xl mx-8">
                <div class="relative flex w-full">
                    <input type="text" placeholder="Tìm kiếm laptop, phụ kiện, linh kiện..." class="w-full border border-gray-300 rounded-l-lg py-2.5 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    <button class="bg-blue-600 text-white px-6 rounded-r-lg hover:bg-blue-700 transition">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <!-- Icons -->
            <div class="flex items-center space-x-6">
                <!-- <a href="/dashboard" class="text-gray-600 hover:text-blue-600 transition text-center flex flex-col items-center">
                    <i class="far fa-user text-xl mb-1"></i>
                    <span class="text-xs font-medium">Tài khoản</span>
                </a> -->
                <a href="/favorites" class="text-gray-600 hover:text-blue-600 transition text-center flex flex-col items-center relative">
                    <i class="far fa-heart text-xl mb-1"></i>
                    <span class="text-xs font-medium">Yêu thích</span>
                    <span class="absolute -top-1 -right-2 bg-red-500 text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full">3</span>
                </a>
                <!-- <a href="#" class="text-gray-600 hover:text-blue-600 transition text-center flex flex-col items-center relative">
                    <i class="fas fa-shopping-cart text-xl mb-1"></i>
                    <span class="text-xs font-medium">Giỏ hàng</span>
                    <span class="absolute -top-1 -right-2 bg-red-500 text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full">2</span>
                </a> -->
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="bg-white border-t border-gray-100">
            <div class="container mx-auto px-4 flex">

                <!-- Category Dropdown (Dọc) -->
                <div class="group relative w-64 bg-blue-600 text-white">
                    <div class="px-4 py-3 cursor-pointer flex justify-between items-center font-semibold">
                        <span><i class="fas fa-bars mr-2"></i> DANH MỤC SẢN PHẨM</span>
                    </div>

                    <!-- Level 1 -->
                    <ul class="absolute hidden group-hover:block w-full bg-white text-gray-800 shadow-xl border border-gray-200 z-50 rounded-b-lg">

                        <!-- Level 1 Item 1 with Submenu -->
                        <li class="group/sub relative border-b border-gray-100 hover:bg-gray-50">
                            <a href="/products" class="flex justify-between items-center px-4 py-3">
                                <span class="flex items-center text-sm font-medium"><i class="fas fa-laptop w-6 text-gray-400"></i> Máy Tính & Laptop</span>
                                <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                            </a>

                            <!-- Level 2 -->
                            <ul class="absolute hidden group-hover/sub:block top-0 left-full w-56 bg-white shadow-xl border border-gray-200 rounded-r-lg h-full min-h-[300px]">
                                <!-- Level 2 Item 1 with Submenu -->
                                <li class="group/sub2 relative hover:bg-gray-50">
                                    <a href="/products" class="flex justify-between items-center px-4 py-3 border-b border-gray-100 text-sm font-medium">
                                        Laptop
                                        <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                                    </a>

                                    <!-- Level 3 -->
                                    <ul class="absolute hidden group-hover/sub2:block top-0 left-full w-56 bg-white shadow-xl border border-gray-200 rounded-r-lg">
                                        <li><a href="/products" class="block px-4 py-2.5 text-sm hover:text-blue-600 hover:bg-blue-50 transition border-b border-gray-50">Laptop Gaming</a></li>
                                        <li><a href="/products" class="block px-4 py-2.5 text-sm hover:text-blue-600 hover:bg-blue-50 transition border-b border-gray-50">Laptop Văn Phòng</a></li>
                                        <li><a href="/products" class="block px-4 py-2.5 text-sm hover:text-blue-600 hover:bg-blue-50 transition border-b border-gray-50">MacBook (Apple)</a></li>
                                        <li><a href="/products" class="block px-4 py-2.5 text-sm hover:text-blue-600 hover:bg-blue-50 transition">Laptop Đồ Họa</a></li>
                                    </ul>
                                </li>
                                <!-- Level 2 Item 2 -->
                                <li class="group/sub2 relative hover:bg-gray-50">
                                    <a href="/products" class="flex justify-between items-center px-4 py-3 border-b border-gray-100 text-sm font-medium">
                                        PC Lắp Ráp
                                        <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                                    </a>

                                    <!-- Level 3 -->
                                    <ul class="absolute hidden group-hover/sub2:block top-0 left-full w-56 bg-white shadow-xl border border-gray-200 rounded-r-lg">
                                        <li><a href="/products" class="block px-4 py-2.5 text-sm hover:text-blue-600 hover:bg-blue-50 transition border-b border-gray-50">PC Gaming</a></li>
                                        <li><a href="/products" class="block px-4 py-2.5 text-sm hover:text-blue-600 hover:bg-blue-50 transition">PC Văn Phòng</a></li>
                                    </ul>
                                </li>
                                <li class="hover:bg-gray-50">
                                    <a href="/products" class="block px-4 py-3 border-b border-gray-100 text-sm font-medium">Màn Hình Máy Tính</a>
                                </li>
                            </ul>
                        </li>

                        <!-- Level 1 Item 2 with Submenu -->
                        <li class="group/sub relative border-b border-gray-100 hover:bg-gray-50">
                            <a href="/products" class="flex justify-between items-center px-4 py-3">
                                <span class="flex items-center text-sm font-medium"><i class="fas fa-keyboard w-6 text-gray-400"></i> Phụ Kiện Máy Tính</span>
                                <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                            </a>

                            <!-- Level 2 -->
                            <ul class="absolute hidden group-hover/sub:block top-0 left-full w-56 bg-white shadow-xl border border-gray-200 rounded-r-lg h-full min-h-[300px]">
                                <li class="group/sub2 relative hover:bg-gray-50">
                                    <a href="/products" class="flex justify-between items-center px-4 py-3 border-b border-gray-100 text-sm font-medium">
                                        Bàn phím
                                        <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                                    </a>
                                    <!-- Level 3 -->
                                    <ul class="absolute hidden group-hover/sub2:block top-0 left-full w-56 bg-white shadow-xl border border-gray-200 rounded-r-lg">
                                        <li><a href="/products" class="block px-4 py-2.5 text-sm hover:text-blue-600 hover:bg-blue-50 transition border-b border-gray-50">Bàn phím cơ</a></li>
                                        <li><a href="/products" class="block px-4 py-2.5 text-sm hover:text-blue-600 hover:bg-blue-50 transition border-b border-gray-50">Bàn phím giả cơ</a></li>
                                        <li><a href="/products" class="block px-4 py-2.5 text-sm hover:text-blue-600 hover:bg-blue-50 transition">Keycap & Switch</a></li>
                                    </ul>
                                </li>
                                <li class="group/sub2 relative hover:bg-gray-50">
                                    <a href="/products" class="flex justify-between items-center px-4 py-3 border-b border-gray-100 text-sm font-medium">
                                        Chuột máy tính
                                        <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                                    </a>
                                    <!-- Level 3 -->
                                    <ul class="absolute hidden group-hover/sub2:block top-0 left-full w-56 bg-white shadow-xl border border-gray-200 rounded-r-lg">
                                        <li><a href="/products" class="block px-4 py-2.5 text-sm hover:text-blue-600 hover:bg-blue-50 transition border-b border-gray-50">Chuột Gaming</a></li>
                                        <li><a href="/products" class="block px-4 py-2.5 text-sm hover:text-blue-600 hover:bg-blue-50 transition">Chuột Bluetooth / Không dây</a></li>
                                    </ul>
                                </li>
                                <li><a href="/products" class="block px-4 py-3 border-b border-gray-100 hover:bg-gray-50 text-sm font-medium">Tai nghe Gaming</a></li>
                                <li><a href="/products" class="block px-4 py-3 border-b border-gray-100 hover:bg-gray-50 text-sm font-medium">Balo & Túi chống sốc</a></li>
                            </ul>
                        </li>

                        <!-- Level 1 Item 3 -->
                        <li class="group/sub relative border-b border-gray-100 hover:bg-gray-50">
                            <a href="/products" class="flex justify-between items-center px-4 py-3">
                                <span class="flex items-center text-sm font-medium"><i class="fas fa-microchip w-6 text-gray-400"></i> Linh Kiện PC</span>
                                <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                            </a>
                            <!-- Level 2 -->
                            <ul class="absolute hidden group-hover/sub:block top-0 left-full w-56 bg-white shadow-xl border border-gray-200 rounded-r-lg h-full min-h-[300px]">
                                <li><a href="/products" class="block px-4 py-3 border-b border-gray-100 hover:bg-gray-50 text-sm font-medium">VGA - Card màn hình</a></li>
                                <li><a href="/products" class="block px-4 py-3 border-b border-gray-100 hover:bg-gray-50 text-sm font-medium">CPU - Bộ vi xử lý</a></li>
                                <li><a href="/products" class="block px-4 py-3 border-b border-gray-100 hover:bg-gray-50 text-sm font-medium">Mainboard - Bo mạch chủ</a></li>
                                <li><a href="/products" class="block px-4 py-3 border-b border-gray-100 hover:bg-gray-50 text-sm font-medium">RAM / Ổ cứng</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <!-- Horizontal Menu -->
                <ul class="flex space-x-8 px-8 items-center font-medium text-gray-700 text-sm">
                    <li><a href="/" class="hover:text-blue-600 transition">Trang chủ</a></li>
                    <li><a href="/products" class="hover:text-blue-600 transition text-blue-600">Sản phẩm</a></li>
                    <!-- <li><a href="#" class="hover:text-blue-600 transition text-red-600 font-bold"><i class="fas fa-bolt mr-1"></i>Flash Sale</a></li> -->
                    <li><a href="#" class="hover:text-blue-600 transition">Build PC</a></li>
                    <!-- <li><a href="#" class="hover:text-blue-600 transition">Tin tức công nghệ</a></li> -->
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="flex-grow mt-4 container mx-auto px-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12 mt-12 border-t-4 border-blue-600">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-white text-xl font-bold mb-4 flex items-center gap-2"><i class="fas fa-microchip"></i> {{ SHOP_NAME }}</h3>
                <p class="text-sm mb-4 text-gray-400">Hệ thống bán lẻ thiết bị điện tử, PC Gaming, Laptop và phụ kiện hàng đầu.</p>
                <div class="flex space-x-4">
                    <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-600 hover:text-white transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center hover:bg-red-600 hover:text-white transition"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-400 hover:text-white transition"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4 uppercase text-sm">Chính sách</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-white transition">Chính sách bảo hành</a></li>
                    <li><a href="#" class="hover:text-white transition">Chính sách đổi trả 1-1</a></li>
                    <li><a href="#" class="hover:text-white transition">Chính sách giao hàng tận nơi</a></li>
                    <li><a href="#" class="hover:text-white transition">Bảo mật thông tin khách hàng</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4 uppercase text-sm">Hỗ trợ khách hàng</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-white transition">Hướng dẫn mua hàng online</a></li>
                    <li><a href="#" class="hover:text-white transition">Hướng dẫn mua trả góp</a></li>
                    <li><a href="#" class="hover:text-white transition">Gửi yêu cầu bảo hành</a></li>
                    <li><a href="#" class="hover:text-white transition">Góp ý, khiếu nại</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4 uppercase text-sm">Liên hệ</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li class="flex items-start"><i class="fas fa-map-marker-alt mt-1 mr-3 text-blue-500 w-4 text-center"></i> 123 Đường Công Nghệ, Quận 1, TP. HCM</li>
                    <li class="flex items-center"><i class="fas fa-phone mt-1 mr-3 text-blue-500 w-4 text-center"></i> {{ SHOP_PHONE }} (8:00 - 21:00)</li>
                    <li class="flex items-center"><i class="fas fa-envelope mt-1 mr-3 text-blue-500 w-4 text-center"></i> cskh@techstore.vn</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-500">
            <p>&copy; 2026 {{ SHOP_NAME }}. Tất cả quyền được bảo lưu.</p>
        </div>
    </footer>
    @stack('scripts')
    @stack('styles')
</body>
</html>
