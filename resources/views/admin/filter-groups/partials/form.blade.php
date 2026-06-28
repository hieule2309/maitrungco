<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">{{ $filterGroup ? 'Cập nhật Nhóm Filter' : 'Thêm Nhóm Filter mới' }}</h1>
        <p class="text-sm text-gray-500 mt-1">Nhóm thuộc tính dùng để lọc sản phẩm.</p>
    </div>
    <div>
        <a href="{{ route('admin.filter-groups.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-300 transition mr-2">
            Hủy bỏ
        </a>
        <button form="filter-group-form" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition shadow-sm">
            <i class="fas fa-save mr-2"></i> {{ $filterGroup ? 'Lưu Thay Đổi' : 'Lưu Nhóm Filter' }}
        </button>
    </div>
</div>

<form id="filter-group-form" action="{{ $action }}" method="POST">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    @if ($errors->any())
    <div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
    @endif

    <div class="max-w-xl">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-4">
            <h2 class="text-lg font-bold text-gray-800 border-b pb-2">Thông tin Nhóm Filter</h2>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                    Tên nhóm <span class="text-red-500">*</span>
                </label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    maxlength="255"
                    required
                    value="{{ old('name', $filterGroup?->name) }}"
                    placeholder="Ví dụ: CPU, RAM, Màu sắc…"
                    class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm @error('name') border-red-400 @enderror">
                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                <input
                    type="text"
                    readonly
                    value="{{ $filterGroup?->slug ?? 'Sẽ tự động tạo từ tên + ID sau khi lưu' }}"
                    class="w-full border border-gray-200 rounded-lg py-2 px-3 bg-gray-50 text-gray-500 text-sm cursor-not-allowed">
                <p class="text-xs text-gray-400 mt-1">Slug được tạo tự động theo quy tắc: tên-id (ví dụ: <code>cpu-1</code>).</p>
            </div>
        </div>
    </div>
</form>
