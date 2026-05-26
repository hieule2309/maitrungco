document.addEventListener("DOMContentLoaded", function () {
    // Thumbnail swiper
    var thumbSwiper = new Swiper(".thumbSwiper", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
    });

    // Main swiper with Auto Play
    var mainSwiper = new Swiper(".mainSwiper", {
        spaceBetween: 10,
        loop: true,
        effect: 'fade', // Hiệu ứng chuyển cảnh đẹp
        fadeEffect: {
            crossFade: true
        },
        autoplay: {
            delay: 3500, // Tự động trượt sau 3.5 giây
            disableOnInteraction: false, // Vẫn tự động trượt sau khi user tương tác
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: thumbSwiper,
        },
    });

    // Bắt sự kiện khi mainSwiper thay đổi slide (bao gồm cả autoplay)
    mainSwiper.on('slideChange', function () {
        // Đợi một chút để Swiper cập nhật class swiper-slide-thumb-active
        setTimeout(updateActiveThumb, 10);
    });

    function updateActiveThumb() {
        const slides = document.querySelectorAll('.thumbSwiper .swiper-slide');
        slides.forEach(slide => {
            if (slide.classList.contains('swiper-slide-thumb-active')) {
                slide.classList.add('border-blue-600', 'opacity-100');
                slide.classList.remove('border-transparent', 'opacity-60');
            } else {
                slide.classList.remove('border-blue-600', 'opacity-100');
                slide.classList.add('border-transparent', 'opacity-60');
            }
        });
    }

    // Init state
    setTimeout(updateActiveThumb, 100);
});
