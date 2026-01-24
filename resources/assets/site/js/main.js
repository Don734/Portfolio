import.meta.glob([
    '../images/**',
]);

document.addEventListener('DOMContentLoaded', () => {
    navbarToggle();
    setLocale();
    projectTabs();
})

function navbarToggle() {
    const navbarToggle = document.getElementById('navbarToggle');
    const navbarMenu = document.getElementById('navbarMenu');

    if (navbarToggle) {
        navbarToggle.addEventListener('click', function() {
            navbarToggle.classList.toggle('active');
            navbarMenu.classList.toggle('active');
        });

        // Закрывать меню при клике на ссылку
        const navLinks = navbarMenu.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navbarToggle.classList.remove('active');
                navbarMenu.classList.remove('active');
            });
        });
    }
}

function projectTabs() {
    const tabs = document.querySelectorAll('#portfolioTab button');
    const skeletonTemplate = document.getElementById('portfolio-skeleton');

    tabs.forEach((tab) => {
        tab.addEventListener('shown.bs.tab', async (e) => {
            const category = tab.dataset.category;
            const pane = document.querySelector(tab.dataset.bsTarget);

            if (category === 'all') return;
            if (pane.dataset.loaded === 'true') return;

            pane.innerHTML = '';
            pane.appendChild(skeletonTemplate.content.cloneNode(true));

            try {
                const response = await fetch(`/portfolio/${category}`);
                if (!response.ok) throw new Error('Network response was not ok');
                const data = await response.text();
                pane.innerHTML = data;
                pane.dataset.loaded = 'true';
            } catch (e) {
                pane.innerHTML = '<p class="text-danger">Failed to load projects. Please try again later.</p>';
            }
        })
    })
}

function setLocale() {
    const localeLinks = document.querySelectorAll('.locale-menu .dropdown-item');

    localeLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const selectedLocale = this.getAttribute('data-locale');
            changeLocale(selectedLocale);
        });
    });
    
    function changeLocale(locale) {
        if (!locale) return;
        document.cookie = `locale=${locale}; path=/; max-age=${60 * 60 * 24 * 30}`;

        let currentLocale = document.documentElement.lang || 'en';
        let path = window.location.pathname;

        if (path.startsWith(`/${currentLocale}`)) {
            path = path.substring(currentLocale.length + 1);
        }
        if (!path.startsWith('/')) {
            path = '/' + path;
        }
        window.location.href = `/${locale}${path}`;
    }
}