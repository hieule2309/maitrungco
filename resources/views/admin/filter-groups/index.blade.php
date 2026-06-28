@extends('admin.layouts.app')

@section('title', 'Quản lý Nhóm Filter')

@section('content')

<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Nhóm Filter</h1>
        <p class="text-sm text-gray-500 mt-1">Quản lý các nhóm thuộc tính lọc sản phẩm (CPU, RAM, Màu sắc…).</p>
    </div>
    <button type="button" onclick="openCreateModal()"
        class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-700 active:scale-95 transition-all shadow-sm">
        <i class="fas fa-plus text-xs"></i> Thêm Nhóm Filter
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
<form method="GET" action="{{ route('admin.filter-groups.index') }}" id="fg-filter-form" class="mb-4">
    <div class="flex gap-2 items-center">
        <div class="relative w-72">
            <input type="text" name="search" id="fg-search" value="{{ request('search') }}"
                placeholder="Tìm theo tên nhóm…"
                autocomplete="off"
                class="w-full border border-gray-300 rounded-lg pl-9 pr-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
        @if(request('search'))
        <a href="{{ route('admin.filter-groups.index') }}"
            class="flex items-center gap-1.5 px-3 py-2 bg-gray-100 text-gray-500 text-sm rounded-lg hover:bg-gray-200 transition">
            <i class="fas fa-times text-xs"></i> Xóa lọc
        </a>
        @endif
    </div>
</form>

