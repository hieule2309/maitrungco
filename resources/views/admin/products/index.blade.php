@extends('admin.layouts.app')

@section('title', 'Quản lý Sản phẩm')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Quản lý Sản phẩm</h1>
            <p class="text-sm text-gray-500 mt-1">Danh sách tất cả sản phẩm trong cửa hàng.</p>
        </div>
        <a href="{{ route('admin.products.create') }}"
            class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-700 active:scale-95 transition-all shadow-sm">
            <i class="fas fa-plus text-xs"></i> Thêm Sản phẩm
        </a>
    </div>

    @if (session('success'))
        <div id="flash-success"
            class="mb-5 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 rounded-lg text-sm text-green-700">
            <i class="fas fa-check-circle text-green-500"></i>
            <span class="font-medium">{{ session('success') }}</span>
            <button onclick="document.getElementById('flash-success').remove()"
                class="ml-auto text-green-400 hover:text-green-600 transition">
                <i class="fas fa-times text-xs"></i>
            </button>
        </div>
    @endif

    {{-- Bộ lọc --}}
    <form method="GET" action="{{ route('admin.products.index') }}" id="filter-form" class="mb-4">
        <div class="flex gap-2 items-center">
            <div class="relative w-72">
                <input type="text" name="search" id="filter-search" value="{{ request('search') }}"
                    placeholder="Tìm theo tên sản phẩm…" autocomplete="off"
                    class="w-full border border-gray-300 rounded-lg pl-9 pr-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="relative">
                <select name="active" onchange="document.getElementById('filter-form').submit()"
                    class="border border-gray-300 rounded-lg pl-3 pr-8 py-2 text-sm bg-white appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent min-w-[130px] cursor-pointer">
                    <option value="">Trạng thái</option>
                    <option value="1" {{ request('active') === '1' ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ request('active') === '0' ? 'selected' : '' }}>Ẩn</option>
                </select>
            </div>
            <div class="relative">
                <select name="category_id" onchange="document.getElementById('filter-form').submit()"
                    class="border border-gray-300 rounded-lg pl-3 pr-8 py-2 text-sm bg-white appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent min-w-[140px] cursor-pointer">
                    <option value="">Danh mục</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            @if (request('search') || (request('active') !== '' && request('active') !== null) || request('category_id'))
                <a href="{{ route('admin.products.index') }}"
                    class="flex items-center gap-1.5 px-3 py-2 bg-gray-100 text-gray-500 text-sm rounded-lg hover:bg-gray-200 transition whitespace-nowrap">
                    <i class="fas fa-times text-xs"></i> Xóa lọc
                </a>
            @endif
        </div>
    </form>

    @push('scripts')
        <script>
            (function() {
                const input = document.getElementById('filter-search');
                const form = document.getElementById('filter-form');
                let timer;
                input.addEventListener('input', () => {
                    clearTimeout(timer);
                    timer = setTimeout(() => form.submit(), 500);
                });
            })();
        </script>
    @endpush

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <span class="font-semibold text-gray-700 text-sm">Danh sách sản phẩm</span>
            <span class="text-xs text-gray-400 bg-gray-100 px-2.5 py-1 rounded-full font-medium">{{ $products->total() }}
                sản phẩm</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                        <th class="px-4 py-3 font-semibold">Sản phẩm</th>
                        <th class="px-4 py-3 font-semibold">Danh mục</th>
                        <th class="px-4 py-3 font-semibold">Giá bán</th>
                        <th class="px-4 py-3 font-semibold text-center">Trạng thái</th>
                        <th class="px-4 py-3 font-semibold">Ngày tạo</th>
                        <th class="px-4 py-3 font-semibold">Cập nhật</th>
                        <th class="px-4 py-3 font-semibold text-center w-24">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                    @forelse($products as $product)
                        @php $slugDisplay = preg_replace('/-\d+$/', '', $product->slug); @endphp
                        <tr class="hover:bg-gray-50/70 transition">
                            <td class="px-4 py-3.5">
                                <div class="flex items-center gap-3">
                                    @if ($product->images->first())
                                        <img src="{{ Storage::url($product->images->first()->value) }}"
                                            class="w-11 h-11 rounded-lg object-cover border border-gray-200 flex-shrink-0">
                                    @else
                                        <div
                                            class="w-11 h-11 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0 text-gray-300">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                            class="font-bold text-gray-800 hover:text-blue-600 transition line-clamp-1">{{ $product->name }}</a>
                                        <code class="text-xs text-gray-400 font-mono">{{ $slugDisplay }}</code>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3.5">
                                @foreach ($product->categories->take(2) as $cat)
                                    <span
                                        class="text-xs font-medium bg-gray-100 text-gray-600 px-2 py-0.5 rounded mr-1">{{ $cat->name }}</span>
                                @endforeach
                                @if ($product->categories->count() > 2)
                                    <span class="text-xs text-gray-400">+{{ $product->categories->count() - 2 }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3.5">
                                <span
                                    class="font-semibold text-gray-800">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                            </td>
                            <td class="px-4 py-3.5 text-center">
                                @if ($product->active)
                                    <span
                                        class="bg-green-100 text-green-700 py-1 px-2.5 rounded-full text-xs font-semibold">Hiển
                                        thị</span>
                                @else
                                    <span
                                        class="bg-gray-100 text-gray-500 py-1 px-2.5 rounded-full text-xs font-semibold">Ẩn</span>
                                @endif
                            </td>
                            <td class="px-4 py-3.5 text-xs text-gray-400">{{ $product->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-3.5 text-xs text-gray-400">{{ $product->updated_at->diffForHumans() }}</td>
                            <td class="px-4 py-3.5 text-center">
                                <div class="flex items-center justify-center gap-1">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                        class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition"
                                        title="Chỉnh sửa">
                                        <i class="fas fa-edit text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Xóa sản phẩm «{{ addslashes($product->name) }}»?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="w-8 h-8 rounded-full bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition"
                                            title="Xóa">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-14 text-center">
                                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-box text-xl text-gray-300"></i>
                                </div>
                                <p class="text-sm font-medium text-gray-400 mb-1">
                                    {{ request('search') || (request('active') !== null && request('active') !== '') || request('category_id') ? 'Không tìm thấy sản phẩm nào khớp.' : 'Chưa có sản phẩm nào.' }}
                                </p>
                                @unless (request('search') || request('active') !== '' || request('category_id'))
                                    <a href="{{ route('admin.products.create') }}"
                                        class="text-sm text-blue-500 hover:text-blue-700 font-medium transition">
                                        + Thêm sản phẩm đầu tiên
                                    </a>
                                @endunless
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($products->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">{{ $products->appends(request()->query())->links() }}</div>
        @endif
    </div>
@endsection
