@extends('user.layouts.app')

@section('title', 'Sản phẩm Máy tính & Phụ kiện')

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
                <span class="text-gray-800 font-medium">{{ $category->name }}</span>
            </div>
        </li>
    </ol>
</nav>

<div class="flex flex-col md:flex-row gap-8">

    <!-- Sidebar Filters -->
    @include('user.layouts.filter')

    <!-- Product Grid -->
    <div class="flex-1">

        <!-- Banner Khuyến mãi -->
        {{-- @include('user.layouts.banner') --}}

        <!-- Sort and Controls -->
        <div class="flex justify-between items-center bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6">
            <h1 class="text-xl font-bold text-gray-800">{{ $category->name }}</h1>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-500">Sắp xếp theo:</span>
                <select onchange="window.location.href = this.value.replace(/%2C/g, ',');" class="border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'best_selling']) }}" {{ (isset($sort) && $sort == 'best_selling') ? 'selected' : '' }}>Bán chạy nhất</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}" {{ (isset($sort) && $sort == 'price_asc') ? 'selected' : '' }}>Giá thấp đến cao</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}" {{ (isset($sort) && $sort == 'price_desc') ? 'selected' : '' }}>Giá cao đến thấp</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" {{ (!isset($sort) || $sort == 'newest') ? 'selected' : '' }}>Mới nhất</option>
                </select>
            </div>
        </div>

        <!-- Products -->
        @php
            $product2s = [
                [
                    'name' => 'Laptop Asus ROG Strix G15 (2023)',
                    'price' => '25.490.000',
                    'old_price' => '28.990.000',
                    'discount' => '-12%',
                    'image' => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?auto=format&fit=crop&q=80&w=400&h=300',
                    'category' => 'Laptop Gaming',
                    'specs' => 'Ryzen 7 6800H / RTX 3050 / 8GB / 512GB'
                ],
                [
                    'name' => 'Apple MacBook Pro M2 14-inch',
                    'price' => '47.990.000',
                    'old_price' => null,
                    'discount' => null,
                    'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&q=80&w=400&h=300',
                    'category' => 'MacBook',
                    'specs' => 'M2 Pro 10-core / 16GB / 512GB SSD'
                ],
                [
                    'name' => 'PC Gaming Core i5 13400F / RTX 4060',
                    'price' => '21.500.000',
                    'old_price' => '24.500.000',
                    'discount' => '-12%',
                    'image' => 'https://images.unsplash.com/photo-1587202372634-32705e3bf49c?auto=format&fit=crop&q=80&w=400&h=300',
                    'category' => 'PC Lắp Ráp',
                    'specs' => 'i5 13400F / 16GB RAM / 500GB NVMe / RTX 4060 8GB'
                ],
                [
                    'name' => 'Bàn phím cơ không dây Akko 3098B',
                    'price' => '1.890.000',
                    'old_price' => '2.100.000',
                    'discount' => '-10%',
                    'image' => 'https://images.unsplash.com/photo-1595225476474-87563907a212?auto=format&fit=crop&q=80&w=400&h=300',
                    'category' => 'Bàn Phím Cơ',
                    'specs' => 'Bluetooth 5.0 / 2.4Ghz / Type-C / AKKO CS Switch'
                ],
                [
                    'name' => 'Chuột Logitech G Pro X Superlight',
                    'price' => '2.990.000',
                    'old_price' => null,
                    'discount' => null,
                    'image' => 'https://images.unsplash.com/photo-1527814050087-3793815473c4?auto=format&fit=crop&q=80&w=400&h=300',
                    'category' => 'Chuột Gaming',
                    'specs' => 'Không dây / Trọng lượng siêu nhẹ 63g / Cảm biến HERO 25K'
                ],
                [
                    'name' => 'Màn hình LG UltraGear 27GN800',
                    'price' => '6.490.000',
                    'old_price' => '7.590.000',
                    'discount' => '-14%',
                    'image' => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?auto=format&fit=crop&q=80&w=400&h=300',
                    'category' => 'Màn Hình',
                    'specs' => '27 inch 2K (2560x1440) / 144Hz / IPS / 1ms (GtG)'
                ],
                [
                    'name' => 'Tai nghe Gaming HyperX Cloud II',
                    'price' => '1.690.000',
                    'old_price' => '2.290.000',
                    'discount' => '-26%',
                    'image' => 'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?auto=format&fit=crop&q=80&w=400&h=300',
                    'category' => 'Tai Nghe',
                    'specs' => 'Âm thanh vòm 7.1 / Đệm tai bọt biển êm ái'
                ],
                [
                    'name' => 'Card màn hình Gigabyte RTX 4070 Ti',
                    'price' => '22.990.000',
                    'old_price' => '24.990.000',
                    'discount' => '-8%',
                    'image' => 'https://images.unsplash.com/photo-1555680202-c86f0e12f086?auto=format&fit=crop&q=80&w=400&h=300',
                    'category' => 'VGA - Card màn hình',
                    'specs' => '12GB GDDR6X / 192-bit / 3 Fan Windforce'
                ]
            ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-shadow duration-300 border border-gray-100 overflow-hidden flex flex-col group relative">
                {{-- @if($product['discount'])
                <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded z-10">
                    {{ $product['discount'] }}
                </div>
                @endif --}}

                <div class="relative overflow-hidden pt-[75%] bg-gray-50">
                    <img src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}" class="absolute top-0 left-0 w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-500">

                    <!-- Quick action buttons overlay -->
                    <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <button class="w-10 h-10 rounded-full bg-white text-gray-700 shadow hover:text-blue-600 hover:bg-gray-50 flex items-center justify-center transition" title="Yêu thích">
                            <i class="far fa-heart"></i>
                        </button>
                        <button onclick="openQuickView({
                                name: '{{ addslashes($product->name) }}',
                                price: '{{ $product->formatted_price }}',
                                old_price: '{{ $product->old_price ? number_format($product->old_price, 0, ",", ".") . " đ" : "" }}',
                                discount: '{{ $product->old_price && $product->old_price > $product->price ? "-" . round((($product->old_price - $product->price) / $product->old_price) * 100) . "%" : "" }}',
                                image: '{{ $product->thumbnail_url }}',
                                url: '/p/{{ $product->slug }}'
                            })" 
                            class="w-10 h-10 rounded-full bg-white text-gray-700 shadow hover:text-blue-600 hover:bg-gray-50 flex items-center justify-center transition" title="Xem nhanh">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="p-5 flex flex-col flex-grow border-t border-gray-50">
                    @if (!empty($product['main_category']))
                        @foreach ($product['main_category'] as $category)
                            <span class="text-xs text-blue-600 font-semibold uppercase mb-1 tracking-wider">{{ $category['name'] }}</span>
                        @endforeach
                    @endif
                    <a href="/p/{{ $product['slug'] }}" class="text-gray-800 font-bold mb-2 hover:text-blue-600 transition line-clamp-2" title="{{ $product['name'] }}">
                        {{ $product['name'] }}
                    </a>

                    <!-- Thông số rút gọn -->
                    {{-- <p class="text-xs text-gray-500 mb-3 bg-gray-50 p-2 rounded line-clamp-2 h-[48px]">
                        {{ $product['specs'] }}
                    </p> --}}

                    <!-- Giá -->
                    <div class="mt-auto flex items-end justify-between">
                        <div>
                            <div class="text-lg font-extrabold text-red-600">{{ $product['formatted_price'] }}</div>
                            {{-- @if($product['old_price'])
                            <div class="text-xs text-gray-400 line-through">{{ $product['old_price'] }}₫</div>
                            @else
                            <div class="text-xs text-transparent select-none">No old price</div>
                            @endif --}}
                        </div>
                        {{-- <button class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white flex items-center justify-center transition shadow-sm" title="Thêm vào giỏ">
                            <i class="fas fa-cart-plus"></i>
                        </button> --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{ $products->withQueryString()->links('user.layouts.paginator') }}
        {{-- <!-- Pagination -->
        <div class="mt-10 flex justify-center">
            <nav class="flex items-center space-x-2">
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50 transition"><i class="fas fa-chevron-left text-sm"></i></a>
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-600 text-white font-medium shadow">1</a>
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50 transition font-medium">2</a>
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50 transition font-medium">3</a>
                <span class="text-gray-500">...</span>
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50 transition font-medium">12</a>
                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50 transition"><i class="fas fa-chevron-right text-sm"></i></a>
            </nav>
        </div> --}}
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Decode %2C back to comma in all pagination links
        const paginationLinks = document.querySelectorAll('.pagination a, nav[aria-label="Pagination"] a, nav[role="navigation"] a');
        paginationLinks.forEach(link => {
            if (link.href) {
                link.href = link.href.replace(/%2C/g, ',');
            }
        });
    });
</script>
@endpush
