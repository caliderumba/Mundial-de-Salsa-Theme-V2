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
    const progressBar = document.getElementById('reading-progress');
    if (progressBar) {
        window.addEventListener('scroll', () => {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            progressBar.style.width = scrolled + "%";
        });
    }

    // --- Smooth Scroll for Internal Links ---
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

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

    // --- Load More with Skeleton Screens ---
    const loadMoreBtn = document.getElementById('load-more-btn');
    const postsContainer = document.getElementById('posts-container');
    let page = 1;
    
    const skeletonHTML = `
        <div class="skeleton-post mb-12 pb-12 border-b border-slate-100 dark:border-slate-800 relative overflow-hidden">
            <div class="skeleton-shimmer absolute inset-0 bg-gradient-to-r from-transparent via-white/20 dark:via-slate-700/20 to-transparent -translate-x-full animate-shimmer"></div>
            <div class="h-8 bg-slate-200 dark:bg-slate-800 rounded w-3/4 mb-4"></div>
            <div class="flex gap-4 mb-6">
                <div class="h-3 bg-slate-200 dark:bg-slate-800 rounded w-20"></div>
                <div class="h-3 bg-slate-200 dark:bg-slate-800 rounded w-20"></div>
            </div>
            <div class="h-64 bg-slate-200 dark:bg-slate-800 rounded-2xl mb-8"></div>
            <div class="space-y-3">
                <div class="h-4 bg-slate-200 dark:bg-slate-800 rounded w-full"></div>
                <div class="h-4 bg-slate-200 dark:bg-slate-800 rounded w-5/6"></div>
                <div class="h-4 bg-slate-200 dark:bg-slate-800 rounded w-4/6"></div>
            </div>
        </div>
    `;

    // Add shimmer animation to Tailwind
    const style = document.createElement('style');
    style.textContent = `
        @keyframes shimmer {
            100% { transform: translateX(100%); }
        }
        .animate-shimmer {
            animation: shimmer 1.5s infinite;
        }
    `;
    document.head.appendChild(style);

    if (loadMoreBtn && postsContainer) {
        loadMoreBtn.addEventListener('click', () => {
            loadMoreBtn.classList.add('opacity-0', 'pointer-events-none');
            
            // Add 2 skeletons
            postsContainer.insertAdjacentHTML('beforeend', skeletonHTML + skeletonHTML);
            
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
                // Remove skeletons
                const skeletons = postsContainer.querySelectorAll('.skeleton-post');
                skeletons.forEach(s => s.remove());

                if (data.trim() === '') {
                    loadMoreBtn.textContent = 'No hay más artículos';
                    loadMoreBtn.classList.remove('opacity-0', 'pointer-events-none');
                    loadMoreBtn.disabled = true;
                } else {
                    postsContainer.insertAdjacentHTML('beforeend', data);
                    page++;
                    loadMoreBtn.classList.remove('opacity-0', 'pointer-events-none');
                    
                    // Re-init features for new posts
                    initFavorites();
                    initReactions();
                }
            });
        });
    }

    // --- Favoritos (Save for Later) ---
    const initFavorites = () => {
        const favoriteBtns = document.querySelectorAll('.favorite-btn');
        const favoritesCount = document.getElementById('favorites-count');
        let favorites = JSON.parse(localStorage.getItem('mds_favorites') || '[]');

        const updateCounter = () => {
            if (favoritesCount) {
                const count = favorites.length;
                favoritesCount.textContent = count;
                if (count > 0) {
                    favoritesCount.classList.remove('opacity-0');
                    favoritesCount.classList.add('opacity-100');
                } else {
                    favoritesCount.classList.add('opacity-0');
                    favoritesCount.classList.remove('opacity-100');
                }
            }
        };

        updateCounter();

        favoriteBtns.forEach(btn => {
            const postId = btn.dataset.postId;
            const icon = btn.querySelector('.favorite-icon');
            const text = btn.querySelector('.favorite-text');
            
            const isFavorited = favorites.includes(postId);
            if (isFavorited) {
                icon.classList.add('fill-rose-500', 'text-rose-500');
                if (text) text.textContent = text.textContent.includes('Favoritos') ? 'En Favoritos' : 'Guardado';
            }

            // Remove old listener to avoid duplicates
            btn.onclick = null; 
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                
                favorites = JSON.parse(localStorage.getItem('mds_favorites') || '[]');
                const index = favorites.indexOf(postId);
                
                if (index > -1) {
                    favorites.splice(index, 1);
                    icon.classList.remove('fill-rose-500', 'text-rose-500');
                    if (text) text.textContent = text.textContent.includes('Favoritos') ? 'Guardar en Favoritos' : 'Guardar';
                } else {
                    favorites.push(postId);
                    icon.classList.add('fill-rose-500', 'text-rose-500');
                    if (text) text.textContent = text.textContent.includes('Favoritos') ? 'En Favoritos' : 'Guardado';
                    
                    // Small animation
                    icon.classList.add('scale-125');
                    setTimeout(() => icon.classList.remove('scale-125'), 200);
                }
                
                localStorage.setItem('mds_favorites', JSON.stringify(favorites));
                updateCounter();
            });
        });
    };

    // --- Reacciones (Micro-interactions) ---
    const initReactions = () => {
        const reactionBtns = document.querySelectorAll('.reaction-btn');
        let userReactions = JSON.parse(localStorage.getItem('mds_reactions') || '{}');

        reactionBtns.forEach(btn => {
            const postId = btn.closest('[data-post-id]').dataset.postId;
            const reactionType = btn.dataset.reaction;
            
            const applyStyles = (isActive) => {
                const ringColor = reactionType === 'salsa' ? 'ring-emerald-500' : (reactionType === 'fuego' ? 'ring-orange-500' : 'ring-indigo-500');
                const bgColor = reactionType === 'salsa' ? 'bg-emerald-50' : (reactionType === 'fuego' ? 'bg-orange-50' : 'bg-indigo-50');
                const darkBgColor = reactionType === 'salsa' ? 'dark:bg-emerald-900/20' : (reactionType === 'fuego' ? 'dark:bg-orange-900/20' : 'dark:bg-indigo-900/20');
                
                if (isActive) {
                    btn.classList.add('ring-2', ringColor, bgColor, darkBgColor);
                } else {
                    btn.classList.remove('ring-2', 'ring-emerald-500', 'bg-emerald-50', 'dark:bg-emerald-900/20', 'ring-orange-500', 'bg-orange-50', 'dark:bg-orange-900/20', 'ring-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-900/20');
                }
            };

            const hasReacted = userReactions[postId] === reactionType;
            if (hasReacted) {
                applyStyles(true);
            }

            btn.onclick = null;
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                
                userReactions = JSON.parse(localStorage.getItem('mds_reactions') || '{}');
                
                const currentReaction = userReactions[postId];
                
                // Remove active state from all siblings
                const siblings = btn.closest('.post-reactions').querySelectorAll('.reaction-btn');
                siblings.forEach(s => s.classList.remove('ring-2', 'ring-emerald-500', 'bg-emerald-50', 'dark:bg-emerald-900/20', 'ring-orange-500', 'bg-orange-50', 'dark:bg-orange-900/20', 'ring-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-900/20'));

                if (currentReaction === reactionType) {
                    // Toggle off
                    delete userReactions[postId];
                    applyStyles(false);
                } else {
                    // Toggle on or switch
                    userReactions[postId] = reactionType;
                    applyStyles(true);
                    
                    // Scaling animation
                    const icon = btn.querySelector('span');
                    icon.classList.add('scale-150');
                    setTimeout(() => icon.classList.remove('scale-150'), 300);
                }
                
                localStorage.setItem('mds_reactions', JSON.stringify(userReactions));
            });
        });
    };

    initFavorites();
    initReactions();

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
            if (playlistUrl.includes('/embed/')) {
                embedUrl = playlistUrl;
            } else {
                embedUrl = playlistUrl.replace('open.spotify.com/', 'open.spotify.com/embed/');
            }
        } else if (playlistUrl.includes('soundcloud.com')) {
            if (playlistUrl.includes('w.soundcloud.com/player')) {
                embedUrl = playlistUrl;
            } else {
                embedUrl = `https://w.soundcloud.com/player/?url=${encodeURIComponent(playlistUrl)}&color=%2310b981&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true`;
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

    // --- Header & Search Logic ---
    const initHeader = () => {
        const header = document.getElementById('masthead');
        const searchOverlay = document.getElementById('search-overlay');
        const searchTriggers = document.querySelectorAll('.search-trigger');
        const searchClose = document.getElementById('search-close');
        const searchInput = document.getElementById('search-input');
        const searchResults = document.getElementById('search-results-container');
        const mobileMenuTrigger = document.getElementById('mobile-menu-trigger');
        const sidePanelClose = document.getElementById('side-panel-close');
        const sidePanelOverlay = document.getElementById('side-panel-overlay');

        // Side Panel Toggle - Vanilla JS
        const toggleSidePanel = (show) => {
            if (show) {
                document.body.classList.add('panel-open');
                mobileMenuTrigger?.setAttribute('aria-expanded', 'true');
                sidePanel?.setAttribute('aria-hidden', 'false');
                sidePanelOverlay?.setAttribute('aria-hidden', 'false');
                setTimeout(() => sidePanelClose?.focus(), 100);
            } else {
                document.body.classList.remove('panel-open');
                mobileMenuTrigger?.setAttribute('aria-expanded', 'false');
                sidePanel?.setAttribute('aria-hidden', 'true');
                sidePanelOverlay?.setAttribute('aria-hidden', 'true');
                mobileMenuTrigger?.focus();
            }
        };

        mobileMenuTrigger?.addEventListener('click', (e) => {
            e.preventDefault();
            toggleSidePanel(true);
        });

        sidePanelClose?.addEventListener('click', () => toggleSidePanel(false));
        sidePanelOverlay?.addEventListener('click', () => toggleSidePanel(false));

        // Mobile Accordion Toggle
        const accordionItems = document.querySelectorAll('.mobile-accordion-nav .menu-item-has-children > a');
        accordionItems.forEach(item => {
            const arrow = document.createElement('span');
            arrow.innerHTML = '<i class="fa-solid fa-chevron-down ml-auto text-[10px] transition-transform duration-300"></i>';
            arrow.className = 'flex items-center ml-auto';
            item.classList.add('flex', 'items-center', 'justify-between');
            item.appendChild(arrow);

            item.addEventListener('click', (e) => {
                if (window.innerWidth < 1024) {
                    e.preventDefault();
                    const subMenu = item.nextElementSibling;
                    const icon = arrow.querySelector('i');
                    
                    if (subMenu && subMenu.classList.contains('sub-menu')) {
                        const isOpen = subMenu.classList.contains('open');
                        
                        // Close others
                        const allSubMenus = document.querySelectorAll('.mobile-accordion-nav .sub-menu');
                        const allIcons = document.querySelectorAll('.mobile-accordion-nav .menu-item-has-children i');
                        allSubMenus.forEach(sm => sm.classList.remove('open', 'block'));
                        allSubMenus.forEach(sm => sm.style.display = 'none');
                        allIcons.forEach(i => i.classList.remove('rotate-180'));

                        if (!isOpen) {
                            subMenu.classList.add('open', 'block');
                            subMenu.style.display = 'block';
                            icon.classList.add('rotate-180');
                        }
                    }
                }
            });
        });

        // Sticky Header
        if (header && header.classList.contains('sticky-header')) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 100) {
                    header.classList.add('header-scrolled', 'bg-white/95', 'dark:bg-slate-950/95', 'shadow-xl', 'backdrop-blur-md');
                    header.classList.remove('bg-white', 'dark:bg-slate-950');
                } else {
                    header.classList.remove('header-scrolled', 'bg-white/95', 'dark:bg-slate-950/95', 'shadow-xl', 'backdrop-blur-md');
                    header.classList.add('bg-white', 'dark:bg-slate-950');
                }
            });
        }

        // Search Overlay Toggle
        const toggleSearch = (show) => {
            if (show) {
                searchOverlay.classList.remove('opacity-0', 'pointer-events-none');
                searchOverlay.classList.add('opacity-100', 'pointer-events-auto');
                setTimeout(() => searchInput.focus(), 100);
                document.body.style.overflow = 'hidden';
            } else {
                searchOverlay.classList.add('opacity-0', 'pointer-events-none');
                searchOverlay.classList.remove('opacity-100', 'pointer-events-auto');
                document.body.style.overflow = '';
            }
        };

        searchTriggers.forEach(trigger => {
            trigger.addEventListener('click', (e) => {
                e.preventDefault();
                toggleSearch(true);
            });
        });

        searchClose?.addEventListener('click', () => toggleSearch(false));

        // Close on ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && searchOverlay.classList.contains('opacity-100')) {
                toggleSearch(false);
            }
        });

        // AJAX Search in Overlay
        let searchTimeout;
        searchInput?.addEventListener('input', (e) => {
            clearTimeout(searchTimeout);
            const query = e.target.value;

            if (query.length < 3) {
                searchResults.innerHTML = '';
                return;
            }

            searchTimeout = setTimeout(() => {
                searchResults.innerHTML = '<div class="flex justify-center py-12"><div class="w-12 h-12 border-4 border-emerald-500 border-t-transparent rounded-full animate-spin"></div></div>';
                
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
            }, 300);
        });
    };

    initHeader();

    // --- Mega Menu Accessibility ---
    const initMegaMenu = () => {
        const megaMenuItems = document.querySelectorAll('.mega-menu-item');
        
        megaMenuItems.forEach(item => {
            const link = item.querySelector('a');
            
            item.addEventListener('mouseenter', () => {
                item.setAttribute('aria-expanded', 'true');
            });
            
            item.addEventListener('mouseleave', () => {
                item.setAttribute('aria-expanded', 'false');
            });

            // Keyboard support
            link?.addEventListener('focus', () => {
                item.setAttribute('aria-expanded', 'true');
            });

            link?.addEventListener('blur', (e) => {
                // Only close if focus moved outside the item
                if (!item.contains(e.relatedTarget)) {
                    item.setAttribute('aria-expanded', 'false');
                }
            });
        });
    };

    initMegaMenu();

    // --- Scroll to Top ---
    const initScrollToTop = () => {
        const scrollBtn = document.getElementById('scroll-to-top');
        if (!scrollBtn) return;

        window.addEventListener('scroll', () => {
            if (window.scrollY > 500) {
                scrollBtn.classList.remove('opacity-0', 'invisible', 'translate-y-10');
            } else {
                scrollBtn.classList.add('opacity-0', 'invisible', 'translate-y-10');
            }
        });

        scrollBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    };

    initScrollToTop();

    // --- Copy Link to Clipboard ---
    const initCopyLink = () => {
        const copyBtn = document.getElementById('mds-copy-link');
        if (!copyBtn) return;

        const copyText = copyBtn.querySelector('.copy-text');
        const originalText = copyText.textContent;
        const url = copyBtn.getAttribute('data-url');

        copyBtn.addEventListener('click', () => {
            navigator.clipboard.writeText(url).then(() => {
                copyText.textContent = '¡Copiado!';
                copyBtn.classList.add('bg-emerald-500', 'text-white');
                
                setTimeout(() => {
                    copyText.textContent = originalText;
                    copyBtn.classList.remove('bg-emerald-500', 'text-white');
                }, 2000);
            });
        });
    };

    initCopyLink();
});
