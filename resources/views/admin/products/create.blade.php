@extends('admin.layouts.app')

@section('title', 'Thêm mới Sản phẩm')

@section('content')
<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="product-form">
@csrf

<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Thêm Sản phẩm mới</h1>
        <p class="text-sm text-gray-500 mt-1">Nhập thông tin chi tiết cho sản phẩm mới.</p>
    </div>
    <div>
        <a href="{{ route('admin.products.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-300 transition mr-2">Hủy bỏ</a>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition shadow-sm">
            <i class="fas fa-save mr-2"></i> Lưu Sản phẩm
        </button>
    </div>
</div>

@if($errors->any())
<div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700">
    <ul class="list-disc list-inside space-y-1">
        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
    </ul>
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Cột chính --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- Thông tin cơ bản --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Thông tin cơ bản</h2>
            <div class="space-y-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tên sản phẩm <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="product-name" maxlength="255" required
                        value="{{ old('name') }}"
                        placeholder="Nhập tên sản phẩm..."
                        class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm @error('name') border-red-400 @enderror">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Slug <span class="text-xs text-gray-400">(tự động)</span></label>
                    <input type="text" id="product-slug-preview" readonly
                        placeholder="slug-san-pham-se-hien-thi-o-day..."
                        class="w-full border border-gray-200 rounded-lg py-2 px-3 bg-gray-50 text-gray-500 text-sm cursor-not-allowed">
                    <p class="text-xs text-gray-400 mt-1">Slug được tạo tự động từ tên và ID sau khi lưu.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Giá bán (VNĐ) <span class="text-red-500">*</span></label>
                    <input type="text" name="price" id="product-price" required
                        value="{{ old('price') }}"
                        placeholder="Ví dụ: 15.000.000"
                        class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm @error('price') border-red-400 @enderror">
                    @error('price')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả sản phẩm</label>
                    <textarea name="description" rows="5" placeholder="Mô tả chi tiết sản phẩm (có thể để trống)..."
                        class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm @error('description') border-red-400 @enderror">{{ old('description') }}</textarea>
                    @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

            </div>
        </div>

        {{-- Ảnh sản phẩm --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">
                Hình ảnh <span class="text-red-500">*</span>
                <span class="text-sm font-normal text-gray-500 ml-2">(Kéo thả để sắp xếp, tự động chuyển WebP)</span>
            </h2>

            <div id="image-dropzone"
                class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition cursor-pointer mb-4">
                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                <p class="text-sm text-gray-500">Kéo thả ảnh vào đây hoặc <span class="text-blue-600 font-medium">Chọn file</span></p>
                <p class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP, GIF – tối đa 5MB mỗi ảnh</p>
                <input type="file" id="image-input" multiple accept="image/*" class="hidden">
            </div>
            @error('images')<p class="text-red-500 text-xs mb-2">{{ $message }}</p>@enderror

            <div id="image-preview-list" class="grid grid-cols-3 sm:grid-cols-4 gap-3"></div>
            {{-- Hidden inputs cho images sẽ được JS append vào đây --}}
            <div id="image-file-inputs"></div>
        </div>

    </div>

    {{-- Cột phải --}}
    <div class="space-y-6">

        {{-- Trạng thái --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Trạng thái hiển thị</h2>
            <div class="flex items-center space-x-6">
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="active" value="0" {{ old('active', '0') == '0' ? 'checked' : '' }} class="mr-2 text-blue-600">
                    <span class="text-sm text-gray-700">Ẩn</span>
                </label>
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="active" value="1" {{ old('active') == '1' ? 'checked' : '' }} class="mr-2 text-blue-600">
                    <span class="text-sm text-gray-700">Hiển thị</span>
                </label>
            </div>
        </div>

        {{-- Danh mục --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Danh mục <span class="text-red-500">*</span></h2>
            @error('categories')<p class="text-red-500 text-xs mb-2">{{ $message }}</p>@enderror
            <div class="relative mb-2">
                <input type="text" id="category-search" placeholder="Tìm danh mục..."
                    class="w-full border border-gray-300 rounded-lg pl-8 pr-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div id="category-list" class="space-y-1 max-h-64 overflow-y-auto border border-gray-200 rounded-lg p-3">
                @foreach($categories as $cat)
                <div class="category-group" data-parent-name="{{ strtolower($cat->name) }}">
                    <label class="flex items-center py-1 cursor-pointer hover:bg-gray-50 rounded px-1 category-item" data-name="{{ strtolower($cat->name) }}">
                        <input type="checkbox" name="categories[]" value="{{ $cat->id }}"
                            {{ in_array($cat->id, old('categories', [])) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-blue-600 mr-2 category-parent" data-id="{{ $cat->id }}">
                        <span class="text-sm font-semibold text-gray-800">{{ $cat->name }}</span>
                    </label>
                    @foreach($cat->children as $child)
                    <label class="flex items-center py-1 cursor-pointer hover:bg-gray-50 rounded px-1 pl-6 category-item" data-name="{{ strtolower($child->name) }}">
                        <input type="checkbox" name="categories[]" value="{{ $child->id }}"
                            {{ in_array($child->id, old('categories', [])) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-blue-600 mr-2 category-child" data-parent="{{ $cat->id }}">
                        <span class="text-sm text-gray-700">{{ $child->name }}</span>
                    </label>
                    @endforeach
                </div>
                @endforeach
            </div>
            <p class="text-xs text-gray-400 mt-2">Chọn danh mục con sẽ tự động chọn danh mục cha.</p>
        </div>

        {{-- Filter / Từ khóa --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Từ khóa (Filter)
                <span class="text-sm font-normal text-gray-500">– tuỳ chọn</span>
            </h2>
            <div class="space-y-3">
                @foreach($filterGroups as $group)
                <div>
                    <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1">{{ $group->name }}</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($group->values as $val)
                        <label class="cursor-pointer">
                            <input type="radio" name="filter_values[{{ $group->id }}]" value="{{ $val->id }}"
                                {{ old("filter_values.{$group->id}") == $val->id ? 'checked' : '' }}
                                class="sr-only peer">
                            <span class="px-3 py-1 rounded-full text-xs border border-gray-300 peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600 hover:border-blue-400 transition">
                                {{ $val->value }}
                            </span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
</form>
@endsection

@push('scripts')
<script src="{{ Vite::asset('resources/js/admin/products/create.js') }}"></script>
<script>
(function() {
    const searchInput = document.getElementById('category-search');
    if (!searchInput) return;
    searchInput.addEventListener('input', function() {
        const q = this.value.toLowerCase().trim();
        document.querySelectorAll('#category-list .category-group').forEach(function(group) {
            if (!q) {
                group.style.display = '';
                group.querySelectorAll('.category-item').forEach(function(item) { item.style.display = ''; });
                return;
            }
            const parentName = group.dataset.parentName || '';
            const parentMatch = parentName.includes(q);
            let anyChildMatch = false;
            group.querySelectorAll('.category-item').forEach(function(item) {
                const childMatch = (item.dataset.name || '').includes(q);
                // Nếu cha khớp thì hiện tất cả con, nếu không thì chỉ hiện con khớp
                const show = parentMatch || childMatch;
                item.style.display = show ? '' : 'none';
                if (childMatch) anyChildMatch = true;
            });
            group.style.display = (parentMatch || anyChildMatch) ? '' : 'none';
        });
    });
})();
</script>
@endpush
