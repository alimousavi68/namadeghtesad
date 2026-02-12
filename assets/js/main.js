document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM fully loaded, initializing scripts...');
    
    // Initialize Lucide Icons (handled in head.php for faster render, but re-run here just in case of dynamic content)
    if (window.lucide) {
        lucide.createIcons();
    }

    // Set Current Date
    const currentDateElem = document.getElementById('current-date');
    if (currentDateElem) {
        const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        currentDateElem.textContent = new Date().toLocaleDateString('fa-IR', dateOptions);
    }

    // Dark Mode Logic
    const themeToggleBtn = document.getElementById('theme-toggle');
    const sunIcon = document.getElementById('theme-icon-sun');
    const moonIcon = document.getElementById('theme-icon-moon');
    const htmlRoot = document.documentElement;

    // Check local storage
    if (localStorage.getItem('theme') === 'dark') {
        htmlRoot.classList.add('dark');
        if (sunIcon) sunIcon.classList.remove('hidden');
        if (moonIcon) moonIcon.classList.add('hidden');
    } else {
        htmlRoot.classList.remove('dark');
        if (sunIcon) sunIcon.classList.add('hidden');
        if (moonIcon) moonIcon.classList.remove('hidden');
    }

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            htmlRoot.classList.toggle('dark');
            if (htmlRoot.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
                if (sunIcon) sunIcon.classList.remove('hidden');
                if (moonIcon) moonIcon.classList.add('hidden');
            } else {
                localStorage.setItem('theme', 'light');
                if (sunIcon) sunIcon.classList.add('hidden');
                if (moonIcon) moonIcon.classList.remove('hidden');
            }
        });
    }

    // Mobile Menu Logic
    const menuToggle = document.getElementById('menu-toggle');
    const menuClose = document.getElementById('menu-close');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileOverlay = document.getElementById('mobile-menu-overlay');

    function toggleMenu() {
        if (mobileMenu) {
            mobileMenu.classList.toggle('translate-x-full');
            mobileMenu.classList.toggle('translate-x-0');
            
            if (mobileOverlay) {
                mobileOverlay.classList.toggle('opacity-0');
                mobileOverlay.classList.toggle('invisible');
            }
        }
    }

    if (menuToggle) menuToggle.addEventListener('click', toggleMenu);
    if (menuClose) menuClose.addEventListener('click', toggleMenu);
    if (mobileOverlay) mobileOverlay.addEventListener('click', toggleMenu);


    // Back to Top Button Logic
    const backToTopBtn = document.getElementById('back-to-top');
    const progressCircle = document.getElementById('progress-circle');
    // r=23 => 2*pi*r ≈ 144.5
    const circumference = 144.5;

    if (backToTopBtn) {
        const toggleBackToTop = () => {
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            
            // Toggle visibility
            if (scrollTop > 300) {
                backToTopBtn.classList.remove('opacity-0', 'invisible');
            } else {
                backToTopBtn.classList.add('opacity-0', 'invisible');
            }

            // Update progress ring if exists
            if (progressCircle && docHeight > 0) {
                const scrollPercent = scrollTop / docHeight;
                // We want to show progress, so dashoffset goes from circumference (empty) to 0 (full)
                // Offset = circumference - (percent * circumference)
                const offset = circumference - (scrollPercent * circumference);
                progressCircle.style.strokeDashoffset = Math.max(0, offset) + 'px'; // Ensure it doesn't go negative
            }
        };

        window.addEventListener('scroll', toggleBackToTop);
        // Initial check
        toggleBackToTop();

        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Horizontal Scroll for Company Stories
    const scrollContainer = document.getElementById('company-scroll-area');
    const scrollLeftBtn = document.getElementById('scroll-left');
    const scrollRightBtn = document.getElementById('scroll-right');

    if (scrollContainer && scrollLeftBtn && scrollRightBtn) {
        scrollLeftBtn.addEventListener('click', () => {
            scrollContainer.scrollBy({ left: -300, behavior: 'smooth' });
        });

        scrollRightBtn.addEventListener('click', () => {
            scrollContainer.scrollBy({ left: 300, behavior: 'smooth' });
        });
    }

    // Footer Accordion Logic
    const footerButtons = document.querySelectorAll('.footer-accordion button');
    
    footerButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Only active on mobile/tablet (using md breakpoint check via CSS visibility logic)
            if (window.innerWidth >= 768) return;

            const ul = button.nextElementSibling;
            // Lucide replaces <i> with <svg>, so we need to look for svg or i (in case lucide hasn't run yet)
            const icon = button.querySelector('i') || button.querySelector('svg');

            if (ul && icon) {
                // Toggle hidden class
                if (ul.classList.contains('hidden')) {
                    ul.classList.remove('hidden');
                    icon.style.transform = 'rotate(180deg)';
                } else {
                    ul.classList.add('hidden');
                    icon.style.transform = 'rotate(0deg)';
                }
            }
        });
    });

    // Single Page Actions (Comments Scroll & Shortlink Copy)
    const commentsBtn = document.getElementById('scroll-to-comments');
    const commentsSection = document.getElementById('comments');
    
    if (commentsBtn && commentsSection) {
        commentsBtn.addEventListener('click', () => {
            commentsSection.scrollIntoView({ behavior: 'smooth' });
        });
    }

    const shortlinkBtn = document.getElementById('scroll-to-shortlink');
    const shortlinkBox = document.getElementById('short-link-text');

    if (shortlinkBtn && shortlinkBox) {
        shortlinkBtn.addEventListener('click', () => {
            shortlinkBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
            // Highlight effect
            shortlinkBox.parentElement.classList.add('ring-2', 'ring-primary', 'ring-offset-2');
            setTimeout(() => {
                shortlinkBox.parentElement.classList.remove('ring-2', 'ring-primary', 'ring-offset-2');
            }, 2000);
        });
    }

    const copyLinkBtn = document.getElementById('copy-link-btn');
    const toastNotification = document.getElementById('toast-notification');

    if (copyLinkBtn && shortlinkBox) {
        copyLinkBtn.addEventListener('click', () => {
            const linkText = shortlinkBox.innerText;
            navigator.clipboard.writeText(linkText).then(() => {
                // Show toast
                if (toastNotification) {
                    toastNotification.classList.remove('translate-y-20', 'opacity-0');
                    setTimeout(() => {
                        toastNotification.classList.add('translate-y-20', 'opacity-0');
                    }, 3000);
                }
            }).catch(err => {
                console.error('Failed to copy: ', err);
            });
        });
    }

    // Search Modal Logic
    const searchToggle = document.getElementById('search-toggle');
    const searchModal = document.getElementById('search-modal');
    const searchClose = document.getElementById('search-modal-close');

    if (searchToggle && searchModal && searchClose) {
        const toggleSearch = () => {
            searchModal.classList.toggle('opacity-0');
            searchModal.classList.toggle('invisible');
            const input = searchModal.querySelector('input');
            if (!searchModal.classList.contains('invisible') && input) {
                setTimeout(() => input.focus(), 100);
            }
        };

        searchToggle.addEventListener('click', toggleSearch);
        searchClose.addEventListener('click', toggleSearch);
        
        // Close on outside click
        searchModal.addEventListener('click', (e) => {
            if (e.target === searchModal) toggleSearch();
        });
        
        // Close on Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !searchModal.classList.contains('invisible')) {
                toggleSearch();
            }
        });
    }

    // Lightbox Logic
    const galleryItems = document.querySelectorAll('.gallery-item');
    if (galleryItems.length > 0) {
        // Create Lightbox DOM
        const lightbox = document.createElement('div');
        lightbox.id = 'lightbox-modal';
        lightbox.className = 'fixed inset-0 z-[60] bg-black/90 hidden flex items-center justify-center opacity-0 transition-opacity duration-300';
        lightbox.innerHTML = `
            <button id="lightbox-close" class="absolute top-4 left-4 text-white hover:text-primary transition-colors z-[70]">
                <i data-lucide="x" width="32"></i>
            </button>
            <button id="lightbox-prev" class="absolute right-4 top-1/2 -translate-y-1/2 text-white hover:text-primary transition-colors z-[70] hidden md:block">
                <i data-lucide="chevron-right" width="48"></i>
            </button>
            <button id="lightbox-next" class="absolute left-4 top-1/2 -translate-y-1/2 text-white hover:text-primary transition-colors z-[70] hidden md:block">
                <i data-lucide="chevron-left" width="48"></i>
            </button>
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 text-white bg-black/50 px-3 py-1 rounded-full text-sm font-bold z-[70]" id="lightbox-counter"></div>
            <div class="relative max-w-[90vw] max-h-[90vh]">
                <img id="lightbox-img" src="" alt="Full Image" class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl transition-opacity duration-300">
            </div>
        `;
        document.body.appendChild(lightbox);

        // Re-init icons for the new lightbox elements
        if (window.lucide) lucide.createIcons();

        const lightboxImg = document.getElementById('lightbox-img');
        const closeBtn = document.getElementById('lightbox-close');
        const prevBtn = document.getElementById('lightbox-prev');
        const nextBtn = document.getElementById('lightbox-next');
        const counter = document.getElementById('lightbox-counter');
        
        let currentIndex = 0;
        const totalItems = galleryItems.length;

        function updateCounter() {
            if (counter) {
                counter.textContent = `${currentIndex + 1} / ${totalItems}`;
            }
        }

        function openLightbox(index) {
            currentIndex = index;
            const src = galleryItems[index].getAttribute('href');
            lightboxImg.src = src;
            updateCounter();
            lightbox.classList.remove('hidden');
            // Small delay to allow display:block to apply before opacity transition
            setTimeout(() => {
                lightbox.classList.remove('opacity-0');
            }, 10);
            document.body.style.overflow = 'hidden'; // Disable scroll
        }

        function closeLightbox() {
            lightbox.classList.add('opacity-0');
            setTimeout(() => {
                lightbox.classList.add('hidden');
                lightboxImg.src = '';
            }, 300);
            document.body.style.overflow = ''; // Enable scroll
        }

        function showNext() {
            // Fade out
            lightboxImg.classList.add('opacity-0');
            setTimeout(() => {
                currentIndex = (currentIndex + 1) % totalItems;
                const src = galleryItems[currentIndex].getAttribute('href');
                lightboxImg.src = src;
                updateCounter();
                // Fade in
                lightboxImg.classList.remove('opacity-0');
            }, 300);
        }

        function showPrev() {
            // Fade out
            lightboxImg.classList.add('opacity-0');
            setTimeout(() => {
                currentIndex = (currentIndex - 1 + totalItems) % totalItems;
                const src = galleryItems[currentIndex].getAttribute('href');
                lightboxImg.src = src;
                updateCounter();
                // Fade in
                lightboxImg.classList.remove('opacity-0');
            }, 300);
        }

        // Event Listeners
        galleryItems.forEach((item, index) => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                openLightbox(index);
            });
        });

        closeBtn.addEventListener('click', closeLightbox);
        nextBtn.addEventListener('click', (e) => { e.stopPropagation(); showNext(); });
        prevBtn.addEventListener('click', (e) => { e.stopPropagation(); showPrev(); });

        // Click outside to close
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) closeLightbox();
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (lightbox.classList.contains('hidden')) return;
            
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') showNext(); // RTL: Left is Next
            if (e.key === 'ArrowRight') showPrev(); // RTL: Right is Prev
        });
    }

});
