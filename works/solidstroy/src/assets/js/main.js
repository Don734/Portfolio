let width = 100
    perfData = window.performance.timing
    EstimatedTime = -(perfData.loadEventEnd - perfData.navigationStart)
    time = ((EstimatedTime / 1000) % 50) * 10;

$('.loadbar').animate({
    width: width + "%"
}, time / 0.8);

let preloader__count = document.querySelector('.preloader__counter'),
    start = 0,
    end = 100,
    duration = time + 400;
    animateValue(preloader__count, start, end, duration);


setTimeout(() => {
    gsap.to('.inner-loadbar', {force3D: true, width: '100%', duration: 1, delay: 0.1, ease: 'Power2.easeOut', onComplete: () => {
        gsap.set('.loadbar', {visibility: 'hidden', opacity: 0});
        gsap.to('#preloader', {force3D: true, duration: 0.7, yPercent: -101, delay: 0.6, ease: 'Power2.easeInOut'});
    }});
}, time)


function animateValue(id, start, end, duration) {
    let range = end - start,
        current = start,
        increment = end > start ? 1 : -1,
        stepTime = Math.abs(Math.floor(duration / range));
        
    let timer = setInterval(() => {
        current += increment;
        id.textContent = current;

        if(current == end) {
            clearInterval(timer);
        }
    }, stepTime)
}

document.addEventListener('DOMContentLoaded', Init())

function Init() {
    menuToggle();
    ballCursor();
    bgTilt();
    scrollBar();
    toggleMedia();

    gsap.set($('.section-header .page-title'), {opacity: 0, transform: 'translate3d(0,15vh,0)', delay: 0})
    gsap.set($('.section-header .page-title span'), {opacity: 0, transform: 'translate3d(0,15vh,0)', delay: 0})
    gsap.set($('.section-header .page-subtitle'), {opacity: 0, transform: 'translate3d(0,15vh,0)', delay: 0})
    gsap.to($('.section-header .page-title'), {duration: 0.4, force3D: true, opacity: 1, y: 0, delay: 0.95, ease: 'Power2.easeOut'})
    gsap.to($('.section-header .page-title span'), {duration: 0.4, force3D: true, stagger: 0.2, opacity: 1, y: 0, delay: 0.95, ease: 'Power2.easeOut'})
    gsap.to($('.section-header .page-subtitle'), {duration: 0.4, force3D: true, opacity: 1, y: 0, delay: 0.1, ease: 'Power2.easeOut'})
}

function menuToggle() {
    let tl = gsap.timeline()
    tl.paused(true);

    tl.set('body', {perspective: 1500, backgroundColor: "#09291F"})
    tl.to('body', {duration: 1, stagger: 0.3, ease: 'power1.inOut'});
    tl.to('.viewport', 0.2, {x: "-50%", z: "-1800px", rotationY: "45deg", ease: "power1.inOut"});
    tl.from('.outer-nav', {duration: 0.5, visibility: 'hidden', display: 'none'})
    tl.from('.outer-nav .nav-menu .nav-item', {duration: 1, x: 100, delay: 0.5, opacity: 0, stagger: 0.3, ease: 'power1.inOut'});
    tl.reverse()

    $('.header__menu-toggle').click(function () {
        $('body').addClass('perspective-active');
        $('.outer-nav--return').addClass('is-vis');
        $('.viewport').addClass('is-vis');

        tl.reversed(!tl.reversed())
    })

    $('.outer-nav--return').click(function (e) {
        tl.reversed(!tl.reversed())

        $('body').removeClass('perspective-active');
        $('.outer-nav--return').removeClass('is-vis');
        $('.viewport').removeClass('is-vis');
    })
}

function ballCursor() {
    let cursor = document.querySelector('#ball');

    document.addEventListener('mousemove', function (event) {
        gsap.to(cursor, 0.2, {
            x: event.clientX,
            y: event.clientY
        })
    });

    $('a, .col').mouseenter(function (e) {
        gsap.to(cursor, 0.3, {
            borderWidth: '0px',
            scale: 3,
            backgroundColor: "rgba(127, 127, 127, 1)",
            opacity: .15,
        })
    })

    $('a, .col').mouseleave(function (e) {
        gsap.to(cursor, 0.3, {
            borderWidth: '2px',
            scale: 1,
            backgroundColor: "rgba(127, 127, 127, 0)",
            opacity: 1,
        })
    })

    $('.header__menu-toggle').mouseenter(function (e) {
        gsap.to(cursor, 0.3, {
            borderWidth: '0px',
            scale: 3,
            backgroundColor: "rgba(127, 127, 127, 1)",
            opacity: .15,
        })
    })

    $('.header__menu-toggle').mouseleave(function (e) {
        gsap.to(cursor, 0.3, {
            borderWidth: '2px',
            scale: 1,
            backgroundColor: "rgba(127, 127, 127, 0)",
            opacity: 1,
        })
    })


    $('.swiper-button-prev, .swiper-button-next').mouseenter(function () {
        gsap.to(cursor, 0.3, {
            scale: 2,
        })
    })

    $('.swiper-button-prev, .swiper-button-next').mouseleave(function () {
        gsap.to(cursor, 0.3, {
            scale: 1,
        })
    })
}

function bgTilt() {
    let maxTilt = 3;
    let elem = document.querySelector('#showcase-tilt');

    gsap.set('#showcase-tilt', { transformPerspective: 2000, transformOrigin: "center" });
    let bgTilt = gsap.to('#showcase-tilt', {duration: 1, scale: 1.05, ease: Power1.easeOut, paused: true});

    document.addEventListener('mousemove', (event) => {
        bgTilt.vars.rotationY = ((event.pageX / window.screen.width) * (maxTilt * 2)) - maxTilt
        bgTilt.vars.rotationX = (((event.pageY - elem.offsetTop) / window.screen.height) * (maxTilt * 2)) - maxTilt;
        bgTilt.invalidate().restart();
    })
}

function scrollBar() {
    Scrollbar.init(document.querySelector('.content'));
}

function toggleMedia() {
    $('.photo-gallery').click(function (e) { 
        e.preventDefault();
        
        $('.product-thumb-slider').toggleClass('show');
    });
}