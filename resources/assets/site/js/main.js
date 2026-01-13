import.meta.glob([
    '../images/**',
]);

document.addEventListener('DOMContentLoaded', () => {
    projectTabs();
})

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
                const response = await fetch(`/projects/${category}`);
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