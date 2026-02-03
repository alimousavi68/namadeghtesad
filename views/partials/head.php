<!-- Tailwind CSS (Local) -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/tailwindcss.js"></script>

<!-- Tailwind Config -->
<script>
    if (window.tailwind) {
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['IRANSansX', 'IRANYekanX', 'Vazirmatn', 'sans-serif'],
                    },
                    colors: {
                        primary: 'var(--color-primary)',
                        secondary: 'var(--color-secondary)',
                        background: 'var(--color-background)',
                        text: {
                            main: 'var(--color-text-main)',
                            light: 'var(--color-text-light)',
                        },
                        border: {
                            DEFAULT: 'var(--color-border)',
                        },
                        header: {
                            bg: 'var(--color-header-bg)',
                        },
                        footer: {
                            bg: 'var(--color-footer-bg)',
                        }
                    },
                    animation: {
                        'ticker-scroll': 'ticker-ltr 90s linear infinite',
                        'pulse-heart': 'pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        'ticker-ltr': {
                            '0%': { transform: 'translateX(-50%)' },
                            '100%': { transform: 'translateX(0)' }, 
                        }
                    }
                }
            }
        }
    }
</script>

<!-- Lucide Icons (Local) -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/lucide.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (window.lucide) {
            lucide.createIcons();
        }
    });
</script>

<!-- Standard CSS (Fonts & Scrollbars & Print) -->
<style>
    /* =========================================
       Font Configuration (IRANSansX Variable)
       ========================================= */
    @font-face {
        font-family: 'IRANSansX';
        src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/IRANSansXV.woff2') format('woff2-variations'),
             url('<?php echo get_template_directory_uri(); ?>/assets/fonts/IRANSansXV.woff2') format('woff2');
        font-weight: 100 1000;
        font-style: normal;
        font-display: swap;
    }

    /* =========================================
       Ticker Animation Fallback (if Tailwind fails)
       ========================================= */
    @keyframes ticker-ltr {
        0% { transform: translateX(-50%); }
        100% { transform: translateX(0); }
    }
    .animate-ticker-scroll {
        animation: ticker-ltr 90s linear infinite;
    }

    /* =========================================
       Scrollbar Customization
       ========================================= */
    /* Hide Scrollbar (Cross-browser) */
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }

    /* Custom Gray Scrollbar */
    .custom-scroll::-webkit-scrollbar {
        width: 5px;
    }

    .custom-scroll::-webkit-scrollbar-track {
        background: transparent;
    }
    
    .custom-scroll::-webkit-scrollbar-thumb {
        background-color: #cbd5e1;
        border-radius: 20px;
    }

    /* =========================================
       Global Styles
       ========================================= */
    body {
        font-family: 'IRANSansX', sans-serif;
    }
</style>