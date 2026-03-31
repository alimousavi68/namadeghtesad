/**
 * Theme JS
 * Global functionalities for the theme.
 */
(function($) {
    console.log('Hasht Theme JS Loaded');

    // Initialize Icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // --- Sidebar Logic ---
    window.openSidebar = function() {
        const sidebar = document.getElementById('hasht-mobile-sidebar');
        const overlay = document.getElementById('hasht-mobile-sidebar-overlay');
        if(sidebar && overlay) {
            sidebar.classList.remove('translate-x-full');
            overlay.classList.remove('opacity-0', 'invisible');
        }
    }

    window.closeSidebar = function() {
        const sidebar = document.getElementById('hasht-mobile-sidebar');
        const overlay = document.getElementById('hasht-mobile-sidebar-overlay');
        if(sidebar && overlay) {
            sidebar.classList.add('translate-x-full');
            overlay.classList.add('opacity-0', 'invisible');
        }
    }

    // --- Theme Logic (Dark/Light Mode) ---
    window.toggleTheme = function() {
        let isDarkMode = document.body.classList.contains('dark');
        const body = document.body;
        const themeSun = document.getElementById('theme-sun');
        const themeMoon = document.getElementById('theme-moon');
        isDarkMode = !isDarkMode;
        if (isDarkMode) {
            body.classList.add('dark');
            localStorage.setItem('hasht_theme', 'dark');
            if(themeSun) {
                themeSun.classList.remove('bg-white', 'shadow-sm', 'text-yellow-500');
                themeSun.classList.add('text-gray-400');
            }
            if(themeMoon) {
                themeMoon.classList.remove('text-gray-400');
                themeMoon.classList.add('bg-blue-600', 'shadow-sm', 'text-white');
            }
        } else {
            body.classList.remove('dark');
            localStorage.setItem('hasht_theme', 'light');
            if(themeSun) {
                themeSun.classList.add('bg-white', 'shadow-sm', 'text-yellow-500');
                themeSun.classList.remove('text-gray-400');
            }
            if(themeMoon) {
                themeMoon.classList.add('text-gray-400');
                themeMoon.classList.remove('bg-blue-600', 'shadow-sm', 'text-white');
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const saved = localStorage.getItem('hasht_theme');
        const body = document.body;
        const themeSun = document.getElementById('theme-sun');
        const themeMoon = document.getElementById('theme-moon');
        if (saved === 'dark') {
            body.classList.add('dark');
            if(themeSun) {
                themeSun.classList.add('text-gray-400');
                themeSun.classList.remove('bg-white', 'shadow-sm', 'text-yellow-500');
            }
            if(themeMoon) {
                themeMoon.classList.add('bg-blue-600', 'shadow-sm', 'text-white');
                themeMoon.classList.remove('text-gray-400');
            }
        } else {
            body.classList.remove('dark');
            if(themeSun) {
                themeSun.classList.add('bg-white', 'shadow-sm', 'text-yellow-500');
                themeSun.classList.remove('text-gray-400');
            }
            if(themeMoon) {
                themeMoon.classList.add('text-gray-400');
                themeMoon.classList.remove('bg-blue-600', 'shadow-sm', 'text-white');
            }
        }
    });

    document.addEventListener('click', function(e) {
        const btn = e.target.closest('[data-scroll-to]');
        if (!btn) return;
        const id = btn.getAttribute('data-scroll-to');
        if (!id) return;
        const el = document.getElementById(id);
        if (!el) return;
        e.preventDefault();
        const setActiveCompanyNav = (targetBtn) => {
            document.querySelectorAll('[data-scroll-to]').forEach((b) => {
                b.classList.remove('bg-rose-50', 'text-rose-700', 'border-rose-200', 'dark:bg-rose-900/20', 'dark:text-rose-200', 'dark:border-rose-900/30');
                b.querySelectorAll('svg').forEach((svg) => svg.classList.remove('text-rose-600', 'dark:text-rose-200'));
            });
            targetBtn.classList.add('bg-rose-50', 'text-rose-700', 'border-rose-200', 'dark:bg-rose-900/20', 'dark:text-rose-200', 'dark:border-rose-900/30');
            targetBtn.querySelectorAll('svg').forEach((svg) => svg.classList.add('text-rose-600', 'dark:text-rose-200'));
        };
        setActiveCompanyNav(btn);
        const header = document.getElementById('main-header');
        const headerOffset = header ? header.getBoundingClientRect().height : 0;
        const top = el.getBoundingClientRect().top + window.scrollY - headerOffset - 24;
        window.scrollTo({ top: Math.max(0, top), behavior: 'smooth' });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('#company-basic, #company-intro, #company-description, #company-products, #company-posts');
        if (!sections.length || typeof IntersectionObserver === 'undefined') {
            return;
        }
        const setActiveCompanyNavById = (id) => {
            const btn = document.querySelector('[data-scroll-to="' + id + '"]');
            if (!btn) return;
            document.querySelectorAll('[data-scroll-to]').forEach((b) => {
                b.classList.remove('bg-rose-50', 'text-rose-700', 'border-rose-200', 'dark:bg-rose-900/20', 'dark:text-rose-200', 'dark:border-rose-900/30');
                b.querySelectorAll('svg').forEach((svg) => svg.classList.remove('text-rose-600', 'dark:text-rose-200'));
            });
            btn.classList.add('bg-rose-50', 'text-rose-700', 'border-rose-200', 'dark:bg-rose-900/20', 'dark:text-rose-200', 'dark:border-rose-900/30');
            btn.querySelectorAll('svg').forEach((svg) => svg.classList.add('text-rose-600', 'dark:text-rose-200'));
        };

        const header = document.getElementById('main-header');
        const headerOffset = header ? header.getBoundingClientRect().height : 0;

        const pickActiveSectionId = () => {
            const line = headerOffset + 24;
            let candidate = null;
            for (const s of sections) {
                const r = s.getBoundingClientRect();
                if (r.top <= line) {
                    candidate = s.id;
                    if (r.bottom > line) {
                        return s.id;
                    }
                    continue;
                }
                break;
            }
            return candidate || (sections[0] && sections[0].id ? sections[0].id : null);
        };

        const applyActiveFromViewport = () => {
            const id = pickActiveSectionId();
            if (!id) return;
            setActiveCompanyNavById(id);
        };

        const observer = new IntersectionObserver(() => {
            applyActiveFromViewport();
        }, {
            root: null,
            rootMargin: `-${headerOffset + 24}px 0px -60% 0px`,
            threshold: [0, 0.1, 0.2],
        });
        sections.forEach((s) => observer.observe(s));

        let ticking = false;
        window.addEventListener('scroll', function() {
            if (ticking) return;
            ticking = true;
            window.requestAnimationFrame(function() {
                ticking = false;
                applyActiveFromViewport();
            });
        }, { passive: true });

        applyActiveFromViewport();
    });

    document.addEventListener('click', function(e) {
        const btn = e.target.closest('[data-toggle-submenu]');
        if (!btn) return;
        const li = btn.closest('li');
        const submenu = li ? li.querySelector('ul') : null;
        if (submenu) {
            const isOpen = !submenu.classList.contains('hidden');
            submenu.classList.toggle('hidden', isOpen);
            btn.setAttribute('aria-expanded', String(!isOpen));
        }
    });

    // --- Sticky Header Logic ---
    let lastScrollY = window.scrollY;
    const header = document.getElementById('main-header');

    // if (header) {
    //     window.addEventListener('scroll', () => {
    //         const currentScrollY = window.scrollY;

    //         if (currentScrollY > lastScrollY && currentScrollY > 100) {
    //             // Scrolling down & past threshold -> Hide
    //             header.classList.add('-translate-y-full');
    //         } else {
    //             // Scrolling up -> Show
    //             header.classList.remove('-translate-y-full');
    //         }

    //         lastScrollY = currentScrollY;
    //     });
    // }

})(jQuery);
