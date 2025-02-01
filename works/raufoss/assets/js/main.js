document.addEventListener('DOMContentLoaded', Init);

function Init() {
    mainMenuToggle();
    selectMedia();
}

function mainMenuToggle() {
    let menuOpen = document.querySelector('.menu-toggle.open'),
        menuClose = document.querySelector('.menu-toggle.close'),
        menu = document.querySelector('.main-menu'),
        btnArr = [menuOpen, menuClose];


    btnArr.forEach((btn) => {
        btn.addEventListener('click', function (e) {
            if (e.target.parentElement.classList.contains('open')) {
                menu.classList.add('show');
            } else {
                menu.classList.remove('show');
            }
        })
    })
}

function selectMedia() {
    let container = document.querySelector('.modal-wrap.show'),
        selectBtn = container.querySelectorAll('a.slide-link'),
        image = container.querySelector('.media-block .img-block'),
        video = container.querySelector('.media-block .video-block');

    container.querySelector('.modal-close').addEventListener('click', () => {
        container.classList.remove('show');
    })

    selectBtn.forEach(btn => {
        btn.addEventListener('click', function (e){
            e.preventDefault();
            container.querySelectorAll('.swiper-slide').forEach(elem => {
                elem.classList.remove('active');
            })
            this.parentElement.classList.add('active');
            if(this.classList.contains('video-link')) {
                image.classList.remove('show');
                video.classList.add('show');
                video.querySelector('video').src = this.href;
            } else {
                video.classList.remove('show');
                image.classList.add('show');
                image.querySelector('img').src = this.href;
            }

            if(container.classList.contains('show')) {
                document.documentElement.style.overflow = 'hidden';
            }
        })
    })
}