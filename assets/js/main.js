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
    if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
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

    function toggleMenu() {
        if (mobileMenu) {
            mobileMenu.classList.toggle('translate-x-full');
            mobileMenu.classList.toggle('translate-x-0');
        }
    }

    if (menuToggle) menuToggle.addEventListener('click', toggleMenu);
    if (menuClose) menuClose.addEventListener('click', toggleMenu);

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

    // Back to Top Logic
    const backToTopBtn = document.getElementById('back-to-top');
    const progressCircle = document.getElementById('progress-circle');
    const circumference = 301.59; // 2 * pi * r (r=48)

    if (backToTopBtn && progressCircle) {
        window.addEventListener('scroll', () => {
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = scrollTop / docHeight;
            
            // Toggle visibility
            if (scrollTop > 300) {
                backToTopBtn.classList.remove('opacity-0', 'invisible');
            } else {
                backToTopBtn.classList.add('opacity-0', 'invisible');
            }

            // Update progress ring
            const offset = circumference - (scrollPercent * circumference);
            progressCircle.style.strokeDashoffset = offset;
        });

        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
});
