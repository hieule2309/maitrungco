@php
    $category = $item['category'];
    $level    = $item['level'];
    $isRoot   = $level === 1;
    $flat     = $flatMode ?? false;
    $slugDisplay = preg_replace('/-\d+$/', '', $category->slug);
@endphp

<tr class="hover:bg-gray-50/70 transition {{ !$flat && $isRoot ? 'bg-blue-50/30' : '' }}">
    <td class="p-4">
        @if ($flat || $level === 1)
            <div class="flex items-center {{ $isRoot ? 'font-bold text-gray-800' : 'font-semibold text-gray-700' }}">
                <i class="{{ $category->icon }} w-6 text-gray-400 text-center mr-2 text-sm"></i>
                <a href="{{ route('admin.categories.edit', $category) }}" class="hover:text-blue-600 transition">{{ $category->name }}</a>
                @if($flat && !$isRoot)
                <span class="ml-2 text-xs font-normal text-gray-400 border border-gray-200 rounded px-1.5 py-0.5 bg-white">Tầng {{ $level }}</span>
                @endif
            </div>
        @elseif ($level === 2)
            <div class="flex items-center text-gray-800 ml-8">
                <i class="fas fa-level-up-alt rotate-90 text-gray-300 mr-2 text-xs"></i>
                <a href="{{ route('admin.categories.edit', $category) }}" class="hover:text-blue-600 font-semibold transition">{{ $category->name }}</a>
            </div>
        @else
            <div class="flex items-center ml-16">
                <div class="w-2 h-2 rounded-full bg-gray-300 mr-3 flex-shrink-0"></div>
                <a href="{{ route('admin.categories.edit', $category) }}" class="hover:text-blue-600 transition">{{ $category->name }}</a>
            </div>
        @endif
    </td>
    <td class="p-4">
        <code class="text-xs bg-gray-100 text-gray-500 px-2 py-1 rounded-md font-mono">{{ $slugDisplay ?: '—' }}</code>
    </td>
    <td class="p-4 text-center">
        <span class="bg-gray-100 text-gray-700 py-1 px-2.5 rounded-full text-xs font-semibold inline-block">Tầng {{ $level }}</span>
    </td>
    <td class="p-4 text-xs text-gray-400">{{ $category->created_at->format('d/m/Y') }}</td>
    <td class="p-4 text-xs text-gray-400">{{ $category->updated_at->diffForHumans() }}</td>
    <td class="p-4 text-center">
        <div class="flex items-center justify-center gap-1">
            <a href="{{ route('admin.categories.edit', $category) }}"
                class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition"
                title="Chỉnh sửa">
                <i class="fas fa-edit text-xs"></i>
            </a>
            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                onsubmit="return confirm('Xóa danh mục «{{ addslashes($category->name) }}»?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="w-8 h-8 rounded-full bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition"
                    title="Xóa">
                    <i class="fas fa-trash-alt text-xs"></i>
                </button>
            </form>
        </div>
    </td>
</tr>
