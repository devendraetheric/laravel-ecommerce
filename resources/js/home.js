// import styles bundle
import 'swiper/css/bundle';

import Swiper from 'swiper/bundle';


new Swiper(".bannerSwiper", {
    loop: true,
    speed: 1000,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".banner-pagination",
        clickable: false,
    },
    navigation: {
        nextEl: ".banner-next",
        prevEl: ".banner-prev",
    },
});

new Swiper(".brandSwiper", {
    slidesPerView: 2,
    spaceBetween: 12,
    loop: true,
    mousewheel: true,
    navigation: {
        nextEl: '.brandSwiper-button-next',
        prevEl: '.brandSwiper-button-prev',
    },
    breakpoints: {
        375: {
            slidesPerView: 3,
            spaceBetween: 12,
        },
        640: {
            slidesPerView: 4,
            spaceBetween: 12,
        },
        768: {
            slidesPerView: 5,
            spaceBetween: 18,
        },
        1024: {
            slidesPerView: 6,
            spaceBetween: 24,
        },
        1500: {
            slidesPerView: 6,
            spaceBetween: 24,
        }
    },
});

new Swiper(".recentSwiper", {
    slidesPerView: 1,
    spaceBetween: 24,
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
        600: {
            slidesPerView: 2,
            spaceBetween: 12,
        },
        900: {
            slidesPerView: 3,
            spaceBetween: 18,
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 24,
        },
    },
});

new Swiper(".testimonialSwiper", {
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,
    navigation: {
        nextEl: ".testimonials-button-next",
        prevEl: ".testimonials-button-prev",
    },
    breakpoints: {
        1024: {
            slidesPerView: 3,
            spaceBetween: 24,
        },
    },
});