@push('scripts')
<script>
(function () {
    const input = document.getElementById('fg-search');
    const form  = document.getElementById('fg-filter-form');
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
        <span class="font-semibold text-gray-700 text-sm">Danh sách nhóm</span>
        <span class="text-xs text-gray-400 bg-gray-100 px-2.5 py-1 rounded-full font-medium">{{ $filterGroups->total() }} nhóm</span>
    </div>

    <table class="w-full text-left">
        <thead>
            <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                <th class="px-6 py-3 font-semibold">Tên Nhóm</th>
                <th class="px-6 py-3 font-semibold">Slug</th>
                <th class="px-6 py-3 font-semibold text-center w-28">Số giá trị</th>
                <th class="px-6 py-3 font-semibold">Ngày tạo</th>
                <th class="px-6 py-3 font-semibold">Cập nhật</th>
                <th class="px-6 py-3 font-semibold text-center w-24">Thao tác</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50 text-sm">
            @forelse ($filterGroups as $group)
            <tr class="hover:bg-gray-50/70 transition-colors group">
                <td class="px-6 py-3.5">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold flex-shrink-0">
                            {{ mb_strtoupper(mb_substr($group->name, 0, 2)) }}
                        </div>
                        <span class="font-semibold text-gray-800">{{ $group->name }}</span>
                    </div>
                </td>
                <td class="px-6 py-3.5">
                    {{-- Hiển thị slug không kèm -id ở cuối --}}
                    @php $slugDisplay = preg_replace('/-\d+$/', '', $group->slug); @endphp
                    <code class="text-xs bg-gray-100 text-gray-500 px-2 py-1 rounded-md font-mono">{{ $slugDisplay ?: '—' }}</code>
                </td>
                <td class="px-6 py-3.5 text-center">
                    <span class="inline-flex items-center justify-center min-w-[1.5rem] h-5 px-2 rounded-full text-xs font-bold
                        {{ $group->values_count > 0 ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-400' }}">
                        {{ $group->values_count }}
                    </span>
                </td>
                <td class="px-6 py-3.5 text-xs text-gray-400">{{ $group->created_at->format('d/m/Y') }}</td>
                <td class="px-6 py-3.5 text-xs text-gray-400">{{ $group->updated_at->diffForHumans() }}</td>
                <td class="px-6 py-3.5 text-center">
                    <div class="flex items-center justify-center gap-1">
                        <button type="button"
                            onclick="openEditModal({{ $group->id }}, @js($group->name))"
                            class="w-8 h-8 flex items-center justify-center rounded-full bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition" title="Chỉnh sửa">
                            <i class="fas fa-edit text-xs"></i>
                        </button>
                        <form action="{{ route('admin.filter-groups.destroy', $group) }}" method="POST"
                              onsubmit="return confirm('Xóa nhóm «{{ addslashes($group->name) }}» sẽ xóa toàn bộ giá trị bên trong. Tiếp tục?')">
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
                        <i class="fas fa-layer-group text-xl text-gray-300"></i>
                    </div>
                    <p class="text-sm font-medium text-gray-400 mb-1">
                        {{ request('search') ? 'Không tìm thấy nhóm nào khớp.' : 'Chưa có nhóm filter nào.' }}
                    </p>
                    @unless(request('search'))
                    <button onclick="openCreateModal()" class="text-sm text-blue-500 hover:text-blue-700 font-medium transition">
                        + Thêm nhóm đầu tiên
                    </button>
                    @endunless
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($filterGroups->hasPages())
    <div class="px-6 py-3 border-t border-gray-100">
        {{ $filterGroups->appends(request()->query())->links() }}
    </div>
    @endif
</div>


{{-- ══════════════════ MODAL CREATE ══════════════════ --}}
<div id="modal-create" class="fixed inset-0 z-50" style="display:none">
    <div class="absolute inset-0 bg-black/50" onclick="closeCreateModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="relative w-full max-w-sm bg-white rounded-xl shadow-2xl animate-modal">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-900 text-base">Thêm nhóm filter</h3>
                <button type="button" onclick="closeCreateModal()"
                    class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition text-xl leading-none">
                    &times;
                </button>
            </div>
            <form action="{{ route('admin.filter-groups.store') }}" method="POST" class="px-5 py-4">
                @csrf
                <input type="hidden" name="_form" value="create">
                <div class="mb-4">
                    <label for="create-name" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Tên nhóm <span class="text-red-500">*</span>
                    </label>
                    <input id="create-name" name="name" type="text" maxlength="255" required
                        value="{{ old('name') }}"
                        placeholder="Ví dụ: CPU, RAM, Màu sắc…"
                        class="w-full border border-gray-300 rounded-lg py-2.5 px-3.5 text-sm text-gray-800 placeholder-gray-400
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all
                               @error('name') border-red-400 ring-2 ring-red-100 @enderror">
                    @error('name')
                    <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </p>
                    @enderror
                    <p class="text-xs text-gray-400 mt-2">
                        Slug tự sinh: <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-500">ten-nhom-id</code>
                    </p>
                </div>
                <div class="flex items-center justify-end gap-2 pt-2 border-t border-gray-100">
                    <button type="button" onclick="closeCreateModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition-colors">
                        Hủy
                    </button>
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                        <i class="fas fa-plus text-xs"></i> Lưu nhóm
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
        <div class="relative w-full max-w-sm bg-white rounded-xl shadow-2xl animate-modal">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-900 text-base">Chỉnh sửa nhóm filter</h3>
                <button type="button" onclick="closeEditModal()"
                    class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition text-xl leading-none">
                    &times;
                </button>
            </div>
            <form id="edit-form" action="" method="POST" class="px-5 py-4">
                @csrf @method('PUT')
                <div class="mb-4">
                    <label for="edit-name" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Tên nhóm <span class="text-red-500">*</span>
                    </label>
                    <input id="edit-name" name="name" type="text" maxlength="255" required
                        placeholder="Tên nhóm filter"
                        class="w-full border border-gray-300 rounded-lg py-2.5 px-3.5 text-sm text-gray-800 placeholder-gray-400
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    <p class="text-xs text-gray-400 mt-2">Slug sẽ tự cập nhật theo tên mới.</p>
                </div>
                <div class="flex items-center justify-end gap-2 pt-2 border-t border-gray-100">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition-colors">
                        Hủy
                    </button>
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

    function openCreateModal()  { _open($mc, 'create-name'); }
    function closeCreateModal() { _close($mc); }

    function openEditModal(id, name) {
        document.getElementById('edit-form').action = `/admin/filter-groups/${id}`;
        document.getElementById('edit-name').value  = name;
        _open($me, 'edit-name');
    }
    function closeEditModal() { _close($me); }

    document.addEventListener('keydown', e => { if (e.key === 'Escape') { closeCreateModal(); closeEditModal(); } });

    @if ($errors->any() && old('_form') === 'create')
        openCreateModal();
    @endif
</script>
@endpush
