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
                            echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" class="h-12 w-auto">';
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
                        'instagram' => ['type' => 'lucide', 'icon' => 'instagram'],
                        'twitter'   => ['type' => 'lucide', 'icon' => 'twitter'],
                        'linkedin'  => ['type' => 'lucide', 'icon' => 'linkedin'],
                        'facebook'  => ['type' => 'lucide', 'icon' => 'facebook'],
                        'telegram'  => ['type' => 'lucide', 'icon' => 'send'],
                        'whatsapp'  => ['type' => 'svg', 'content' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.6 6.31999C16.8669 5.58141 15.9943 4.99596 15.033 4.59767C14.0716 4.19938 13.0406 3.99622 12 3.99999C10.6089 4.00135 9.24248 4.36819 8.03771 5.06377C6.83294 5.75935 5.83208 6.75926 5.13534 7.96335C4.4386 9.16745 4.07046 10.5335 4.06776 11.9246C4.06507 13.3158 4.42793 14.6832 5.12 15.89L4 20L8.2 18.9C9.35975 19.5452 10.6629 19.8891 11.99 19.9C14.0997 19.9001 16.124 19.0668 17.6222 17.5816C19.1205 16.0965 19.9715 14.0796 19.99 11.97C19.983 10.9173 19.7682 9.87634 19.3581 8.9068C18.948 7.93725 18.3505 7.05819 17.6 6.31999ZM12 18.53C10.8177 18.5308 9.65701 18.213 8.64 17.61L8.4 17.46L5.91 18.12L6.57 15.69L6.41 15.44C5.55925 14.0667 5.24174 12.429 5.51762 10.8372C5.7935 9.24545 6.64361 7.81015 7.9069 6.80322C9.1702 5.79628 10.7589 5.28765 12.3721 5.37368C13.9853 5.4597 15.511 6.13441 16.66 7.26999C17.916 8.49818 18.635 10.1735 18.66 11.93C18.6442 13.6859 17.9355 15.3645 16.6882 16.6006C15.441 17.8366 13.756 18.5301 12 18.53ZM15.61 13.59C15.41 13.49 14.44 13.01 14.26 12.95C14.08 12.89 13.94 12.85 13.81 13.05C13.6144 13.3181 13.404 13.5751 13.18 13.82C13.07 13.96 12.95 13.97 12.75 13.82C11.6097 13.3694 10.6597 12.5394 10.06 11.47C9.85 11.12 10.26 11.14 10.64 10.39C10.6681 10.3359 10.6827 10.2759 10.6827 10.215C10.6827 10.1541 10.6681 10.0941 10.64 10.04C10.64 9.93999 10.19 8.95999 10.03 8.56999C9.87 8.17999 9.71 8.23999 9.58 8.22999H9.19C9.08895 8.23154 8.9894 8.25465 8.898 8.29776C8.8066 8.34087 8.72546 8.403 8.66 8.47999C8.43562 8.69817 8.26061 8.96191 8.14676 9.25343C8.03291 9.54495 7.98287 9.85749 8 10.17C8.0627 10.9181 8.34443 11.6311 8.81 12.22C9.6622 13.4958 10.8301 14.5293 12.2 15.22C12.9185 15.6394 13.7535 15.8148 14.58 15.72C14.8552 15.6654 15.1159 15.5535 15.345 15.3915C15.5742 15.2296 15.7667 15.0212 15.91 14.78C16.0428 14.4856 16.0846 14.1583 16.03 13.84C15.94 13.74 15.81 13.69 15.61 13.59Z" fill="currentColor"/></svg>'],
                        'bale'      => ['type' => 'svg', 'content' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><path d="m9 12 2 2 4-4"/></svg>'],
                        'eitaa'     => ['type' => 'svg', 'content' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M5.968 23.942a6.624 6.624 0 0 1-2.332-.83c-1.62-.929-2.829-2.593-3.217-4.426-.151-.717-.17-1.623-.15-7.207C.288 5.47.274 5.78.56 4.79c.142-.493.537-1.34.823-1.767C2.438 1.453 3.99.445 5.913.08c.384-.073.94-.08 6.056-.08 6.251 0 6.045-.009 7.066.314a6.807 6.807 0 0 1 4.314 4.184c.33.937.346 1.087.369 3.555l.02 2.23-.391.268c-.558.381-1.29 1.06-2.316 2.15-1.182 1.256-2.376 2.42-2.982 2.907-1.309 1.051-2.508 1.651-3.726 1.864-.634.11-1.682.067-2.302-.095-.553-.144-.517-.168-.726.464a6.355 6.355 0 0 0-.318 1.546l-.031.407-.146-.03c-1.215-.241-2.419-1.285-2.884-2.5a3.583 3.583 0 0 1-.26-1.219l-.016-.34-.309-.284c-.644-.59-1.063-1.312-1.195-2.061-.212-1.193.34-2.542 1.538-3.756 1.264-1.283 3.127-2.29 4.953-2.68.658-.14 1.818-.177 2.403-.075 1.138.198 2.067.773 2.645 1.639.182.271.195.31.177.555a.812.812 0 0 1-.183.493c-.465.651-1.848 1.348-3.336 1.68-2.625.585-4.294-.142-4.033-1.759.026-.163.04-.304.031-.313-.032-.032-.293.104-.575.3-.479.334-.903.984-1.05 1.607-.036.156-.05.406-.034.65.02.331.053.454.192.736.092.186.275.45.408.589l.24.251-.096.122a4.845 4.845 0 0 0-.677 1.217 3.635 3.635 0 0 0-.105 1.815c.103.461.421 1.095.739 1.468.242.285.797.764.886.764.024 0 .044-.048.044-.106.001-.23.184-.973.326-1.327.423-1.058 1.351-1.96 2.82-2.74.245-.13.952-.47 1.572-.757 1.36-.63 2.103-1.015 2.511-1.305 1.176-.833 1.903-2.065 2.14-3.625.086-.57.086-1.634 0-2.207-.368-2.438-2.195-4.096-4.818-4.37-2.925-.307-6.648 1.953-8.942 5.427-1.116 1.69-1.87 3.565-2.187 5.443-.123.728-.169 2.08-.093 2.75.193 1.704.822 3.078 1.903 4.156a6.531 6.531 0 0 0 1.87 1.313c2.368 1.13 4.99 1.155 7.295.071.996-.469 1.974-1.196 3.023-2.25 1.02-1.025 1.71-1.88 3.592-4.458 1.04-1.423 1.864-2.368 2.272-2.605l.15-.086-.019 3.091c-.018 2.993-.022 3.107-.123 3.561-.6 2.678-2.54 4.636-5.195 5.242l-.468.107-5.775.01c-4.734.008-5.85-.002-6.19-.056z"/></svg>'],
                        'rubika'    => ['type' => 'svg', 'content' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.12 6.4-6.05-4.06a2 2 0 0 0-2.17-.05L2.95 8.41a2 2 0 0 0-.95 1.7v5.82a2 2 0 0 0 .88 1.66l6.05 4.07a2 2 0 0 0 2.17.05l9.95-6.12a2 2 0 0 0 .95-1.7V8.06a2 2 0 0 0-.88-1.66Z"/><path d="M10 22v-8L2.25 9.15"/><path d="m10 14 11.77-6.87"/></svg>'], // Cube
                        'igap'      => ['type' => 'svg', 'content' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/><path d="M8 12h8"/><path d="M8 8h8"/></svg>'],
                    ];

                    foreach ($socials as $key => $data) {
                        $enable = get_theme_mod("hasht_social_{$key}_enable", false);
                        $url    = get_theme_mod("hasht_social_{$key}_url", '#');

                        if ($enable && !empty($url)) {
                            echo '<a href="' . esc_url($url) . '" target="_blank" class="w-9 h-9 rounded-xl bg-slate-800 flex items-center justify-center hover:bg-primary transition-colors text-white">';
                            if ($data['type'] === 'lucide') {
                                echo '<i data-lucide="' . esc_attr($data['icon']) . '" width="18"></i>';
                            } elseif ($data['type'] === 'svg') {
                                echo $data['content'];
                            } elseif ($data['type'] === 'img') {
                                echo '<img src="' . esc_url($data['src']) . '" alt="' . esc_attr($data['alt']) . '" class="w-[18px] h-[18px] object-contain invert">';
                            }
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
