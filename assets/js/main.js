/**
 * MundialdeSalsa Magazine Pro - Main JS
 */

document.addEventListener('DOMContentLoaded', function() {
    // Dark Mode Toggle
    const darkModeToggle = document.querySelector('.dark-mode-toggle');
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            const isDark = document.body.classList.contains('dark-mode');
            localStorage.setItem('mds_dark_mode', isDark ? 'enabled' : 'disabled');
        });
    }

    // Sticky Header
    const header = document.getElementById('masthead');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 100) {
            header.classList.add('is-sticky');
        } else {
            header.classList.remove('is-sticky');
        }
    });

    // Infinite Scroll
    const loadMoreBtn = document.getElementById('load-more');
    if (loadMoreBtn) {
        let page = 1;
        loadMoreBtn.addEventListener('click', function() {
            const btn = this;
            btn.disabled = true;
            btn.textContent = 'Loading...';

            const formData = new FormData();
            formData.append('action', 'mds_infinite_scroll');
            formData.append('page', page);
            formData.append('query', mds_pro_vars.current_query);

            fetch(mds_pro_vars.ajax_url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim().length > 0) {
                    document.querySelector('.archive-layout-wrapper .row').insertAdjacentHTML('beforeend', data);
                    page++;
                    btn.disabled = false;
                    btn.textContent = 'Load More';
                } else {
                    btn.remove();
                }
            });
        });
    }
});
