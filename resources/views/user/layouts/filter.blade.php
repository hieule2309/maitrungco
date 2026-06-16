<form id="filter-form" onsubmit="event.preventDefault(); applyFilters();" class="w-full md:w-64 flex-shrink-0">
    <aside>
        @if(isset($filterGroups) && $filterGroups->count() > 0)
            @foreach($filterGroups as $group)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-6">
                <h3 class="font-bold text-gray-800 mb-4 border-b pb-2 text-lg">{{ $group->name }}</h3>
                <ul class="space-y-3">
                    @foreach($group->filterValues as $filterValue)
                    <li>
                        <label class="flex items-center space-x-3 cursor-pointer group">
                            <input type="checkbox" data-group="{{ $group->slug }}" value="{{ $filterValue->slug }}"
                                onchange="applyFilters()"
                                {{ isset($filters[$group->slug]) && in_array($filterValue->slug, $filters[$group->slug]) ? 'checked' : '' }}
                                class="form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500 transition duration-150 ease-in-out filter-checkbox">
                            <span class="text-gray-700 group-hover:text-blue-600 transition">{{ $filterValue->value }}</span>
                        </label>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h3 class="font-bold text-gray-800 mb-4 border-b pb-2 text-lg">Mức Giá</h3>
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <input type="number" id="min_price" value="{{ request('min_price') }}" placeholder="Từ (đ)..." class="w-1/2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 block p-2 outline-none">
                    <span class="text-gray-500">-</span>
                    <input type="number" id="max_price" value="{{ request('max_price') }}" placeholder="Đến (đ)..." class="w-1/2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 block p-2 outline-none">
                </div>
                <button type="button" onclick="applyFilters()" class="w-full bg-blue-600 text-white rounded-lg py-2 text-sm font-medium hover:bg-blue-700 transition">
                    Áp dụng mức giá
                </button>
            </div>
        </div>
    </aside>
</form>

<script>
function applyFilters() {
    const url = new URL(window.location.href);
    
    // Clear existing filter params based on available groups
    @if(isset($filterGroups))
        @foreach($filterGroups as $group)
            url.searchParams.delete('{{ $group->slug }}');
        @endforeach
    @endif
    
    const checkboxes = document.querySelectorAll('.filter-checkbox:checked');
    const selectedFilters = {};
    
    checkboxes.forEach(cb => {
        const group = cb.getAttribute('data-group');
        if (!selectedFilters[group]) selectedFilters[group] = [];
        selectedFilters[group].push(cb.value);
    });
    
    for (const group in selectedFilters) {
        url.searchParams.set(group, selectedFilters[group].join(','));
    }
    
    // Add price filters
    const minPrice = document.getElementById('min_price').value;
    const maxPrice = document.getElementById('max_price').value;
    
    if (minPrice) url.searchParams.set('min_price', minPrice);
    else url.searchParams.delete('min_price');
    
    if (maxPrice) url.searchParams.set('max_price', maxPrice);
    else url.searchParams.delete('max_price');
    
    // Decode %2C back to comma to make the URL look cleaner
    window.location.href = url.toString().replace(/%2C/g, ',');
}
</script>
