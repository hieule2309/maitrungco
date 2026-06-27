<!-- Quick View Modal -->
<div id="quick-view-overlay" 
     onclick="closeQuickView()"
     class="fixed inset-0 bg-gray-900 bg-opacity-60 z-50 backdrop-blur-sm hidden transition-opacity duration-300"></div>

<div id="quick-view-modal"
     class="fixed inset-0 z-50 overflow-y-auto pointer-events-none hidden">
    <div class="flex min-h-full items-center justify-center p-4">
        <div id="quick-view-panel"
             onclick="event.stopPropagation()"
             class="relative pointer-events-auto transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl w-full max-w-4xl transition-all duration-300 scale-95 opacity-0">

            <!-- Close Button -->
            <button onclick="closeQuickView()"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 focus:outline-none transition-colors z-10 bg-white rounded-full w-9 h-9 flex items-center justify-center shadow hover:shadow-md">
                <i class="fas fa-times text-lg"></i>
            </button>

            <!-- Product Content -->
            <div class="flex flex-col md:flex-row">
                <!-- Image -->
                <div class="md:w-1/2 p-8 bg-gray-50 flex items-center justify-center relative min-h-[300px]">
                    <img id="qv-image" src="" alt="" class="max-w-full h-auto object-contain max-h-[400px]">
                    <div id="qv-discount-badge"
                         class="absolute top-4 left-4 bg-red-500 text-white font-bold px-3 py-1 rounded-lg shadow-sm hidden"></div>
                </div>

                <!-- Info -->
                <div class="md:w-1/2 p-8 flex flex-col">
                    <span class="text-xs text-blue-600 font-semibold uppercase tracking-widest mb-1">Xem nhanh sản phẩm</span>
                    <h2 id="qv-name" class="text-2xl font-bold text-gray-800 leading-tight mb-4"></h2>

                    <!-- Price -->
                    <div class="flex items-end gap-3 mb-6 pb-6 border-b border-gray-100">
                        <span id="qv-price" class="text-3xl font-extrabold text-red-600"></span>
                        <span id="qv-old-price" class="text-lg text-gray-400 line-through mb-1 hidden"></span>
                    </div>

                    <!-- Specs (static) -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-800 mb-3">Cam kết & Chính sách:</h4>
                        <ul class="text-gray-600 text-sm space-y-2">
                            <li class="flex items-center gap-2"><i class="fas fa-check-circle text-green-500"></i> Hàng chính hãng, đầy đủ tem nhãn</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check-circle text-green-500"></i> Bảo hành chính hãng 12 tháng</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check-circle text-green-500"></i> Đổi trả 1-1 trong 7 ngày nếu có lỗi NSX</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check-circle text-green-500"></i> Giao hàng toàn quốc, nhanh chóng</li>
                        </ul>
                    </div>

                    <!-- Actions -->
                    <div class="mt-auto flex gap-3">
                        <a id="qv-detail-link" href="#"
                           class="flex-1 bg-white border-2 border-blue-600 text-blue-600 text-center rounded-xl py-3 font-bold hover:bg-blue-50 transition-colors flex items-center justify-center gap-2">
                            <i class="fas fa-info-circle"></i> Xem chi tiết
                        </a>
                        {{-- <button class="flex-1 bg-blue-600 text-white rounded-xl py-3 font-bold shadow-md hover:bg-blue-700 hover:shadow-lg transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                        </button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function openQuickView(product) {
    document.getElementById('qv-name').textContent       = product.name || '';
    document.getElementById('qv-price').textContent      = product.price || '';
    document.getElementById('qv-image').src              = product.image || '';
    document.getElementById('qv-image').alt              = product.name || '';
    document.getElementById('qv-detail-link').href       = product.url || '#';

    const oldPriceEl = document.getElementById('qv-old-price');
    if (product.old_price) {
        oldPriceEl.textContent = product.old_price;
        oldPriceEl.classList.remove('hidden');
    } else {
        oldPriceEl.classList.add('hidden');
    }

    const badgeEl = document.getElementById('qv-discount-badge');
    if (product.discount) {
        badgeEl.textContent = product.discount;
        badgeEl.classList.remove('hidden');
    } else {
        badgeEl.classList.add('hidden');
    }

    // Show overlay + modal
    const overlay = document.getElementById('quick-view-overlay');
    const modal   = document.getElementById('quick-view-modal');
    const panel   = document.getElementById('quick-view-panel');

    overlay.classList.remove('hidden');
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';

    // Trigger animation next frame
    requestAnimationFrame(() => {
        panel.classList.remove('scale-95', 'opacity-0');
        panel.classList.add('scale-100', 'opacity-100');
    });
}

function closeQuickView() {
    const overlay = document.getElementById('quick-view-overlay');
    const modal   = document.getElementById('quick-view-modal');
    const panel   = document.getElementById('quick-view-panel');

    panel.classList.remove('scale-100', 'opacity-100');
    panel.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
        overlay.classList.add('hidden');
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }, 250);
}

// Close on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeQuickView();
});
</script>
