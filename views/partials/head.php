<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Tailwind Config -->
<script>
    tailwind.config = {
        darkMode: 'class',
        theme: {
            extend: {
                fontFamily: {
                    sans: ['IRANSansX', 'IRANYekanX', 'Vazirmatn', 'sans-serif'],
                },
                colors: {
                    primary: {
                        DEFAULT: '#cc2f33', 
                        50: '#fff1f2',
                        100: '#ffe4e6',
                        200: '#fecdd3',
                        300: '#fda4af',
                        400: '#fb7185',
                        500: '#f43f5e',
                        600: '#cc2f33',
                        700: '#be123c',
                        800: '#9f1239',
                        900: '#881337',
                        950: '#4c0519',
                    },
                    secondary: {
                        DEFAULT: '#0f172a',
                        50: '#f8fafc',
                        100: '#f1f5f9',
                        200: '#e2e8f0',
                        300: '#cbd5e1',
                        400: 'rgb(151 161 171)', 
                        500: '#64748b',
                        600: '#475569',
                        700: '#334155',
                        800: '#1e293b',
                        900: '#0f172a',
                        950: '#020617',
                    }
                },
                animation: {
                    'ticker-scroll': 'ticker 72s linear infinite',
                    'pulse-heart': 'pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                },
                keyframes: {
                    ticker: {
                        '0%': { transform: 'translateX(0)' },
                        '100%': { transform: 'translateX(100%)' }, 
                    }
                }
            }
        }
    }
</script>

<!-- Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        lucide.createIcons();
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
        background-color: #cbd5e1; /* slate-300 */
        border-radius: 20px;
    }

    .custom-scroll {
        scrollbar-width: thin;
        scrollbar-color: #cbd5e1 transparent;
    }

    /* =========================================
       Print Styles
       ========================================= */
    @media print {
        @page {
            size: A4 portrait;
            margin: 1cm;
        }

        body {
            background-color: white !important;
            color: black !important;
            font-size: 12pt;
        }
    }
</style>

<!-- Tailwind Custom Styles -->
<style type="text/tailwindcss">
    @layer base {
        body {
            font-family: 'IRANSansX', 'Vazirmatn', sans-serif;
            font-feature-settings: "ss01"; /* Enable Persian numerals */
        }
    }

    @layer components {
        /* Typography */
        .heading-1 {
            @apply text-2xl md:text-3xl font-black text-slate-900 dark:text-white leading-tight;
        }
        .heading-2 {
            @apply text-xl md:text-2xl font-bold text-slate-800 dark:text-slate-100 leading-snug;
        }
        .heading-3 {
            @apply text-lg md:text-xl font-bold text-slate-800 dark:text-slate-100 leading-snug;
        }
        .heading-4 {
            @apply text-base md:text-lg font-bold text-slate-700 dark:text-slate-200 leading-snug;
        }
        .meta-text {
            @apply text-[10px] md:text-xs text-slate-400 dark:text-slate-500 font-medium;
        }
        .body-text {
            @apply text-sm text-slate-600 dark:text-slate-300 leading-relaxed;
        }

        /* UI Components */
        .section-title {
            @apply text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-4;
        }
        .section-indicator {
            @apply w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0;
        }
        .section-indicator-top {
            @apply h-1/3 bg-slate-400;
        }
        .section-indicator-bottom {
            @apply h-2/3 bg-rose-600;
        }
        .btn-icon {
            @apply p-2.5 rounded-full text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors flex items-center justify-center;
        }
        .link-more {
            @apply flex items-center gap-1 text-sm font-bold text-slate-400 dark:text-slate-500 hover:text-rose-600 transition-all;
        }

        /* Archive Specific Styles */
        .news-card-archive {
            @apply transition-all duration-300;
        }
        .news-card-archive:hover .news-title {
            @apply text-rose-600;
        }
        .news-card-archive:hover img {
            @apply scale-110;
        }

        /* Single Page Specific Styles */
        .single-content p {
            @apply mb-6 leading-8 text-justify text-slate-800 dark:text-slate-200 text-lg;
        }
        .single-content h2 {
            @apply text-2xl font-black text-slate-900 dark:text-white mt-8 mb-4 border-r-4 border-rose-600 pr-3;
        }
        .single-content h3 {
            @apply text-xl font-bold text-slate-800 dark:text-slate-100 mt-6 mb-3;
        }
        .single-content ul {
            @apply list-disc list-inside mb-6 space-y-2 text-slate-800 dark:text-slate-200;
        }
        .single-content blockquote {
            @apply relative bg-slate-100 dark:bg-slate-900 dark:border-slate-600 p-8 rounded-lg text-lg font-bold text-slate-800 dark:text-slate-200 my-10 leading-loose text-justify shadow-sm;
        }
        .single-content blockquote::before {
            content: '';
            @apply absolute -top-3 -right-3 w-10 h-10 dark:bg-slate-700 rounded-full flex items-center justify-center ;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z'%3E%3C/path%3E%3Cpath d='M15 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: center;
        }
        .single-content figcaption {
            @apply text-left text-xs text-slate-500 dark:text-slate-400 mt-2 border-l-2 border-slate-300 dark:border-slate-600 pl-3;
        }
        .share-btn {
            @apply w-10 h-10 rounded-full border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-400 hover:text-rose-600 hover:border-rose-600 transition-all bg-white dark:bg-slate-900;
        }

        /* News Cards (From Custom.css) */
        .news-card-v {
            @apply cursor-pointer flex flex-col h-full;
        }
        .news-card-v-img-wrapper {
            @apply aspect-[16/10] overflow-hidden rounded-xl mb-2 shrink-0 shadow-md;
        }
        .news-card-v-img {
            @apply w-full h-full object-cover transition-transform duration-700;
        }
        .group:hover .news-card-v-img {
            @apply scale-110;
        }
        .news-card-v-content {
            @apply flex flex-col flex-1;
        }
        .news-card-v-title {
            @apply text-base font-black text-secondary-800 dark:text-secondary-100 leading-tight mb-2 transition-colors line-clamp-2;
        }
        .group:hover .news-card-v-title {
            @apply text-primary-600;
        }
        
        .news-card-h {
            @apply flex items-center gap-3 py-1 cursor-pointer border-b border-secondary-100 dark:border-secondary-800 last:border-none;
        }
        .news-card-h-img-wrapper {
            @apply w-20 aspect-[3/2] lg:w-28 shrink-0 overflow-hidden rounded-lg shadow-sm;
        }
        .news-card-h-img {
            @apply w-full h-full object-cover transition-transform duration-500;
        }
        .group:hover .news-card-h-img {
            @apply scale-110;
        }
        .news-card-h-content {
            @apply flex flex-col justify-center;
        }
        .news-card-h-title {
            @apply text-sm font-bold text-secondary-800 dark:text-secondary-200 line-clamp-2 leading-snug transition-colors;
        }
        .group:hover .news-card-h-title {
            @apply text-primary-600;
        }

        .news-card-overlay {
             @apply cursor-pointer mb-6 relative overflow-hidden rounded-lg;
        }
        .news-card-overlay-img-wrapper {
             @apply aspect-video rounded-lg overflow-hidden relative;
        }
        .news-card-overlay-img {
             @apply w-full h-full object-cover transition-transform duration-700;
        }
        .group:hover .news-card-overlay-img {
            @apply scale-105;
        }
        .news-card-overlay-content {
             @apply absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-4 pt-12;
        }
        .news-card-overlay-title {
             @apply text-white font-bold text-lg leading-snug transition-colors;
        }
        .group:hover .news-card-overlay-title {
            @apply text-primary-400;
        }
    }
</style>