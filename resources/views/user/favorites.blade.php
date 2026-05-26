@extends('user.layouts.app')

@section('title', 'Sản phẩm yêu thích')

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
                    <span class="text-gray-800 font-medium">Sản phẩm yêu thích</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 mb-8">
        <div class="flex justify-between items-end border-b border-gray-100 pb-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800"><i class="fas fa-heart text-red-500 mr-2"></i>Sản phẩm yêu thích</h1>
                <p class="text-sm text-gray-500 mt-1">Danh sách các sản phẩm bạn đã lưu để theo dõi.</p>
            </div>
            <button class="text-sm text-red-500 hover:text-red-700 transition font-medium flex items-center">
                <i class="fas fa-trash-alt mr-2"></i> Xóa tất cả
            </button>
        </div>

        @php
            // Mock data cho danh sách yêu thích
            $favorites = [
                [
                    'name' => 'Laptop Asus ROG Strix G15 (2023)',
                    'price' => '25.490.000',
                    'old_price' => '28.990.000',
                    'discount' => '-12%',
                    'image' => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?auto=format&fit=crop&q=80&w=400&h=300',
                    'category' => 'Laptop Gaming',
                ],
                [
                    'name' => 'Bàn phím cơ không dây Akko 3098B',
                    'price' => '1.890.000',
                    'old_price' => '2.100.000',
                    'discount' => '-10%',
                    'image' => 'https://images.unsplash.com/photo-1595225476474-87563907a212?auto=format&fit=crop&q=80&w=400&h=300',
                    'category' => 'Bàn Phím Cơ',
                ],
                [
                    'name' => 'Chuột Logitech G Pro X Superlight',
                    'price' => '2.990.000',
                    'old_price' => null,
                    'discount' => null,
                    'image' => 'https://images.unsplash.com/photo-1527814050087-3793815473c4?auto=format&fit=crop&q=80&w=400&h=300',
                    'category' => 'Chuột Gaming',
                ]
            ];
        @endphp

        <!-- Empty state (Ẩn đi, hiển thị bằng JS nếu danh sách trống) -->
        <div class="hidden flex-col items-center justify-center py-12 text-center" id="empty-favorites">
            <div class="w-24 h-24 bg-red-50 rounded-full flex items-center justify-center mb-4">
                <i class="far fa-heart text-4xl text-red-300"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2">Danh sách yêu thích trống</h3>
            <p class="text-gray-500 mb-6 max-w-md mx-auto">Bạn chưa lưu sản phẩm nào. Hãy duyệt qua các sản phẩm và bấm vào biểu tượng trái tim để lưu lại nhé.</p>
            <a href="/products" class="bg-blue-600 text-white font-bold py-2 px-6 rounded-lg shadow hover:bg-blue-700 transition">
                Tiếp tục mua sắm
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="favorites-grid">
            @foreach($favorites as $index => $product)
            <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-shadow duration-300 border border-gray-100 overflow-hidden flex flex-col group relative favorite-item">
                @if($product['discount'])
                <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded z-10">
                    {{ $product['discount'] }}
                </div>
                @endif

                <button class="absolute top-3 right-3 w-8 h-8 bg-white/90 rounded-full text-red-500 flex items-center justify-center z-10 shadow hover:bg-red-50 transition tooltip remove-btn" title="Bỏ yêu thích">
                    <i class="fas fa-heart"></i>
                </button>

                <div class="relative overflow-hidden pt-[75%] bg-gray-50">
                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="absolute top-0 left-0 w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-500">
                </div>

                <div class="p-4 flex flex-col flex-grow border-t border-gray-50">
                    <span class="text-xs text-blue-600 font-semibold uppercase mb-1 tracking-wider">{{ $product['category'] }}</span>
                    <a href="/products/1" class="text-gray-800 font-bold mb-2 hover:text-blue-600 transition line-clamp-2 text-sm" title="{{ $product['name'] }}">
                        {{ $product['name'] }}
                    </a>

                    <!-- Giá -->
                    <div class="mt-auto flex items-end justify-between mb-3">
                        <div>
                            <div class="text-lg font-extrabold text-red-600">{{ $product['price'] }}₫</div>
                            @if($product['old_price'])
                            <div class="text-xs text-gray-400 line-through">{{ $product['old_price'] }}₫</div>
                            @else
                            <div class="text-xs text-transparent select-none">No old price</div>
                            @endif
                        </div>
                    </div>

                    <button class="w-full bg-blue-50 text-blue-600 font-semibold py-2 rounded-lg border border-blue-100 hover:bg-blue-600 hover:text-white transition flex items-center justify-center text-sm">
                        <i class="fas fa-cart-plus mr-2"></i> THÊM VÀO GIỎ
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>


@endsection

@push('scripts')
    @vite(['resources/js/user/favorites.js'])
@endpush
