/**
 * MundialdeSalsa Pro - App JS
 * Organizado para evitar FOUC y manejar interactividad.
 */

// 1. Tailwind Config (Debe ejecutarse antes de que Tailwind procese el DOM)
if (window.tailwind) {
    tailwind.config = {
        darkMode: 'class',
        theme: {
            extend: {
                fontFamily: {
                    sans: ['Inter', 'sans-serif'],
                    serif: ['Cormorant Garamond', 'serif'],
                },
                colors: {
                    emerald: {
                        50: '#ecfdf5',
                        100: '#d1fae5',
                        200: '#a7f3d0',
                        300: '#6ee7b7',
                        400: '#34d399',
                        500: '#10b981',
                        600: '#059669',
                        700: '#047857',
                        800: '#065f46',
                        900: '#064e3b',
                    },
                }
            }
        }
    };
}

// 2. Dark Mode Initialization (Inmediato para evitar parpadeo)
(function() {
    const theme = localStorage.getItem('mds_theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
    }
})();

// 3. Main Interactivity
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

    // 4. Mini-Reproductor Flotante
    const initFloatingPlayer = () => {
        const player = document.getElementById('floating-player');
        const container = document.getElementById('player-container');
        const iframe = document.getElementById('player-iframe');
        const toggle = document.getElementById('player-toggle');
        const closeBtn = document.getElementById('player-close');
        const iconPlay = document.getElementById('icon-play');
        const iconClose = document.getElementById('icon-close');
        
        const playlistUrl = document.body.getAttribute('data-playlist');
        
        if (!playlistUrl || !player) return;

        // Parse URL to get Embed URL
        let embedUrl = '';
        if (playlistUrl.includes('spotify.com')) {
            embedUrl = playlistUrl.replace('open.spotify.com/', 'open.spotify.com/embed/');
            if (!embedUrl.includes('/embed/')) {
                embedUrl = embedUrl.replace('spotify.com/', 'spotify.com/embed/');
            }
        } else if (playlistUrl.includes('youtube.com') || playlistUrl.includes('youtu.be')) {
            let videoId = '';
            if (playlistUrl.includes('youtube.com/watch?v=')) {
                try {
                    videoId = new URLSearchParams(new URL(playlistUrl).search).get('v');
                } catch(e) {}
            } else if (playlistUrl.includes('youtu.be/')) {
                videoId = playlistUrl.split('youtu.be/')[1].split('?')[0];
            } else if (playlistUrl.includes('youtube.com/embed/')) {
                videoId = playlistUrl.split('youtube.com/embed/')[1].split('?')[0];
            }
            
            if (videoId) {
                embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=0&rel=0`;
            }
        }

        if (embedUrl) {
            iframe.src = embedUrl;
            player.classList.remove('translate-y-20', 'opacity-0', 'pointer-events-none');
        }

        let isOpen = false;

        const togglePlayer = () => {
            isOpen = !isOpen;
            if (isOpen) {
                container.classList.remove('max-h-0');
                container.classList.add('max-h-[500px]');
                iconPlay.classList.add('opacity-0', 'scale-0', 'rotate-180');
                iconClose.classList.remove('opacity-0', 'scale-0');
                iconClose.classList.add('opacity-100', 'scale-100');
            } else {
                container.classList.add('max-h-0');
                container.classList.remove('max-h-[500px]');
                iconPlay.classList.remove('opacity-0', 'scale-0', 'rotate-180');
                iconClose.classList.add('opacity-0', 'scale-0');
                iconClose.classList.remove('opacity-100', 'scale-100');
            }
        };

        toggle?.addEventListener('click', togglePlayer);
        closeBtn?.addEventListener('click', () => {
            isOpen = true; // Force toggle to close
            togglePlayer();
        });
    };

    initFloatingPlayer();
});
