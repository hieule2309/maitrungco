<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">{{ $filterValue ? 'Cập nhật Giá trị Filter' : 'Thêm Giá trị Filter mới' }}</h1>
        <p class="text-sm text-gray-500 mt-1">Giá trị thuộc tính thuộc một nhóm filter.</p>
    </div>
    <div>
        <a href="{{ route('admin.filter-values.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-300 transition mr-2">
            Hủy bỏ
        </a>
        <button form="filter-value-form" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition shadow-sm">
            <i class="fas fa-save mr-2"></i> {{ $filterValue ? 'Lưu Thay Đổi' : 'Lưu Giá trị' }}
        </button>
    </div>
</div>

<form id="filter-value-form" action="{{ $action }}" method="POST">
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
            <h2 class="text-lg font-bold text-gray-800 border-b pb-2">Thông tin Giá trị Filter</h2>

            <div>
                <label for="filter_group_id" class="block text-sm font-medium text-gray-700 mb-1">
                    Nhóm Filter <span class="text-red-500">*</span>
                </label>
                <select
                    id="filter_group_id"
                    name="filter_group_id"
                    required
                    class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm bg-white @error('filter_group_id') border-red-400 @enderror">
                    <option value="">-- Chọn nhóm filter --</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}"
                            @selected(old('filter_group_id', $filterValue?->filter_group_id) == $group->id)>
                            {{ $group->name }}
                        </option>
                    @endforeach
                </select>
                @error('filter_group_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="value" class="block text-sm font-medium text-gray-700 mb-1">
                    Giá trị <span class="text-red-500">*</span>
                </label>
                <input
                    id="value"
                    name="value"
                    type="text"
                    maxlength="255"
                    required
                    value="{{ old('value', $filterValue?->value) }}"
                    placeholder="Ví dụ: Core i5, 16GB, Màu đen…"
                    class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm @error('value') border-red-400 @enderror">
                @error('value')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                <input
                    type="text"
                    readonly
                    value="{{ $filterValue?->slug ?? 'Sẽ tự động tạo từ giá trị + ID sau khi lưu' }}"
                    class="w-full border border-gray-200 rounded-lg py-2 px-3 bg-gray-50 text-gray-500 text-sm cursor-not-allowed">
                <p class="text-xs text-gray-400 mt-1">Ví dụ: <code>core-i5-3</code>, <code>16gb-5</code>.</p>
            </div>
        </div>
    </div>
</form>
