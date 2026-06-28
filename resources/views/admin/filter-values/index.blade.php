@extends('admin.layouts.app')

@section('title', 'Quản lý Giá trị Filter')

@section('content')

<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Giá trị Filter</h1>
        <p class="text-sm text-gray-500 mt-1">Các thuộc tính cụ thể thuộc từng nhóm (Core i5, 16GB, Đen…).</p>
    </div>
    <button type="button" onclick="openCreateModal()"
        class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-700 active:scale-95 transition-all shadow-sm">
        <i class="fas fa-plus text-xs"></i> Thêm Giá trị
    </button>
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

{{-- Bộ lọc --}}
<form method="GET" action="{{ route('admin.filter-values.index') }}" id="fv-filter-form" class="mb-4">
    <div class="flex gap-2 items-center">
        <div class="relative w-64">
            <input type="text" name="search" id="fv-search" value="{{ request('search') }}"
                placeholder="Tìm theo giá trị…"
                autocomplete="off"
                class="w-full border border-gray-300 rounded-lg pl-9 pr-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
        <div class="relative">
            <select name="group_id" onchange="document.getElementById('fv-filter-form').submit()"
                class="border border-gray-300 rounded-lg pl-3 pr-8 py-2 text-sm bg-white appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent min-w-[150px] cursor-pointer">
                <option value="">Tất cả nhóm</option>
                @foreach($groups as $g)
                <option value="{{ $g->id }}" {{ request('group_id') == $g->id ? 'selected' : '' }}>{{ $g->name }}</option>
                @endforeach
            </select>
        </div>
        @if(request('search') || request('group_id'))
        <a href="{{ route('admin.filter-values.index') }}"
            class="flex items-center gap-1.5 px-3 py-2 bg-gray-100 text-gray-500 text-sm rounded-lg hover:bg-gray-200 transition">
            <i class="fas fa-times text-xs"></i> Xóa lọc
        </a>
        @endif
    </div>
</form>

