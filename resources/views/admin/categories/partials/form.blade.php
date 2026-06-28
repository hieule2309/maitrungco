<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">{{ $category ? 'Cập nhật Danh mục' : 'Thêm Danh mục mới' }}</h1>
        <p class="text-sm text-gray-500 mt-1">Quản lý cấu trúc danh mục sản phẩm với tối đa 3 cấp.</p>
    </div>
    <div>
        <a href="{{ route('admin.categories.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-300 transition mr-2">
            Hủy bỏ
        </a>
        <button form="category-form" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition shadow-sm">
            <i class="fas fa-save mr-2"></i> {{ $category ? 'Lưu Thay Đổi' : 'Lưu Danh mục' }}
        </button>
    </div>
</div>

<form id="category-form" action="{{ $action }}" method="POST">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Thông tin Danh mục</h2>

                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Tên danh mục <span class="text-red-500">*</span></label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            maxlength="255"
                            required
                            value="{{ old('name', $category?->name) }}"
                            placeholder="Ví dụ: Laptop Gaming"
                            class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm @error('name') border-red-400 @enderror">
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="slug-preview" class="block text-sm font-medium text-gray-700 mb-1">Đường dẫn tĩnh (Slug)</label>
                        <input
                            id="slug-preview"
                            type="text"
                            readonly
                            value="{{ $category?->slug ?? 'Sẽ tự động tạo từ tên + ID sau khi lưu' }}"
                            class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none text-sm bg-gray-50 text-gray-500">
                        <p class="text-xs text-gray-500 mt-1">Slug tự sinh từ tên và ID, khoảng trắng sẽ được đổi thành dấu gạch ngang.</p>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Mô tả danh mục</label>
                        <textarea id="description" name="description" rows="5" class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm @error('description') border-red-400 @enderror">{{ old('description', $category?->description) }}</textarea>
                        @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Phân cấp</h2>
                <div>
                    <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-1">Danh mục cha</label>
                    <select id="parent_id" name="parent_id" class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm bg-white @error('parent_id') border-red-400 @enderror">
                        <option value="">-- Không có (Danh mục gốc) --</option>
                        @foreach ($parentOptions as $option)
                            <option value="{{ $option['id'] }}" @selected((string) old('parent_id', $category?->parent_id) === (string) $option['id'])>
                                {{ str_repeat('— ', max(0, $option['level'] - 1)) . $option['name'] }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-2">Danh mục chỉ hỗ trợ tối đa 3 cấp. Chỉ danh mục cấp 1 mới dùng icon riêng.</p>
                    @error('parent_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Biểu tượng</h2>

                {{-- Icon root: chỉ hiện khi parent_id rỗng --}}
                <div id="icon-root-section">
                    @php
                        $iconOptions = [
                            'fas fa-laptop'       => 'Laptop',
                            'fas fa-mobile-alt'   => 'Mobile',
                            'fas fa-tablet-alt'   => 'Tablet',
                            'fas fa-desktop'      => 'Desktop',
                            'fas fa-headphones'   => 'Tai nghe',
                            'fas fa-camera'       => 'Camera',
                            'fas fa-gamepad'      => 'Gaming',
                            'fas fa-tv'           => 'TV',
                            'fas fa-keyboard'     => 'Bàn phím',
                            'fas fa-mouse'        => 'Chuột',
                            'fas fa-hdd'          => 'Ổ cứng',
                            'fas fa-memory'       => 'RAM',
                            'fas fa-microchip'    => 'CPU',
                            'fas fa-print'        => 'Máy in',
                            'fas fa-folder'       => 'Thư mục',
                        ];
                        $currentIcon = old('icon', $category?->icon ?: $defaultIcon);
                    @endphp

                    {{-- Preview icon đang chọn --}}
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg border border-gray-200 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-white border border-gray-200 flex items-center justify-center shadow-sm flex-shrink-0">
                            <i id="icon-preview-el" class="{{ $currentIcon }} text-blue-500 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-700">Đang chọn</p>
                            <code id="icon-preview-text" class="text-xs text-gray-500">{{ $currentIcon }}</code>
                        </div>
                    </div>

                    {{-- Grid icon picker --}}
                    <div class="flex flex-wrap gap-2" id="icon-picker">
                        @foreach($iconOptions as $cls => $label)
                        <button type="button"
                            title="{{ $label }}"
                            class="icon-opt flex items-center gap-2 px-3 py-2 rounded-lg border text-xs font-medium transition-all"
                            data-icon="{{ $cls }}">
                            <i class="{{ $cls }} text-base w-4 text-center"></i>
                            <span>{{ $label }}</span>
                        </button>
                        @endforeach
                    </div>

                    <input type="hidden" id="icon" name="icon" value="{{ $currentIcon }}">
                    @error('icon')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Thông báo khi danh mục con --}}
                <div id="icon-child-section" class="hidden">
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                        <i class="{{ $defaultIcon }} text-gray-400 text-xl w-6 text-center"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Biểu tượng mặc định</p>
                            <p class="text-xs text-gray-500">Danh mục con dùng icon <code class="bg-gray-100 px-1 rounded">{{ $defaultIcon }}</code> — không thể tuỳ chỉnh.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        // ── Icon picker ──────────────────────────────────────────
        var currentIcon = document.getElementById('icon')
                            ? document.getElementById('icon').value
                            : '';

        function applyIcon(cls) {
            var hidden = document.getElementById('icon');
            if (hidden) hidden.value = cls;

            var prev = document.getElementById('icon-preview-el');
            if (prev) prev.className = cls + ' text-blue-500 text-xl';

            var prevText = document.getElementById('icon-preview-text');
            if (prevText) prevText.textContent = cls;

            document.querySelectorAll('.icon-opt').forEach(function (btn) {
                var active = btn.dataset.icon === cls;
                btn.style.borderColor     = active ? '#3b82f6' : '#e5e7eb';
                btn.style.backgroundColor = active ? '#eff6ff' : '#ffffff';
                btn.style.color           = active ? '#2563eb' : '#4b5563';
            });
        }

        // Gắn click cho từng button preset
        document.querySelectorAll('.icon-opt').forEach(function (btn) {
            btn.addEventListener('click', function () {
                applyIcon(btn.dataset.icon);
            });
            // Highlight icon đang được chọn khi load
            if (btn.dataset.icon === currentIcon) {
                btn.style.borderColor     = '#3b82f6';
                btn.style.backgroundColor = '#eff6ff';
                btn.style.color           = '#2563eb';
            } else {
                btn.style.borderColor     = '#e5e7eb';
                btn.style.backgroundColor = '#ffffff';
                btn.style.color           = '#4b5563';
            }
        });

        // ── Hiện/ẩn theo parent ──────────────────────────────────
        var parentSelect = document.getElementById('parent_id');
        var rootSection  = document.getElementById('icon-root-section');
        var childSection = document.getElementById('icon-child-section');

        if (parentSelect && rootSection && childSection) {
            function syncIconState() {
                var isRoot = parentSelect.value === '';
                rootSection.style.display  = isRoot ? '' : 'none';
                childSection.style.display = isRoot ? 'none' : '';
            }
            parentSelect.addEventListener('change', syncIconState);
            syncIconState();
        }
    });
</script>