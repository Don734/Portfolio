document.addEventListener('DOMContentLoaded', function () {
    const swiperContainer = '.swiper-news';
    const swiperOptions = {
        // Optional parameters
        direction: 'vertical',
      
        // If we need pagination
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
      };

    const swiper = new Swiper(swiperContainer, swiperOptions);
})