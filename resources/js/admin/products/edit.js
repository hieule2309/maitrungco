document.addEventListener('DOMContentLoaded', () => {

    // Price formatting
    const priceInput = document.getElementById('product-price');
    if (priceInput) {
        priceInput.addEventListener('input', () => {
            const raw = priceInput.value.replace(/\D/g, '');
            priceInput.value = raw ? Number(raw).toLocaleString('vi-VN') : '';
        });
    }

    // Category: auto-check parent when child checked
    document.querySelectorAll('.category-child').forEach(cb => {
        cb.addEventListener('change', () => {
            if (cb.checked) {
                const parentCb = document.querySelector(`.category-parent[data-id="${cb.dataset.parent}"]`);
                if (parentCb) parentCb.checked = true;
            }
        });
    });

    // Existing image drag-sort + remove
    const existingList = document.getElementById('existing-image-list');
    let dragSrc = null;

    function reindexExistingSort() {
        existingList.querySelectorAll('.existing-image-item').forEach((el, i) => {
            el.querySelector('.img-sort-input').value = i;
        });
    }

    if (existingList) {
        existingList.querySelectorAll('.existing-image-item').forEach(item => {
            item.addEventListener('dragstart', () => { dragSrc = item; item.classList.add('opacity-50'); });
            item.addEventListener('dragend',   () => item.classList.remove('opacity-50'));
            item.addEventListener('dragover',  e => e.preventDefault());
            item.addEventListener('drop', e => {
                e.preventDefault();
                if (!dragSrc || dragSrc === item) return;
                const parent = item.parentNode;
                const items = [...parent.querySelectorAll('.existing-image-item')];
                const fromIdx = items.indexOf(dragSrc);
                const toIdx   = items.indexOf(item);
                if (fromIdx < toIdx) parent.insertBefore(dragSrc, item.nextSibling);
                else parent.insertBefore(dragSrc, item);
                reindexExistingSort();
            });

            item.querySelector('.btn-remove-existing').addEventListener('click', () => {
                item.querySelector('.existing-img-hidden').disabled = true;
                item.querySelector('.img-sort-input').disabled = true;
                item.style.display = 'none';
                reindexExistingSort();
            });
        });
    }

    // New image upload + drag-sort
    const dropzone    = document.getElementById('image-dropzone');
    const fileInput   = document.getElementById('image-input');
    const previewList = document.getElementById('image-preview-list');
    const fileInputs  = document.getElementById('image-file-inputs');
    if (!dropzone) return;

    let fileQueue = [];

    function renderNewPreviews() {
        previewList.innerHTML = '';
        fileInputs.innerHTML  = '';
        fileQueue.forEach((item, idx) => {
            const div = document.createElement('div');
            div.className = 'relative group rounded-lg overflow-hidden border border-gray-200 cursor-grab';
            div.draggable  = true;
            div.dataset.idx = idx;
            div.innerHTML = `
                <img src="${item.objectUrl}" class="w-full h-24 object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                    <button type="button" class="bg-red-600 text-white text-xs px-2 py-1 rounded remove-new" data-idx="${idx}">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>`;

            div.addEventListener('dragstart', () => { dragSrc = div; div.classList.add('opacity-50'); });
            div.addEventListener('dragend',   () => div.classList.remove('opacity-50'));
            div.addEventListener('dragover',  e => e.preventDefault());
            div.addEventListener('drop', e => {
                e.preventDefault();
                if (!dragSrc || dragSrc === div) return;
                const from = +dragSrc.dataset.idx, to = +div.dataset.idx;
                const [moved] = fileQueue.splice(from, 1);
                fileQueue.splice(to, 0, moved);
                renderNewPreviews();
            });
            div.querySelector('.remove-new').addEventListener('click', () => {
                URL.revokeObjectURL(item.objectUrl);
                fileQueue.splice(idx, 1);
                renderNewPreviews();
            });
            previewList.appendChild(div);

            const dt = new DataTransfer();
            dt.items.add(item.file);
            const fi = document.createElement('input');
            fi.type = 'file'; fi.name = 'images[]'; fi.files = dt.files; fi.hidden = true;
            fileInputs.appendChild(fi);
        });
    }

    function addFiles(files) {
        Array.from(files).forEach(f => fileQueue.push({ file: f, objectUrl: URL.createObjectURL(f) }));
        renderNewPreviews();
    }

    dropzone.addEventListener('click',    () => fileInput.click());
    dropzone.addEventListener('dragover',  e => { e.preventDefault(); dropzone.classList.add('bg-blue-50'); });
    dropzone.addEventListener('dragleave', () => dropzone.classList.remove('bg-blue-50'));
    dropzone.addEventListener('drop', e => {
        e.preventDefault();
        dropzone.classList.remove('bg-blue-50');
        addFiles(e.dataTransfer.files);
    });
    fileInput.addEventListener('change', () => addFiles(fileInput.files));

});
