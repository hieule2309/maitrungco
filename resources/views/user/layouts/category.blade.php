<div class="group relative w-64 bg-blue-600 text-white">
    <div class="px-4 py-3 cursor-pointer flex justify-between items-center font-semibold">
        <span><i class="fas fa-bars mr-2"></i> DANH MỤC SẢN PHẨM</span>
    </div>

    <!-- Level 1 -->
    <ul class="absolute hidden group-hover:block w-full bg-white text-gray-800 shadow-xl border border-gray-200 z-50 rounded-b-lg">

        @foreach ($categories as $level1)
        <li class="group/sub relative border-b border-gray-100 hover:bg-gray-50">
            <a href="/c/{{ $level1->slug }}" class="flex justify-between items-center px-4 py-3">
                <span class="flex items-center text-sm font-medium"><i class="fas fa-laptop w-6 text-gray-400"></i>{{ $level1->name }}</span>
                <i class="fas fa-chevron-right text-xs text-gray-400"></i>
            </a>
            @if ($level1->allChildren->isNotEmpty())
                <ul class="absolute hidden group-hover/sub:block top-0 left-full w-56 bg-white shadow-xl border border-gray-200 rounded-r-lg h-full min-h-[300px]">
                    @foreach ($level1->allChildren as $level2)
                        <li class="group/sub2 relative hover:bg-gray-50">
                            <a href="/c/{{ $level2->slug }}" class="flex justify-between items-center px-4 py-3 border-b border-gray-100 text-sm font-medium">
                                {{ $level2->name }}
                                <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                            </a>
                            @if ($level2->allChildren->isNotEmpty())
                                <ul class="absolute hidden group-hover/sub2:block top-0 left-full w-56 bg-white shadow-xl border border-gray-200 rounded-r-lg">
                                @foreach ($level2->allChildren as $level3)
                                    <li>
                                        <a href="/c/{{ $level3->slug }}" class="block px-4 py-2.5 text-sm hover:text-blue-600 hover:bg-blue-50 transition border-b border-gray-50">
                                            {{ $level3->name }}
                                        </a>
                                    <li>
                                @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        <li>
        @endforeach
    </ul>
</div>
