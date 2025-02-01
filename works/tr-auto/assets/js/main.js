document.addEventListener('DOMContentLoaded', function () {
    menuToggle();
    searchToggle();
})

function menuToggle() {
    let menu_open = document.querySelector('.menu-open'),
        menu = document.querySelector('.nav-menu');

    menu_open.addEventListener('click', function () {
        menu.classList.add('show');
    })

    $(document).on('click', function (e) {
        if ( !( ($(e.target).parents('.nav-menu').length) || ($(e.target).hasClass('nav-link')) || ($(e.target).parents('.menu-open').length) || ($(e.target).hasClass('menu-open')) ) || $(e.target).parents('.menu-close').length ) {
            $('.nav-menu').removeClass('show');
        }
    })
}

function searchToggle() {
    let search_open = document.querySelector('.search-open'),
        search = document.querySelector('.search .nav-search');

    search_open.addEventListener('click', function () {
        search.classList.add('show');
        this.classList.add('active');
    })

    $(document).on('click', function (e) {
        if ( !( ($(e.target).parents('.search .nav-search').length) || ($(e.target).parents('.search-open').length) || ($(e.target).hasClass('search-open')) ) || $(e.target).parents('.search-close').length ) {
            $('.search .nav-search').removeClass('show');
            search_open.classList.remove('active');
        }
    })
}