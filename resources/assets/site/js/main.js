document.addEventListener('DOMContentLoaded', () => {
    projectTabs();
})

function projectTabs() {
    const tabs = document.querySelectorAll('#portfolioTab button');

    tabs.forEach((tab) => {
        tab.addEventListener('shown.bs.tab', async (e) => {
            const category = tab.dataset.category;
            const targetSelector = tab.getAttribute('data-bs-target');
            const pane = document.querySelector(targetSelector);

            if (category === 'all') return;

            if (pane.dataset.loaded === 'true') return;

            pane.innerHTML = pane.dataset.skeleton;

            try {
                console.log('Category loaded');
            } catch (e) {
                pane.innerHTML = '<p class="text-danger">Ошибка загрузки</p>';
            }
        })
    })
}