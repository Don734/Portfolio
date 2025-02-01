document.addEventListener('DOMContentLoaded', () => {
    mobileMenu();
    projectSlider();
    testimonialSlider();
})

function mobileMenu() {
    const menuBtn = document.querySelector('.menu-btn');
    const menu = document.querySelector('.navbar');

    menuBtn.addEventListener('click', (e) => {
        if (menuBtn.classList.contains('active')) {
            menuBtn.classList.remove('active');
        } else {
            menuBtn.classList.add('active');
        }
        
        if (menu.classList.contains('active')) {
            menu.classList.remove('active');
        } else {
            menu.classList.add('active');
        }
    });
}

function projectSlider() {
    const swiperContainer = '.swiper-projects';
    const swiperOptions = {
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        slidesPerView: 1,
        spaceBetween: 20,
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 3,
            },
        },
        clickable: true,
        renderBullet: function (index, className) {
            return '<span class="' + className + '">' + (index + 1) + "</span>";
        },
    };
    const swiper = new Swiper(swiperContainer, swiperOptions);
}

function testimonialSlider() {
    const swiperContainerImage = '.swiper-image';
    const swiperContainerQuote = '.swiper-quote';
    const swiperOptionsImages = {
        effect: 'flip',
        loop: false, // Not recommended to enable!!!
        slidesPerView: 1,
        spaceBetween: 20,
    };
    const swiperOptionsQuote = {
        direction: "vertical",
        effect: "slide",
        loop: false, // Not recommended to enable!!!
        allowTouchMove: false,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        slidesPerView: 1,
        spaceBetween: 20,
    };
    const swiperImages = new Swiper(swiperContainerImage, swiperOptionsImages);
    const swiper = new Swiper(swiperContainerQuote, swiperOptionsQuote);
    swiper.controller.control = swiperImages;
    swiperImages.controller.control = swiper;
}