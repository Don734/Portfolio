import { CountUp } from "../vendors/countup/countUp.min.js";

document.addEventListener('DOMContentLoaded', function () {
    partnersSwiper();
    gallerySwiper();
    customersSwiper();
    formSetMask();
    fixNavbar();
    setCounter();
    menuToggle();
})

function partnersSwiper() {
    let swiperContainer = '.partners-swiper';
    let swiperOptions = {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 10,
        breakpoints: {
            768: {
                slidesPerView: 3,
                // spaceBetween: 30
            },
            992: {
                slidesPerView: 4,
                // spaceBetween: 40
            }
        }
    };
    const swiper = new Swiper(swiperContainer, swiperOptions);
}

function gallerySwiper() {
    let swiperContainer = '.gallery-swiper';
    let swiperOptions = {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 15,
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 4,
            }
        }
    };
    const swiper = new Swiper(swiperContainer, swiperOptions);
}

function customersSwiper() {
    let swiperContainer = '.customers-swiper';
    let swiperOptions = {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 15,
        navigation: {
            nextEl: '.customer-card .swiper-button-next',
            prevEl: '.customer-card .swiper-button-prev',
        },
    };
    const swiper = new Swiper(swiperContainer, swiperOptions);
}

function fixNavbar() {
    const header = document.querySelector('.header').offsetHeight;
    const top_secondary = document.querySelector('.top-secondary');
    document.addEventListener('scroll', function (e) {
        if (window.pageYOffset >= header) {
            top_secondary.classList.add('fixed');
        } else {
            top_secondary.classList.remove('fixed');
        }
    })
}

function setCounter() {
    // const about_count = document.querySelector('#about_count');
    const adv_counts = document.querySelectorAll('.adv-count .counter');

    let options = {
        enableScrollSpy: true
    }; 

    // const aboutCounter = new CountUp('about_count', about_count.dataset.count, options);

    adv_counts.forEach((elem, id, array) => {
        if (id === array.length - 1) {
            options['suffix'] = '+';
        }
        const adv_Counter = new CountUp(`${elem.id}`, elem.dataset.count, options);

        if (!adv_Counter.error) {
            adv_Counter.handleScroll();
        } else {
            console.error(adv_Counter.error);
        }
    });

    // if (!aboutCounter.error) {
    //     aboutCounter.handleScroll();
    // } else {
    //     console.error(aboutCounter.error);
    // }
}

function menuToggle() {
    const button = $('.burger');

    button.on('click', (e) => {
        let menu = $(e.target).closest('.nav-wrap').find('.header__nav');
        
        if (!$(e.target).hasClass('active') && !menu.hasClass('show')) {
            $(e.target).addClass('active');
            menu.addClass('show');
        } else {
            $(e.target).removeClass('active');
            menu.removeClass('show');
        }
    })
}

function formSetMask() {
    let date = new Date();
    let day = ("0" + date.getDate()).slice(-2);
    let month = ("0" + date.getMonth()+1).slice(-2);
    let year = date.getFullYear();
    let fullDate = day+'/'+month+'/'+year;
    $('input[name=date]').val(fullDate).mask('00/00/0000');
}