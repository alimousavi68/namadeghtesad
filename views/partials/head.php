<!-- Lucide Icons (Local) -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/lucide.js"></script>

<!-- Standard CSS (Fonts & Scrollbars & Print) -->
<style>
    /* =========================================
       Font Configuration (IRANYekanX Variable)
       ========================================= */
    @font-face {
        font-family: 'IRANYekanX';
        src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/IRANYekanX/IRANYekanXVF.woff2') format('woff2-variations'),
             url('<?php echo get_template_directory_uri(); ?>/assets/fonts/IRANYekanX/IRANYekanXVF.woff2') format('woff2');
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
