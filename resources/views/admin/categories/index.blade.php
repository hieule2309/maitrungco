@extends('admin.layouts.app')

@section('title', 'Quản lý Danh mục')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Quản lý Danh mục</h1>
        <p class="text-sm text-gray-500 mt-1">Cấu trúc menu và danh mục phân cấp 3 tầng.</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-700 active:scale-95 transition-all shadow-sm">
        <i class="fas fa-plus text-xs"></i> Thêm Danh mục
    </a>
</div>

@if (session('success'))
<div id="flash-success" class="mb-5 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 rounded-lg text-sm text-green-700">
    <i class="fas fa-check-circle text-green-500"></i>
    <span class="font-medium">{{ session('success') }}</span>
    <button onclick="document.getElementById('flash-success').remove()" class="ml-auto text-green-400 hover:text-green-600 transition">
        <i class="fas fa-times text-xs"></i>
    </button>
</div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-white gap-4">
        <form method="GET" action="{{ route('admin.categories.index') }}" id="cat-filter-form" class="flex gap-2 items-center flex-1">
            <div class="relative w-64">
                <input type="text" name="search" id="cat-search" value="{{ $search }}"
                    placeholder="Tìm kiếm danh mục…"
                    autocomplete="off"
                    class="w-full border border-gray-300 rounded-lg pl-9 pr-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            @if($search)
            <a href="{{ route('admin.categories.index') }}"
                class="flex items-center gap-1.5 px-3 py-2 bg-gray-100 text-gray-500 text-sm rounded-lg hover:bg-gray-200 transition">
                <i class="fas fa-times text-xs"></i> Xóa lọc
            </a>
            @endif
        </form>
        @push('scripts')
        <script>
        (function () {
            const input = document.getElementById('cat-search');
            const form  = document.getElementById('cat-filter-form');
            let timer;
            input.addEventListener('input', () => {
                clearTimeout(timer);
                timer = setTimeout(() => form.submit(), 500);
            });
        })();
        </script>
        @endpush
        <span class="text-xs text-gray-400 bg-gray-100 px-2.5 py-1 rounded-full font-medium whitespace-nowrap">
            {{ $categories->count() }} danh mục
        </span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                    <th class="p-4 font-semibold">Tên Danh Mục{{ $search ? '' : ' (Cấu trúc tầng)' }}</th>
                    <th class="p-4 font-semibold">Slug</th>
                    <th class="p-4 font-semibold text-center">Cấp</th>
                    <th class="p-4 font-semibold">Ngày tạo</th>
                    <th class="p-4 font-semibold">Cập nhật</th>
                    <th class="p-4 font-semibold text-center w-24">Thao tác</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                @php
                    $isPaginator = method_exists($categoryTree, 'items');

                    if ($search && $isPaginator) {
                        // Flat search results: mỗi item là Category object
                        $rows = collect($categoryTree->items())->map(fn($c) => [
                            'category' => $c,
                            'level'    => $c->parent_id ? ($c->parent?->parent_id ? 3 : 2) : 1,
                        ])->all();
                    } elseif ($isPaginator) {
                        // Tree mode paginated by root: flatten root + children
                        $flattenFn = null;
                        $flattenFn = function($cats, $level) use (&$flattenFn) {
                            $rows = [];
                            foreach ($cats as $cat) {
                                $rows[] = ['category' => $cat, 'level' => $level];
                                if ($cat->childrenRecursive->isNotEmpty()) {
                                    $rows = array_merge($rows, $flattenFn($cat->childrenRecursive, $level + 1));
                                }
                            }
                            return $rows;
                        };
                        $rows = $flattenFn($categoryTree->items(), 1);
                    } else {
                        $rows = $categoryTree;
                    }
                @endphp

                @forelse ($rows as $item)
                    @include('admin.categories.partials.row', ['item' => $item, 'flatMode' => (bool) $search])
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-14 text-center">
                            <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-folder text-xl text-gray-300"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-400">
                                {{ $search ? 'Không tìm thấy danh mục nào khớp.' : 'Chưa có danh mục nào.' }}
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($isPaginator && $categoryTree->hasPages())
    <div class="px-6 py-3 border-t border-gray-100 bg-white">
        {{ $categoryTree->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection
