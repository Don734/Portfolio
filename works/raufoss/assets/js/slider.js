document.addEventListener('DOMContentLoaded', Init);

function Init() {
    catalogSwiper();
}

function catalogSwiper() {
    const swiperContainer = '.swiper-container',
        swiperOptions = {
            // Optional parameters
            direction: 'vertical',
            slidesPerView: 4,
            spaceBetween: 15,
            autoHeight: true,
            breakpoints: {
                768: {
                    direction: 'vertical',
                    slidesPerView: 4,
                    spaceBetween: 15,
                    autoHeight: true,
                },
                320: {
                    direction: 'horizontal',
                    slidesPerView: 'auto',
                    spaceBetween: 10,
                    autoHeight: false
                }
            },
        
            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        };
    const swiper = new Swiper(swiperContainer, swiperOptions);
}