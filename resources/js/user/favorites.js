document.addEventListener('DOMContentLoaded', function () {
    const removeBtns = document.querySelectorAll('.remove-btn');
    const grid = document.getElementById('favorites-grid');
    const emptyState = document.getElementById('empty-favorites');

    removeBtns.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const item = this.closest('.favorite-item');

            // Hiệu ứng fade out
            item.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            item.style.opacity = '0';
            item.style.transform = 'scale(0.9)';

            setTimeout(() => {
                item.remove();

                // Kiểm tra nếu không còn item nào
                if (document.querySelectorAll('.favorite-item').length === 0) {
                    grid.classList.add('hidden');
                    emptyState.classList.remove('hidden');
                    emptyState.classList.add('flex');
                }
            }, 300);
        });
    });

    // Nút xóa tất cả
    const clearAllBtn = document.querySelector('.fa-trash-alt').closest('button');
    if (clearAllBtn) {
        clearAllBtn.addEventListener('click', function () {
            if (confirm('Bạn có chắc chắn muốn xóa tất cả sản phẩm khỏi danh sách yêu thích?')) {
                const items = document.querySelectorAll('.favorite-item');
                items.forEach(item => {
                    item.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                    item.style.opacity = '0';
                    item.style.transform = 'scale(0.9)';
                });

                setTimeout(() => {
                    items.forEach(item => item.remove());
                    grid.classList.add('hidden');
                    emptyState.classList.remove('hidden');
                    emptyState.classList.add('flex');
                }, 300);
            }
        });
    }
});
