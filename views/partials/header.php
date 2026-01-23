<!-- Header -->
<header id="main-header"
    class="bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 transition-all duration-300 z-50 w-full relative">
    <!-- Utility Bar -->
    <div
        class="bg-slate-50 dark:bg-slate-950 border-b border-slate-100 dark:border-slate-800 py-1.5 hidden md:block">
        <div
            class="container mx-auto px-4 flex justify-between items-center text-[11px] text-slate-500 dark:text-slate-400 font-medium">
            <div class="flex items-center gap-6">
                <span class="flex items-center gap-1.5"><i data-lucide="calendar" width="13"></i> <span
                        id="current-date"></span></span>
                <span class="flex items-center gap-1.5"><i data-lucide="clock" width="13"></i> بروزرسانی:
                    ۱۴:۳۵</span>
            </div>
            <div class="flex items-center gap-6">
                <a href="#" class="hover:text-rose-600 transition-colors">درباره ما</a>
                <a href="#" class="hover:text-rose-600 transition-colors">تماس با ما</a>
                <div class="flex items-center gap-4 pr-4 border-r border-slate-300 dark:border-slate-700">
                    <i data-lucide="instagram" width="13" class="cursor-pointer hover:text-rose-600"></i>
                    <i data-lucide="twitter" width="13" class="cursor-pointer hover:text-rose-600"></i>
                    <i data-lucide="linkedin" width="13" class="cursor-pointer hover:text-rose-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Branding & Navigation Bar -->
    <div class="container mx-auto px-4 py-2 md:py-3 flex items-center justify-between gap-8">
        <div class="flex items-center gap-10 lg:gap-14">
            <!-- Logo -->
            <div class="flex items-center shrink-0">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logona (1) copy.webp" alt="نماد اقتصاد"
                    class="h-[50px] md:h-[70px] w-auto object-contain dark:brightness-0 dark:invert" />
            </div>

            <!-- Desktop Nav -->
            <?php
            wp_nav_menu([
                'theme_location' => 'header_main',
                'container'      => 'nav',
                'container_class'=> 'hidden lg:block',
                'menu_class'     => 'flex items-center',
                'fallback_cb'    => false,
                'walker'         => new Hasht_Header_Walker(),
                'depth'          => 2,
            ]);
            ?>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center gap-2 md:gap-3">
            <button
                class="flex p-2.5 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-300 transition-colors">
                <i data-lucide="search" width="22"></i>
            </button>

            <button id="theme-toggle"
                class="p-2.5 rounded-full hover:text-rose-600 dark:hover:text-rose-600 text-slate-600 dark:text-slate-300 transition-colors">
                <i data-lucide="moon" width="22" stroke-width="1.5" id="theme-icon-moon"></i>
                <i data-lucide="sun" width="22" stroke-width="1.5" id="theme-icon-sun" class="hidden"></i>
            </button>

            <button id="menu-toggle"
                class="flex p-2 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-full transition-colors">
                <i data-lucide="menu" width="28"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <nav id="mobile-menu"
        class="fixed inset-y-0 right-0 w-80 bg-white dark:bg-slate-900 border-r border-slate-100 dark:border-slate-800 shadow-2xl transition-transform duration-300 z-[100] translate-x-full">
        <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center">
            <img src="https://namadeghtesad.ir/wp-content/uploads/2023/12/logona.png" alt="نماد اقتصاد"
                class="h-10 dark:brightness-0 dark:invert" />
            <button id="menu-close"><i data-lucide="x" width="24"></i></button>
        </div>
        <ul class="flex flex-col p-4">
            <li class="border-b border-slate-50 last:border-none"><a href="#"
                    class="block py-4 px-6 text-lg font-normal text-slate-700 dark:text-slate-300 hover:text-rose-600">صفحه
                    اصلی</a></li>
            <li class="border-b border-slate-50 last:border-none"><a href="#"
                    class="block py-4 px-6 text-lg font-normal text-slate-700 dark:text-slate-300 hover:text-rose-600">اقتصاد
                    کلان</a></li>
            <li class="border-b border-slate-50 last:border-none"><a href="#"
                    class="block py-4 px-6 text-lg font-normal text-slate-700 dark:text-slate-300 hover:text-rose-600">صنعت
                    و معدن</a></li>
            <li class="border-b border-slate-50 last:border-none"><a href="#"
                    class="block py-4 px-6 text-lg font-normal text-slate-700 dark:text-slate-300 hover:text-rose-600">بانک
                    و بیمه</a></li>
            <li class="border-b border-slate-50 last:border-none"><a href="#"
                    class="block py-4 px-6 text-lg font-normal text-slate-700 dark:text-slate-300 hover:text-rose-600">بورس</a>
            </li>
            <li class="border-b border-slate-50 last:border-none"><a href="#"
                    class="block py-4 px-6 text-lg font-normal text-slate-700 dark:text-slate-300 hover:text-rose-600">انرژی</a>
            </li>
            <li class="border-b border-slate-50 last:border-none"><a href="#"
                    class="block py-4 px-6 text-lg font-normal text-slate-700 dark:text-slate-300 hover:text-rose-600">خودرو</a>
            </li>
        </ul>
    </nav>
</header>

<!-- News Ticker -->
<?php core_view('partials/news-ticker'); ?>
