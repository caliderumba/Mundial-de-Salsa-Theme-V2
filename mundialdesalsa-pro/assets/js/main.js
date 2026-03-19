/**
 * MundialdeSalsa Pro Main JS
 */

document.addEventListener('DOMContentLoaded', () => {
    // Dark Mode Toggle
    const toggle = document.getElementById('dark-mode-toggle');
    const sunIcon = document.getElementById('sun-icon');
    const moonIcon = document.getElementById('moon-icon');
    
    if (toggle && sunIcon && moonIcon) {
        const updateIcons = (isDark) => {
            if (isDark) {
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            } else {
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            }
        };

        const isDark = document.documentElement.classList.contains('dark');
        updateIcons(isDark);

        toggle.addEventListener('click', () => {
            const isNowDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('mds_theme', isNowDark ? 'dark' : 'light');
            updateIcons(isNowDark);
        });
    }

    // Reading Progress Bar
    const progressBar = document.getElementById('reading-progress-bar');
    if (progressBar) {
        window.addEventListener('scroll', () => {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            progressBar.style.width = scrolled + "%";
        });
    }

    // Live Search
    const searchInput = document.getElementById('live-search-input');
    const searchResults = document.getElementById('live-search-results');
    
    if (searchInput && searchResults) {
        searchInput.addEventListener('input', (e) => {
            const query = e.target.value;
            if (query.length < 3) {
                searchResults.innerHTML = '';
                return;
            }
            
            fetch(mds_pro_vars.ajax_url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'mds_pro_search',
                    query: query,
                    nonce: mds_pro_vars.nonce,
                }),
            })
            .then(res => res.text())
            .then(data => {
                searchResults.innerHTML = data;
            });
        });
    }

    // Load More
    const loadMoreBtn = document.getElementById('load-more-btn');
    const postsContainer = document.getElementById('posts-container');
    let page = 1;
    
    if (loadMoreBtn && postsContainer) {
        loadMoreBtn.addEventListener('click', () => {
            loadMoreBtn.textContent = 'Cargando...';
            loadMoreBtn.disabled = true;
            
            fetch(mds_pro_vars.ajax_url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'mds_pro_load_more',
                    page: page,
                }),
            })
            .then(res => res.text())
            .then(data => {
                if (data.trim() === '') {
                    loadMoreBtn.textContent = 'No hay más artículos';
                    loadMoreBtn.disabled = true;
                } else {
                    postsContainer.insertAdjacentHTML('beforeend', data);
                    page++;
                    loadMoreBtn.textContent = 'Cargar más';
                    loadMoreBtn.disabled = false;
                }
            });
        });
    }
});
