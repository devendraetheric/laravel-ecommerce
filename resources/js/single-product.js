// import styles bundle
import 'swiper/css/bundle';

import Swiper from 'swiper/bundle';

const thumbSwiper = new Swiper('.gallery-thumb', {
    slidesPerView: 5,
});

const mainSwiper = new Swiper('.gallery-main', {
    thumbs: {
        swiper: thumbSwiper,
    },
    loop: true,
    mousewheel: true,
});

new Swiper(".recentSwiper", {
    slidesPerView: 1,
    // spaceBetween: 24,
    loop: true,
    navigation: {
        nextEl: ".recentSwiper-button-next",
        prevEl: ".recentSwiper-button-prev",
    },
    breakpoints: {
        480: {
            slidesPerView: 2,
            spaceBetween: 12,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 18,
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 24,
        },
    },
});