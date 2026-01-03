  <!-- Header -->
    <header id="main-header"
        class="bg-white border-b border-gray-200 sticky top-0 z-40 transition-transform duration-300">
        <div class="flex items-center justify-between px-4 py-3 lg:px-6 max-w-[1200px] mx-auto">

            <!-- Right: Logo -->
            <div class="flex items-center gap-4">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-3 select-none cursor-pointer">
                    <div
                        class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white shadow-sm animate-heartbeat">
                        <i data-lucide="rss" class="w-6 h-6"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-bold text-gray-700 leading-none">Andishe</span>
                        <span class="text-lg font-light text-gray-500 leading-none">Media</span>
                    </div>
                </a>
            </div>

            <!-- Center: Search Bar -->
            <div class="hidden md:flex flex-1 max-w-xl mx-8">
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="relative w-full">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <i data-lucide="search" class="h-5 w-5 text-gray-400"></i>
                    </div>
                    <input type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>"
                        class="block w-full pr-10 pl-3 py-2.5 bg-gray-100 border-none rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all shadow-inner"
                        placeholder="جستجو در اخبار..." />
                </form>
            </div>

            <!-- Left: Theme Toggle & Burger -->
            <div class="flex items-center gap-3">
                <!-- Theme Toggle -->
                <div onclick="toggleTheme()"
                    class="flex items-center bg-gray-100 rounded-full p-1 cursor-pointer hover:bg-gray-200 transition-colors border border-gray-200">
                    <div id="theme-sun"
                        class="p-1.5 rounded-full bg-white shadow-sm text-yellow-500 transition-all duration-300">
                        <i data-lucide="sun" class="w-4 h-4"></i>
                    </div>
                    <div id="theme-moon" class="p-1.5 rounded-full text-gray-400 transition-all duration-300">
                        <i data-lucide="moon" class="w-4 h-4"></i>
                    </div>
                </div>

                <div class="h-6 w-px bg-gray-200 mx-1"></div>

                <button onclick="openSidebar()"
                    class="p-2 hover:bg-gray-100 rounded-full text-gray-600 active:scale-95 transition-transform">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="max-w-[1200px] mx-auto hidden lg:flex items-center px-4 lg:px-6 pt-1 pb-4 overflow-x-auto no-scrollbar">
            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'flex space-x-reverse space-x-8 min-w-max',
                    'fallback_cb'    => false,
                    'depth'          => 3,
                    'walker'         => class_exists('Hasht_Header_Walker') ? new Hasht_Header_Walker() : ''
                ]);
            }
            ?>
        </div>
    </header>
