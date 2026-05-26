document.addEventListener('DOMContentLoaded', function () {
    const categorySelect = document.getElementById('categorySelect');
    if (categorySelect) {
        categorySelect.addEventListener('change', function () {
            const options = Array.from(this.options);

            // Hàm đếm khoảng trắng đầu dòng để xác định cấp bậc danh mục
            function getLevel(option) {
                const match = option.text.match(/^[\u00a0\s]+/);
                return match ? match[0].length : 0;
            }

            options.forEach((opt, index) => {
                if (opt.selected) {
                    let currentLevel = getLevel(opt);

                    // Tìm ngược lên trên để tự động chọn danh mục cha
                    for (let i = index - 1; i >= 0; i--) {
                        let prevLevel = getLevel(options[i]);
                        if (prevLevel < currentLevel) {
                            options[i].selected = true;
                            currentLevel = prevLevel; // Tiếp tục tìm cha của cấp cao hơn
                        }
                    }
                }
            });
        });
    }
});