@push('scripts')
<script>
(function () {
    const input = document.getElementById('fv-search');
    const form  = document.getElementById('fv-filter-form');
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
        <span class="font-semibold text-gray-700 text-sm">Danh sách giá trị</span>
        <span class="text-xs text-gray-400 bg-gray-100 px-2.5 py-1 rounded-full font-medium">{{ $filterValues->total() }} giá trị</span>
    </div>

    <table class="w-full text-left">
        <thead>
            <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                <th class="px-6 py-3 font-semibold">Giá trị</th>
                <th class="px-6 py-3 font-semibold">Nhóm</th>
                <th class="px-6 py-3 font-semibold">Slug</th>
                <th class="px-6 py-3 font-semibold">Ngày tạo</th>
                <th class="px-6 py-3 font-semibold">Cập nhật</th>
                <th class="px-6 py-3 font-semibold text-center w-24">Thao tác</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50 text-sm">
            @forelse ($filterValues as $val)
            @php
                $colorList = [
                    'bg-blue-100 text-blue-700',
                    'bg-green-100 text-green-700',
                    'bg-orange-100 text-orange-700',
                    'bg-purple-100 text-purple-700',
                    'bg-pink-100 text-pink-700',
                    'bg-teal-100 text-teal-700',
                ];
                $badge = $colorList[$val->filter_group_id % count($colorList)];
                $slugDisplay = preg_replace('/-\d+$/', '', $val->slug);
            @endphp
            <tr class="hover:bg-gray-50/70 transition-colors group">
                <td class="px-6 py-3.5 font-semibold text-gray-800">{{ $val->value }}</td>
                <td class="px-6 py-3.5">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold {{ $badge }}">
                        {{ $val->group->name }}
                    </span>
                </td>
                <td class="px-6 py-3.5">
                    <code class="text-xs bg-gray-100 text-gray-500 px-2 py-1 rounded-md font-mono">{{ $slugDisplay ?: '—' }}</code>
                </td>
                <td class="px-6 py-3.5 text-xs text-gray-400">{{ $val->created_at->format('d/m/Y') }}</td>
                <td class="px-6 py-3.5 text-xs text-gray-400">{{ $val->updated_at->diffForHumans() }}</td>
                <td class="px-6 py-3.5 text-center">
                    <div class="flex items-center justify-center gap-1">
                        <button type="button"
                            onclick="openEditModal({{ $val->id }}, {{ $val->filter_group_id }}, @js($val->value))"
                            class="w-8 h-8 flex items-center justify-center rounded-full bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition" title="Chỉnh sửa">
                            <i class="fas fa-edit text-xs"></i>
                        </button>
                        <form action="{{ route('admin.filter-values.destroy', $val) }}" method="POST"
                              onsubmit="return confirm('Xóa giá trị «{{ addslashes($val->value) }}»? Mapping với sản phẩm cũng sẽ bị xóa.')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="w-8 h-8 flex items-center justify-center rounded-full bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition" title="Xóa">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-14 text-center">
                    <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-sliders-h text-xl text-gray-300"></i>
                    </div>
                    <p class="text-sm font-medium text-gray-400 mb-1">
                        {{ request('search') || request('group_id') ? 'Không tìm thấy giá trị nào khớp.' : 'Chưa có giá trị filter nào.' }}
                    </p>
                    @unless(request('search') || request('group_id'))
                    <button onclick="openCreateModal()" class="text-sm text-blue-500 hover:text-blue-700 font-medium transition">
                        + Thêm giá trị đầu tiên
                    </button>
                    @endunless
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($filterValues->hasPages())
    <div class="px-6 py-3 border-t border-gray-100">
        {{ $filterValues->appends(request()->query())->links() }}
    </div>
    @endif
</div>


{{-- ══════════════════ MODAL CREATE ══════════════════ --}}
<div id="modal-create" class="fixed inset-0 z-50" style="display:none">
    <div class="absolute inset-0 bg-black/50" onclick="closeCreateModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="relative w-full max-w-md bg-white rounded-xl shadow-2xl animate-modal">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-900 text-base">Thêm giá trị filter</h3>
                <button type="button" onclick="closeCreateModal()"
                    class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition text-xl leading-none">
                    &times;
                </button>
            </div>
            <form action="{{ route('admin.filter-values.store') }}" method="POST" class="px-5 py-4 space-y-4">
                @csrf
                <input type="hidden" name="_form" value="create">
                <div>
                    <label for="create-group" class="block text-sm font-medium text-gray-700 mb-1.5">Nhóm Filter <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select id="create-group" name="filter_group_id" required
                            class="w-full border border-gray-300 rounded-lg py-2.5 pl-3.5 pr-9 text-sm text-gray-800 bg-white appearance-none
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all
                                   @error('filter_group_id') border-red-400 ring-2 ring-red-100 @enderror">
                            <option value="">— Chọn nhóm —</option>
                            @foreach ($groups as $g)
                            <option value="{{ $g->id }}" {{ old('filter_group_id') == $g->id ? 'selected' : '' }}>{{ $g->name }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                            <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                        </div>
                    </div>
                    @error('filter_group_id')
                    <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="create-value" class="block text-sm font-medium text-gray-700 mb-1.5">Giá trị <span class="text-red-500">*</span></label>
                    <input id="create-value" name="value" type="text" maxlength="255" required
                        value="{{ old('value') }}"
                        placeholder="Ví dụ: Core i5, 16GB, Màu đen…"
                        class="w-full border border-gray-300 rounded-lg py-2.5 px-3.5 text-sm text-gray-800 placeholder-gray-400
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all
                               @error('value') border-red-400 ring-2 ring-red-100 @enderror">
                    @error('value')
                    <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-end gap-2 pt-2 border-t border-gray-100">
                    <button type="button" onclick="closeCreateModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition-colors">Hủy</button>
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                        <i class="fas fa-plus text-xs"></i> Lưu giá trị
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ══════════════════ MODAL EDIT ══════════════════ --}}
<div id="modal-edit" class="fixed inset-0 z-50" style="display:none">
    <div class="absolute inset-0 bg-black/50" onclick="closeEditModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="relative w-full max-w-md bg-white rounded-xl shadow-2xl animate-modal">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-900 text-base">Chỉnh sửa giá trị filter</h3>
                <button type="button" onclick="closeEditModal()"
                    class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition text-xl leading-none">
                    &times;
                </button>
            </div>
            <form id="edit-form" action="" method="POST" class="px-5 py-4 space-y-4">
                @csrf @method('PUT')
                <div>
                    <label for="edit-group" class="block text-sm font-medium text-gray-700 mb-1.5">Nhóm Filter <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select id="edit-group" name="filter_group_id" required
                            class="w-full border border-gray-300 rounded-lg py-2.5 pl-3.5 pr-9 text-sm text-gray-800 bg-white appearance-none
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            <option value="">— Chọn nhóm —</option>
                            @foreach ($groups as $g)
                            <option value="{{ $g->id }}">{{ $g->name }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                            <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="edit-value" class="block text-sm font-medium text-gray-700 mb-1.5">Giá trị <span class="text-red-500">*</span></label>
                    <input id="edit-value" name="value" type="text" maxlength="255" required
                        placeholder="Tên giá trị"
                        class="w-full border border-gray-300 rounded-lg py-2.5 px-3.5 text-sm text-gray-800 placeholder-gray-400
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                </div>
                <div class="flex items-center justify-end gap-2 pt-2 border-t border-gray-100">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition-colors">Hủy</button>
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                        <i class="fas fa-check text-xs"></i> Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<style>
    @keyframes modalIn {
        from { opacity: 0; transform: scale(0.96) translateY(8px); }
        to   { opacity: 1; transform: scale(1)    translateY(0);   }
    }
    .animate-modal { animation: modalIn .18s ease-out both; }
</style>
<script>
    const $mc = document.getElementById('modal-create');
    const $me = document.getElementById('modal-edit');

    function _open(el, focusId) {
        el.style.display = 'block';
        const box = el.querySelector('.animate-modal');
        box.style.animation = 'none'; box.offsetHeight; box.style.animation = '';
        document.body.style.overflow = 'hidden';
        setTimeout(() => document.getElementById(focusId)?.focus(), 60);
    }
    function _close(el) { el.style.display = 'none'; document.body.style.overflow = ''; }

    function openCreateModal()  { _open($mc, 'create-group'); }
    function closeCreateModal() { _close($mc); }

    function openEditModal(id, groupId, value) {
        document.getElementById('edit-form').action = `/admin/filter-values/${id}`;
        document.getElementById('edit-value').value  = value;
        const sel = document.getElementById('edit-group');
        for (const opt of sel.options) opt.selected = String(opt.value) === String(groupId);
        _open($me, 'edit-value');
    }
    function closeEditModal() { _close($me); }

    document.addEventListener('keydown', e => { if (e.key === 'Escape') { closeCreateModal(); closeEditModal(); } });

    @if ($errors->any() && old('_form') === 'create')
        openCreateModal();
    @endif
</script>
@endpush
