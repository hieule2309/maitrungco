@extends('user.layouts.app')

@section('title', $product->name )

@section('content')
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

<!-- Breadcrumb -->
<nav class="flex text-sm text-gray-500 mb-6" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="/" class="hover:text-blue-600 transition"><i class="fas fa-home mr-2"></i>Trang chủ</a>
        </li>
        @foreach($breadcrumbs as $breadcrumb)
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-xs mx-2"></i>
                    <a href="/c/{{ $breadcrumb->slug }}" class="hover:text-blue-600 transition">{{ $breadcrumb->name }}</a>
                </div>
            </li>
        @endforeach
        <li aria-current="page">
            <div class="flex items-center">
                <i class="fas fa-chevron-right text-xs mx-2"></i>
                <span class="text-gray-800 font-medium">{{ $product->name }}</span>
            </div>
        </li>
    </ol>
</nav>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 mb-8">
    <div class="flex flex-col lg:flex-row gap-10">

        <!-- Cột Trái: Ảnh sản phẩm (Swiper Slider) -->
        <div class="w-full lg:w-1/2 relative">
            <!-- Thẻ giảm giá -->
            {{-- <div class="absolute top-4 left-4 bg-red-500 text-white text-sm font-bold px-3 py-1.5 rounded z-10 shadow-lg">
                Giảm 12%
            </div> --}}

            <!-- Swiper Slider Chính -->
            <div class="swiper mainSwiper rounded-xl overflow-hidden border border-gray-100 mb-4 bg-gray-50">
                <div class="swiper-wrapper">
                    <!-- Ảnh 1 -->
                    @foreach ($images as $image)
                    <div class="swiper-slide cursor-crosshair">
                        <img src="{{ $image->url }}" alt="{{ $product->slug.$image->sort }}" class="w-full h-[400px] object-contain p-4">
                    </div>
                    @endforeach
                </div>
                <!-- Điều hướng -->
                <div class="swiper-button-next text-gray-800 bg-white/80 w-10 h-10 rounded-full shadow-md flex items-center justify-center after:text-lg"></div>
                <div class="swiper-button-prev text-gray-800 bg-white/80 w-10 h-10 rounded-full shadow-md flex items-center justify-center after:text-lg"></div>
            </div>

            <!-- Swiper Thumbnail -->
            <div class="swiper thumbSwiper h-20">
                <div class="swiper-wrapper">
                    @foreach ($images as $image)
                        <div class="swiper-slide cursor-pointer border-2 border-transparent rounded-lg overflow-hidden opacity-60 hover:opacity-100 transition duration-300">
                        <img src="{{ $image->url }}" alt="{{ $product->slug.$image->sort }}" class="w-full h-full object-cover">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Cột Phải: Thông tin chi tiết -->
        <div class="w-full lg:w-1/2 flex flex-col">
            <div class="mb-4">
                {{-- <span class="text-sm font-semibold text-blue-600 uppercase tracking-wider mb-2 block">Asus</span> --}}
                <h1 class="text-3xl font-extrabold text-gray-900 leading-tight mb-2">{{ $product->name }}</h1>

                <div class="flex items-center space-x-4 text-sm mt-3">
                    {{-- <div class="flex items-center text-yellow-400">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                        <span class="text-gray-500 ml-2">(4.8/5 - 128 đánh giá)</span>
                    </div>
                    <span class="text-gray-300">|</span>
                    <span class="text-gray-500">Đã bán: <span class="font-semibold text-gray-800">450+</span></span>
                    <span class="text-gray-300">|</span> --}}
                    <span class="text-green-600 font-medium"><i class="fas fa-check-circle mr-1"></i>Còn hàng</span>
                </div>
            </div>

            <div class="bg-gray-50 p-6 rounded-xl mb-6 border border-gray-100">
                <div class="flex items-end mb-2">
                    <span class="text-4xl font-extrabold text-red-600">{{ $product->formatted_price }}</span>
                    {{-- <span class="text-lg text-gray-400 line-through ml-4 mb-1">28.990.000₫</span> --}}
                </div>
                {{-- <p class="text-sm text-gray-600">Trả góp chỉ từ <span class="font-semibold text-blue-600">2.124.000₫/tháng</span> qua thẻ tín dụng.</p> --}}
            </div>

            <!-- Cấu hình nổi bật -->
            {{-- <div class="mb-6">
                <h3 class="font-bold text-gray-800 mb-3">Cấu hình nổi bật:</h3>
                <ul class="grid grid-cols-2 gap-y-2 gap-x-4 text-sm text-gray-700 bg-white">
                    <li class="flex items-center"><i class="fas fa-microchip text-gray-400 w-5"></i> AMD Ryzen™ 7 6800H</li>
                    <li class="flex items-center"><i class="fas fa-memory text-gray-400 w-5"></i> 8GB DDR5 4800MHz</li>
                    <li class="flex items-center"><i class="fas fa-hdd text-gray-400 w-5"></i> 512GB PCIe® 4.0 NVMe™</li>
                    <li class="flex items-center"><i class="fas fa-vr-cardboard text-gray-400 w-5"></i> NVIDIA® GeForce RTX™ 3050</li>
                    <li class="flex items-center"><i class="fas fa-desktop text-gray-400 w-5"></i> 15.6" FHD 144Hz</li>
                    <li class="flex items-center"><i class="fas fa-battery-full text-gray-400 w-5"></i> 4-cell, 56WHrs</li>
                </ul>
            </div> --}}

            <hr class="border-gray-100 mb-6">

            {{-- <!-- Biến thể (Màu sắc / RAM) -->
            <div class="mb-6">
                <h3 class="font-bold text-gray-800 mb-3">Tùy chọn RAM:</h3>
                <div class="flex space-x-3">
                    <button class="border-2 border-blue-600 text-blue-600 font-semibold px-4 py-2 rounded-lg bg-blue-50 transition">
                        8GB DDR5
                    </button>
                    <button class="border border-gray-300 text-gray-700 font-medium px-4 py-2 rounded-lg hover:border-blue-600 hover:text-blue-600 transition">
                        16GB DDR5 (+1.500.000₫)
                    </button>
                </div>
            </div>

            <!-- Khuyến mãi -->
            <div class="border border-green-200 bg-green-50 rounded-xl p-4 mb-6">
                <h4 class="text-green-800 font-bold text-sm flex items-center mb-2">
                    <i class="fas fa-gift mr-2 text-lg"></i> Quà tặng & Khuyến mãi
                </h4>
                <ul class="text-sm text-green-700 space-y-1 ml-6 list-disc marker:text-green-500">
                    <li>Tặng Balo Gaming ROG trị giá 890.000đ</li>
                    <li>Tặng Chuột không dây Logitech trị giá 250.000đ</li>
                    <li>Giảm thêm 500.000đ khi thanh toán qua VNPay</li>
                </ul>
            </div> --}}

            <!-- Nút hành động -->
            <div class="flex flex-col sm:flex-row gap-4">
                {{-- <div class="flex border border-gray-300 rounded-lg overflow-hidden w-full sm:w-32 flex-shrink-0">
                    <button class="w-10 h-10 bg-gray-50 text-gray-600 hover:bg-gray-200 flex items-center justify-center transition">-</button>
                    <input type="number" value="1" min="1" class="w-full h-10 text-center border-none focus:ring-0 font-semibold text-gray-800">
                    <button class="w-10 h-10 bg-gray-50 text-gray-600 hover:bg-gray-200 flex items-center justify-center transition">+</button>
                </div> --}}

                <button class="flex-1 bg-blue-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg shadow-blue-200 hover:bg-blue-700 hover:shadow-xl transition transform hover:-translate-y-0.5 flex justify-center items-center">
                    {{-- <i class="fas fa-cart-plus mr-2"></i> --}}
                    Mua hàng liên hệ {{ SHOP_PHONE }}
                </button>
                <button class="w-12 h-12 flex-shrink-0 border border-gray-300 rounded-lg text-red-500 flex items-center justify-center hover:bg-red-50 hover:border-red-200 transition text-xl tooltip" title="Thêm vào yêu thích">
                    <i class="far fa-heart"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Nội dung chi tiết & Thông số -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Đặc điểm nổi bật</h2>

            <div class="prose max-w-none text-gray-700 space-y-6">
                {{ $product->description }}
                {{-- <p>
                    <strong>Asus ROG Strix G15</strong> là hiện thân của phong cách thiết kế tối giản, mang đến một trải nghiệm cốt lõi đáng kinh ngạc phục vụ cho những game thủ thi đấu eSports chuyên nghiệp thực thụ.
                </p>
                <img src="https://images.unsplash.com/photo-1542393545-10f5cde2c810?auto=format&fit=crop&q=80&w=1200&h=400" alt="Banner bài viết" class="w-full rounded-xl my-6">
                <h3 class="text-xl font-bold text-gray-800 mt-6 mb-3">Hiệu năng tuyệt đỉnh</h3>
                <p>
                    Sức mạnh đến từ bộ vi xử lý AMD Ryzen™ 7 mạnh mẽ mới nhất và GPU GeForce RTX™ 30 series, mang lại trải nghiệm chơi game cực kỳ mượt mà. Hệ thống tản nhiệt thông minh của ROG được nâng cấp, sử dụng keo tản nhiệt kim loại lỏng Liquid Metal để giải phóng tối đa sức mạnh của phần cứng.
                </p>
                <h3 class="text-xl font-bold text-gray-800 mt-6 mb-3">Tần số quét 144Hz mượt mà</h3>
                <p>
                    Màn hình tần số quét 144Hz siêu nhanh giúp bạn bắt kịp mọi khoảnh khắc trong các tựa game nhịp độ cao. Công nghệ Adaptive-Sync loại bỏ hiện tượng xé hình.
                </p> --}}
            </div>
        </div>
    </div>

    @if ($attributes->isNotEmpty())
        <div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                <h2 class="text-xl font-bold text-gray-800 mb-6 border-b pb-4">Thông số kỹ thuật</h2>
                <table class="w-full text-sm text-left">
                    <tbody class="divide-y divide-gray-100">
                        @foreach($attributes as $groupName => $value)
                            <tr>
                                <td class="py-3 font-medium text-gray-500 w-1/3">{{ $groupName }}</td>
                                <td class="py-3 text-gray-800">{{ $value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

@endsection

@push('styles')
    @vite(['resources/css/user/products/show.css'])
@endpush

@push('scripts')
    @vite(['resources/js/user/products/show.js'])
@endpush
