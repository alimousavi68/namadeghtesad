<!-- Header -->
<header id="main-header"
    class="bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 transition-all duration-300 z-50 w-full sticky top-0">
    <!-- Utility Bar -->
    <div
        class="bg-slate-50 dark:bg-slate-950 border-b border-slate-100 dark:border-slate-800 py-1.5 hidden md:block">
        <div
            class="container mx-auto px-4 flex justify-between items-center text-[11px] text-slate-500 dark:text-text-light font-medium">
            <div class="flex items-center gap-6">
                <span class="flex items-center gap-1.5"><i data-lucide="calendar" width="13"></i> <span
                        id="current-date"></span></span>
                <span class="flex items-center gap-1.5"><i data-lucide="clock" width="13"></i> بروزرسانی:
                    <?php echo date_i18n('H:i'); ?></span>
            </div>
            <div class="flex items-center gap-6">
                <?php
                wp_nav_menu([
                    'theme_location' => 'top_bar',
                    'container'      => false,
                    'menu_class'     => 'flex items-center gap-6',
                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'fallback_cb'    => false,
                    'depth'          => 1,
                    // Remove default list styles in a cleaner way if needed, but flex gap-6 handles layout
                ]);
                ?>
                
                <div class="flex items-center gap-4 pr-4 border-r border-slate-300 dark:border-slate-700">
                    <?php
                    $socials = [
                        'instagram' => 'instagram',
                        'twitter'   => 'twitter',
                        'linkedin'  => 'linkedin',
                        'facebook'  => 'facebook',
                        'telegram'  => 'send',
                        'bale'      => 'message-circle', // Placeholder
                        'eitaa'     => 'message-square', // Placeholder
                        'rubika'    => 'box',            // Placeholder
                        'igap'      => 'message-circle', // Placeholder
                    ];

                    foreach ($socials as $key => $icon) {
                        $enable = get_theme_mod("hasht_social_{$key}_enable", false);
                        $url    = get_theme_mod("hasht_social_{$key}_url", '#');

                        if ($enable && !empty($url)) {
                            echo '<a href="' . esc_url($url) . '" target="_blank" class="cursor-pointer hover:text-primary transition-colors">';
                            echo '<i data-lucide="' . esc_attr($icon) . '" width="13"></i>';
                            echo '</a>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Branding & Navigation Bar -->
    <div class="container mx-auto px-4 py-2 md:py-3 flex items-center justify-between gap-8">
        <div class="flex items-center gap-10 lg:gap-14">
            <!-- Logo -->
            <div class="flex items-center shrink-0">
                <?php 
                $custom_logo_id = get_theme_mod('custom_logo');
                if ($custom_logo_id) : 
                    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                ?>
                    <a href="<?php echo home_url(); ?>" class="flex items-center">
                        <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php bloginfo('name'); ?>"
                            class="block w-[180px] h-[50px] md:h-[70px] max-h-50 md:max-h-[70px] object-contain dark:brightness-0 dark:invert" />
                    </a>
                <?php else : ?>
                    <a href="<?php echo home_url(); ?>" class="flex items-center">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logona (1) copy.webp" alt="<?php bloginfo('name'); ?>"
                            class="block w-[180px] h-[50px] md:h-[70px] object-contain dark:brightness-0 dark:invert" />
                    </a>
                <?php endif; ?>
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
                class="p-2.5 rounded-full hover:text-primary dark:hover:text-primary text-slate-600 dark:text-slate-300 transition-colors">
                <i data-lucide="moon" width="22" stroke-width="1.5" id="theme-icon-moon"></i>
                <i data-lucide="sun" width="22" stroke-width="1.5" id="theme-icon-sun" class="hidden"></i>
            </button>

            <button id="menu-toggle"
                class="flex p-2 text-text-main dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-full transition-colors">
                <i data-lucide="menu" width="28"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-[90] opacity-0 invisible transition-all duration-300"></div>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-[90] opacity-0 invisible transition-all duration-300"></div>

    <!-- Mobile Menu -->
    <nav id="mobile-menu"
        class="fixed inset-y-0 right-0 w-80 bg-white dark:bg-slate-900 border-r border-slate-100 dark:border-slate-800 shadow-2xl transition-transform duration-300 z-[100] translate-x-full overflow-y-auto">
        <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center sticky top-0 bg-white dark:bg-slate-900 z-10">
            <?php if (has_custom_logo()) : 
                $custom_logo_id = get_theme_mod('custom_logo');
                $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            ?>
                <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php bloginfo('name'); ?>" class="h-14 w-auto object-contain dark:brightness-0 dark:invert" />
            <?php else: ?>
                <img src="https://namadeghtesad.ir/wp-content/uploads/2023/12/logona.png" alt="نماد اقتصاد"
                    class="h-14 w-auto object-contain dark:brightness-0 dark:invert" />
            <?php endif; ?>
            <button id="menu-close" class="p-2 text-slate-500 hover:text-rose-600 transition-colors"><i data-lucide="x" width="24"></i></button>
        </div>
        
        <?php
        wp_nav_menu([
            'theme_location' => 'mobile',
            'container'      => false,
            'menu_class'     => 'flex flex-col p-4 space-y-1',
            'fallback_cb'    => false,
            'walker'         => new Hasht_Mobile_Walker(),
        ]);
        ?>
    </nav>

    <!-- News Ticker -->
    <?php core_view('partials/news-ticker'); ?>

    <!-- Search Modal -->
    <div id="search-modal" class="fixed inset-0 z-[200] bg-slate-900/90 backdrop-blur-sm opacity-0 invisible transition-all duration-300 flex items-center justify-center p-4">
        <button id="search-modal-close" class="absolute top-6 left-6 text-white/70 hover:text-white transition-colors">
            <i data-lucide="x" width="32"></i>
        </button>
        <div class="w-full max-w-2xl">
            <h2 class="text-2xl md:text-3xl font-black text-white text-center mb-8">جستجو در نماد اقتصاد</h2>
            <form action="<?php echo home_url('/'); ?>" method="GET" class="relative mb-8">
                <input type="text" name="s" placeholder="عبارت مورد نظر را بنویسید..." 
                    class="w-full h-16 pr-14 pl-6 bg-white/10 border border-white/20 rounded-2xl text-white placeholder:text-white/50 focus:outline-none focus:bg-white/20 focus:border-rose-500 transition-all text-lg">
                <button type="submit" class="absolute top-1/2 -translate-y-1/2 right-4 text-white/70 hover:text-rose-500 transition-colors">
                    <i data-lucide="search" width="28"></i>
                </button>
            </form>
            <div class="flex flex-wrap items-center justify-center gap-3 text-sm text-white/70">
                <span class="font-bold">ترندها:</span>
                <a href="<?php echo home_url('/?s=بورس'); ?>" class="px-3 py-1 bg-white/10 rounded-lg hover:bg-rose-600 hover:text-white transition-colors">بورس</a>
                <a href="<?php echo home_url('/?s=خودرو'); ?>" class="px-3 py-1 bg-white/10 rounded-lg hover:bg-rose-600 hover:text-white transition-colors">خودرو</a>
                <a href="<?php echo home_url('/?s=طلا'); ?>" class="px-3 py-1 bg-white/10 rounded-lg hover:bg-rose-600 hover:text-white transition-colors">طلا</a>
                <a href="<?php echo home_url('/?s=مسکن'); ?>" class="px-3 py-1 bg-white/10 rounded-lg hover:bg-rose-600 hover:text-white transition-colors">مسکن</a>
                <a href="<?php echo home_url('/?s=ارز'); ?>" class="px-3 py-1 bg-white/10 rounded-lg hover:bg-rose-600 hover:text-white transition-colors">ارز</a>
            </div>
        </div>
    </div>
</header>
