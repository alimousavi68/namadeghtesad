<!-- Footer -->
<footer class="bg-footer-bg text-slate-300 pt-16 pb-8 border-t border-slate-800">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            <!-- Brand Info -->
            <section class="col-span-1 flex flex-col items-center text-center md:items-start md:text-right">
                <h2 class="text-3xl font-black text-white mb-6">
                    <?php
                    if (has_custom_logo()) {
                        $custom_logo_id = get_theme_mod('custom_logo');
                        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                        if ($logo) {
                            echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" class="h-12 w-auto brightness-0 invert">';
                        }
                    } else {
                        echo 'نماد <span class="text-primary">اقتصاد</span>';
                    }
                    ?>
                </h2>
                <p class="text-sm leading-7 mb-6 font-medium">
                    <?php echo nl2br(esc_html(get_theme_mod('hasht_footer_about', 'پایگاه خبری نماد اقتصاد...'))); ?>
                </p>
                <div class="flex gap-3 flex-wrap justify-center w-full">
                    <?php
                    $socials = [
                        'instagram' => 'instagram',
                        'twitter'   => 'twitter',
                        'linkedin'  => 'linkedin',
                        'facebook'  => 'facebook',
                        'telegram'  => 'send',
                        'bale'      => 'message-circle',
                        'eitaa'     => 'message-square',
                        'rubika'    => 'box',
                        'igap'      => 'message-circle',
                    ];

                    foreach ($socials as $key => $icon) {
                        $enable = get_theme_mod("hasht_social_{$key}_enable", false);
                        $url    = get_theme_mod("hasht_social_{$key}_url", '#');

                        if ($enable && !empty($url)) {
                            echo '<a href="' . esc_url($url) . '" target="_blank" class="w-9 h-9 rounded-xl bg-slate-800 flex items-center justify-center hover:bg-primary transition-colors">';
                            echo '<i data-lucide="' . esc_attr($icon) . '" width="18"></i>';
                            echo '</a>';
                        }
                    }
                    ?>
                </div>
            </section>

            <!-- Quick Links -->
            <nav class="col-span-1 footer-accordion" aria-label="Quick Links">
                <?php
                $locations = get_nav_menu_locations();
                $menu_title = 'دسترسی سریع';
                if (isset($locations['footer_quick'])) {
                    $menu_obj = wp_get_nav_menu_object($locations['footer_quick']);
                    if ($menu_obj) {
                        $menu_title = $menu_obj->name;
                    }
                }
                ?>
                <button class="w-full flex items-center justify-between text-white font-black mb-4 md:mb-6 border-r-2 border-primary pr-3 md:cursor-default">
                    <span><?php echo esc_html($menu_title); ?></span>
                    <i data-lucide="chevron-down" class="w-5 h-5 md:hidden transition-transform duration-300"></i>
                </button>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer_quick',
                    'container'      => false,
                    'menu_class'     => 'space-y-4 text-sm font-medium hidden md:block overflow-hidden transition-all duration-300',
                    'fallback_cb'    => false,
                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'link_before'    => '', // No extra span needed
                    'link_after'     => '',
                    // Custom walker if needed, but standard should work for simple lists
                    // Using a simple replacement to add classes to <a> tags via 'nav_menu_link_attributes' filter could be cleaner, 
                    // but let's try direct walker or just standard output first.
                    // Actually, let's inject classes via a small inline filter or just use standard WP menu with a custom walker for footer.
                    // For simplicity and robustness, let's use a small walker to add hover classes.
                    'walker'         => new class extends Walker_Nav_Menu {
                        function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
                            $output .= '<li><a href="' . esc_url($item->url) . '" class="hover:text-primary transition-colors">' . esc_html($item->title) . '</a></li>';
                        }
                    }
                ]);
                ?>
            </nav>

            <!-- Help Links -->
            <nav class="col-span-1 footer-accordion" aria-label="Help Links">
                <?php
                $menu_title_help = 'خدمات مخاطبان';
                if (isset($locations['footer_help'])) {
                    $menu_obj = wp_get_nav_menu_object($locations['footer_help']);
                    if ($menu_obj) {
                        $menu_title_help = $menu_obj->name;
                    }
                }
                ?>
                <button class="w-full flex items-center justify-between text-white font-black mb-4 md:mb-6 border-r-2 border-primary pr-3 md:cursor-default">
                    <span><?php echo esc_html($menu_title_help); ?></span>
                    <i data-lucide="chevron-down" class="w-5 h-5 md:hidden transition-transform duration-300"></i>
                </button>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer_help',
                    'container'      => false,
                    'menu_class'     => 'space-y-4 text-sm font-medium hidden md:block overflow-hidden transition-all duration-300',
                    'fallback_cb'    => false,
                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'walker'         => new class extends Walker_Nav_Menu {
                        function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
                            $output .= '<li><a href="' . esc_url($item->url) . '" class="hover:text-primary transition-colors">' . esc_html($item->title) . '</a></li>';
                        }
                    }
                ]);
                ?>
            </nav>

            <!-- Contact -->
            <section class="col-span-1 footer-accordion">
                <button class="w-full flex items-center justify-between text-white font-black mb-4 md:mb-6 border-r-2 border-primary pr-3 md:cursor-default">
                    <span>تماس با ما</span>
                    <i data-lucide="chevron-down" class="w-5 h-5 md:hidden transition-transform duration-300"></i>
                </button>
                <ul class="space-y-4 text-sm font-medium hidden md:block overflow-hidden transition-all duration-300">
                    <?php if (get_theme_mod('hasht_footer_address')) : ?>
                        <li class="flex items-start gap-3">
                            <i data-lucide="map-pin" width="18" class="text-primary shrink-0"></i>
                            <span><?php echo nl2br(esc_html(get_theme_mod('hasht_footer_address'))); ?></span>
                        </li>
                    <?php endif; ?>

                    <?php if (get_theme_mod('hasht_footer_phone_1')) : ?>
                        <li class="flex items-center gap-3">
                            <i data-lucide="phone" width="18" class="text-primary shrink-0"></i>
                            <a href="tel:<?php echo esc_attr(get_theme_mod('hasht_footer_phone_1')); ?>" class="hover:text-primary transition-colors">
                                <?php echo esc_html(get_theme_mod('hasht_footer_phone_1')); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (get_theme_mod('hasht_footer_phone_2')) : ?>
                        <li class="flex items-center gap-3">
                            <i data-lucide="phone" width="18" class="text-primary shrink-0"></i>
                            <a href="tel:<?php echo esc_attr(get_theme_mod('hasht_footer_phone_2')); ?>" class="hover:text-primary transition-colors">
                                <?php echo esc_html(get_theme_mod('hasht_footer_phone_2')); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (get_theme_mod('hasht_footer_fax')) : ?>
                        <li class="flex items-center gap-3">
                            <i data-lucide="printer" width="18" class="text-primary shrink-0"></i>
                            <span><?php echo esc_html(get_theme_mod('hasht_footer_fax')); ?></span>
                        </li>
                    <?php endif; ?>

                    <?php if (get_theme_mod('hasht_footer_email')) : ?>
                        <li class="flex items-center gap-3">
                            <i data-lucide="mail" width="18" class="text-primary shrink-0"></i>
                            <a href="mailto:<?php echo esc_attr(get_theme_mod('hasht_footer_email')); ?>" class="hover:text-primary transition-colors">
                                <?php echo esc_html(get_theme_mod('hasht_footer_email')); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </section>
        </div>

        <div
            class="border-t border-slate-800 pt-8 mt-8 flex flex-col md:flex-row justify-between items-center text-[10px] md:text-xs text-slate-500 font-bold">
            <p><?php echo esc_html(get_theme_mod('hasht_footer_copyright', '© ۱۴۰۳ تمامی حقوق مادی و معنوی متعلق به پایگاه خبری نماد اقتصاد می‌باشد.')); ?></p>
            <div class="flex gap-6 mt-4 md:mt-0">
                <span>طراحی و توسعه: هشت بهشت</span>
                <a href="#" class="hover:text-white">نقشه سایت</a>
            </div>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<button id="back-to-top" type="button" class="fixed bottom-6 left-6 md:left-auto md:right-6 z-50 opacity-0 invisible transition-all duration-300 cursor-pointer group">
    <div class="relative w-12 h-12 flex items-center justify-center bg-white dark:bg-slate-800 rounded-full shadow-lg border border-slate-100 dark:border-slate-700 group-hover:-translate-y-1 transition-transform">
        <svg class="absolute top-0 left-0 w-full h-full -rotate-90" width="48" height="48" viewBox="0 0 48 48">
            <circle cx="24" cy="24" r="23" stroke="currentColor" stroke-width="2" fill="none" class="text-slate-100 dark:text-slate-700" />
            <circle id="progress-circle" cx="24" cy="24" r="23" stroke="currentColor" stroke-width="2" fill="none" class="text-primary transition-all duration-100" stroke-dasharray="144.5" stroke-dashoffset="144.5" stroke-linecap="round" />
        </svg>
        <i data-lucide="arrow-up" class="w-5 h-5 text-primary dark:text-primary relative z-10"></i>
    </div>
</button>
