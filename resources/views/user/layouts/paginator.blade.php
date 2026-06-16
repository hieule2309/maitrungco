@if ($paginator->hasPages())
    <div class="mt-10 flex justify-center">
        <nav class="flex items-center space-x-2">

            {{-- Nút Previous (Trang trước) --}}
            @if ($paginator->onFirstPage())
                <span class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-300 cursor-not-allowed">
                    <i class="fas fa-chevron-left text-sm"></i>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50 transition">
                    <i class="fas fa-chevron-left text-sm"></i>
                </a>
            @endif

            {{-- Các số trang (1, 2, 3...) --}}
            @foreach ($elements as $element)

                {{-- Dấu ba chấm (...) --}}
                @if (is_string($element))
                    <span class="text-gray-500 px-1">{{ $element }}</span>
                @endif

                {{-- Render các nút số --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-600 text-white font-medium shadow">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50 transition font-medium">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Nút Next (Trang sau) --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50 transition">
                    <i class="fas fa-chevron-right text-sm"></i>
                </a>
            @else
                <span class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-300 cursor-not-allowed">
                    <i class="fas fa-chevron-right text-sm"></i>
                </span>
            @endif

        </nav>
    </div>
@endif
