<?php

/**
 * 
 * Bootstrap the Core 
 * 
 */

if (file_exists(__DIR__ . '/_hasht_core/bootstrap.php')) {
    require_once __DIR__ . '/_hasht_core/bootstrap.php';
}

// Include Custom Comment Walker
if (file_exists(__DIR__ . '/inc/classes/class-hasht-comment-walker.php')) {
    require_once __DIR__ . '/inc/classes/class-hasht-comment-walker.php';
}






// theme support
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('custom-logo', [
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
]);

// Add HTML5 support
add_theme_support( 'html5', array(
    'comment-list', 
    'comment-form', 
    'search-form', 
    'gallery', 
    'caption', 
    'style', 
    'script' 
) );

add_action('init', function () {
    $labels = [
        'name'                  => 'شرکت‌ها',
        'singular_name'         => 'شرکت',
        'menu_name'             => 'شرکت‌ها',
        'name_admin_bar'        => 'شرکت',
        'add_new'               => 'افزودن',
        'add_new_item'          => 'افزودن شرکت جدید',
        'new_item'              => 'شرکت جدید',
        'edit_item'             => 'ویرایش شرکت',
        'view_item'             => 'نمایش شرکت',
        'all_items'             => 'همه شرکت‌ها',
        'search_items'          => 'جستجوی شرکت‌ها',
        'not_found'             => 'شرکتی یافت نشد',
        'not_found_in_trash'    => 'در زباله‌دان چیزی یافت نشد',
        'featured_image'        => 'لوگو شرکت',
        'set_featured_image'    => 'انتخاب لوگو',
        'remove_featured_image' => 'حذف لوگو',
        'use_featured_image'    => 'استفاده به عنوان لوگو',
    ];

    register_post_type('company', [
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => [
            'slug' => 'companies',
            'with_front' => false,
        ],
        'menu_icon' => 'dashicons-building',
        'supports' => ['title', 'thumbnail'],
        'show_in_rest' => true,
        'taxonomies' => [],
    ]);

    $tax_labels = [
        'name'              => 'موضوع فعالیت',
        'singular_name'     => 'موضوع فعالیت',
        'search_items'      => 'جستجوی موضوع فعالیت',
        'all_items'         => 'همه موضوع‌ها',
        'parent_item'       => 'موضوع مادر',
        'parent_item_colon' => 'موضوع مادر:',
        'edit_item'         => 'ویرایش موضوع',
        'update_item'       => 'به‌روزرسانی موضوع',
        'add_new_item'      => 'افزودن موضوع جدید',
        'new_item_name'     => 'نام موضوع جدید',
        'menu_name'         => 'موضوع فعالیت',
    ];

    register_taxonomy('company_activity', ['company'], [
        'labels' => $tax_labels,
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => [
            'slug' => 'company-activity',
            'with_front' => false,
        ],
    ]);
});

add_action('after_switch_theme', function () {
    flush_rewrite_rules();
});

add_action('wp_head', function () {
    if (is_admin()) {
        return;
    }

    $encode = function ($data) {
        return wp_json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    };

    if (is_singular('company')) {
        $company_id = get_queried_object_id();
        if (!$company_id) {
            return;
        }

        $company_url = get_permalink($company_id);
        $org_id = trailingslashit($company_url) . '#org';

        $website = get_post_meta($company_id, '_company_website', true);
        $email = get_post_meta($company_id, '_company_email', true);
        $phones_raw = get_post_meta($company_id, '_company_phones', true);
        $addresses_raw = get_post_meta($company_id, '_company_addresses', true);

        $phones = [];
        if (!empty($phones_raw)) {
            $phones = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $phones_raw))));
        }

        $street_address = '';
        if (!empty($addresses_raw)) {
            $street_address = implode('، ', array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $addresses_raw)))));
        }

        $same_as = [];
        $social_keys = [
            '_company_social_instagram',
            '_company_social_telegram',
            '_company_social_linkedin',
            '_company_social_x',
            '_company_social_whatsapp',
        ];
        foreach ($social_keys as $k) {
            $v = get_post_meta($company_id, $k, true);
            $v = $v ? wp_http_validate_url($v) : '';
            if ($v) {
                $same_as[] = $v;
            }
        }

        $logo = get_the_post_thumbnail_url($company_id, 'full');
        $org = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            '@id' => $org_id,
            'name' => get_the_title($company_id),
            'url' => $company_url,
        ];

        if ($logo) {
            $org['logo'] = $logo;
        }

        if ($website && wp_http_validate_url($website)) {
            $org['sameAs'] = array_values(array_unique(array_merge($same_as, [wp_http_validate_url($website)])));
        } elseif (!empty($same_as)) {
            $org['sameAs'] = array_values(array_unique($same_as));
        }

        if ($email) {
            $org['email'] = sanitize_email($email);
        }

        if (!empty($phones)) {
            $org['telephone'] = $phones[0];
            $org['contactPoint'] = [
                [
                    '@type' => 'ContactPoint',
                    'telephone' => $phones[0],
                    'contactType' => 'customer service',
                ],
            ];
        }

        if ($street_address !== '') {
            $org['address'] = [
                '@type' => 'PostalAddress',
                'streetAddress' => $street_address,
                'addressCountry' => 'IR',
            ];
        }

        $webpage = [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'url' => $company_url,
            'name' => get_the_title($company_id),
            'isPartOf' => [
                '@type' => 'WebSite',
                'url' => home_url('/'),
                'name' => get_bloginfo('name'),
            ],
            'mainEntity' => [
                '@id' => $org_id,
            ],
        ];

        echo '<script type="application/ld+json">' . $encode([
            '@context' => 'https://schema.org',
            '@graph' => [$org, $webpage],
        ]) . '</script>';

        return;
    }

    if (is_post_type_archive('company') || is_tax('company_activity')) {
        global $wp_query;
        if (!$wp_query || empty($wp_query->posts)) {
            return;
        }

        $items = [];
        $pos = 1;
        foreach ($wp_query->posts as $p) {
            if (!$p || $p->post_type !== 'company') {
                continue;
            }
            $items[] = [
                '@type' => 'ListItem',
                'position' => $pos++,
                'url' => get_permalink($p),
                'name' => get_the_title($p),
            ];
            if ($pos > 21) {
                break;
            }
        }

        if (empty($items)) {
            return;
        }

        $page_url = function_exists('get_pagenum_link') ? get_pagenum_link(max(1, get_query_var('paged'))) : home_url('/');
        $title = is_tax('company_activity') ? single_term_title('', false) : 'شرکت‌ها';

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'CollectionPage',
            'url' => $page_url,
            'name' => $title,
            'isPartOf' => [
                '@type' => 'WebSite',
                'url' => home_url('/'),
                'name' => get_bloginfo('name'),
            ],
            'mainEntity' => [
                '@type' => 'ItemList',
                'itemListElement' => $items,
            ],
        ];

        echo '<script type="application/ld+json">' . $encode($schema) . '</script>';
    }
}, 20);

// Register Custom Image Sizes
add_action('after_setup_theme', function () {
    // 1. Standard Landscape (Workhorse for grids)
    add_image_size('hasht-medium', 450, 280, true); 

    // 2. Feature Landscape (Hero slider, Large features)
    add_image_size('hasht-large', 850, 530, true);

    // 3. Rectangular Thumbnail (Sidebars, Lists)
    add_image_size('hasht-small-rect', 220, 150, true);

    // 4. Portrait (Publications/Magazines)
    add_image_size('hasht-portrait', 300, 400, true);
    
    // Note: 'thumbnail' (150x150) is kept for avatars/circles
});

// Optimize: Disable generation of unneeded default sizes
add_filter('intermediate_image_sizes_advanced', function ($sizes) {
    // Remove default sizes we don't strictly need if our custom sizes cover them
    unset($sizes['medium_large']); // 768px width (often unused if we have 850px)
    unset($sizes['1536x1536']);    // WP 5.3+ default 2x large
    unset($sizes['2048x2048']);    // WP 5.3+ default 2x large
    
    // Optional: You can unset 'medium' and 'large' if you are 100% sure you won't use them in post content
    // unset($sizes['medium']); 
    unset($sizes['large']);

    return $sizes;
});

add_action('after_setup_theme', function () {
    register_nav_menus([
        'primary' => 'منوی اصلی',
        'mobile'  => 'منوی موبایل',
        'footer_quick'  => 'منوی دسترسی سریع (فوتر)',
        'footer_help'   => 'منوی خدمات مخاطبان (فوتر)',
        'top_bar' => 'منوی نوار بالا',
    ]);
});

// Enqueue Scripts
add_action('wp_enqueue_scripts', function () {
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    // Enqueue Lucide Icons
    wp_enqueue_script(
        'lucide',
        get_template_directory_uri() . '/assets/js/lucide.js',
        [],
        '1.0.0',
        false // Load in head to be available early, or footer? Usually footer is fine if we init on DOMContentLoaded.
    );

    if ( is_singular() ) {
        wp_enqueue_script(
            'hasht-comments',
            get_template_directory_uri() . '/assets/js/comments.js',
            [],
            '1.0.0',
            true
        );

        wp_localize_script( 'hasht-comments', 'hasht_vars', [
            'ajax_url' => admin_url( 'admin-ajax.php' )
        ]);
    }

    // Enqueue Main JS (Global)
    wp_enqueue_script(
        'hasht-main',
        get_template_directory_uri() . '/assets/js/main.js',
        ['jquery', 'lucide'],
        '1.0.1',
        true
    );
});

// Load Seeder (Only for development)
if (file_exists(__DIR__ . '/inc/seeder.php')) {
    require_once __DIR__ . '/inc/seeder.php';
}

// Load Custom Widgets
if (file_exists(__DIR__ . '/inc/widgets.php')) {
    require_once __DIR__ . '/inc/widgets.php';
}

// Load CLI Commands
if (defined('WP_CLI') && WP_CLI && file_exists(__DIR__ . '/inc/cli.php')) {
    require_once __DIR__ . '/inc/cli.php';
}

// Load Custom Metaboxes
if (file_exists(__DIR__ . '/inc/metaboxes.php')) {
    require_once __DIR__ . '/inc/metaboxes.php';
}

// Load AJAX Handler
if (file_exists(__DIR__ . '/inc/ajax.php')) {
    require_once __DIR__ . '/inc/ajax.php';
}

class Hasht_Header_Walker extends Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"absolute top-[100%] right-0 w-56 bg-white dark:bg-slate-800 shadow-xl border border-slate-100 dark:border-slate-700 rounded-xl py-2 invisible group-hover:visible opacity-0 group-hover:opacity-100 transition-all z-[60]\">\n";
    }

    public function end_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $has_children = in_array('menu-item-has-children', (array)$item->classes, true);
        
        // Classes for the <li>
        $li_classes = [];
        if ($depth === 0) {
            $li_classes[] = 'relative group flex items-center';
        } else {
            // Submenu item li classes? The static HTML doesn't show specific classes on submenu LI, only on A.
            // But standard behavior needs some.
        }
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($li_classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= $indent . '<li' . $class_names . '>';

        // Classes for the <a>
        $link_classes = '';
        if ($depth === 0) {
            $link_classes = 'flex items-center gap-1 py-1.5 px-1 lg:px-2 text-md lg:text-[17px] font-normal text-slate-700 dark:text-slate-300 hover:text-rose-600 dark:hover:text-rose-500 transition-all whitespace-nowrap';
        } else {
            $link_classes = 'block px-6 py-2.5 text-sm font-medium text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-rose-600';
        }

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="' . esc_attr($link_classes) . '"';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        
        // Chevron for top level with children
        if ($depth === 0 && $has_children) {
            $item_output .= '<i data-lucide="chevron-down" width="14" class="opacity-50 group-hover:rotate-180 transition-transform"></i>';
        }

        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    public function end_el(&$output, $item, $depth = 0, $args = null)
    {
        // Add separator for top level items (except the last one which we handle via CSS group-last:hidden)
        if ($depth === 0) {
            $output .= '<span class="w-px h-5 bg-slate-200 dark:bg-slate-800 mx-1 block"></span>';
        }
        $output .= "</li>\n";
    }
}

class Hasht_Mobile_Walker extends Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        // Floating card style for submenus
        $output .= '<ul class="hidden bg-slate-50 dark:bg-slate-800/50 rounded-xl p-2 mt-2 space-y-1 mx-4 shadow-inner">';
    }
    public function end_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '</ul>';
    }
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $has_children = in_array('menu-item-has-children', (array)$item->classes, true);
        $output .= '<li class="relative group">';
        
        if ($depth === 0) {
            // Top Level Items
            $output .= '<div class="flex items-center justify-between border-b border-slate-50 dark:border-slate-800/50 last:border-0">';
            $output .= '<a href="' . esc_url($item->url) . '" class="flex-1 px-4 py-4 text-base font-bold text-slate-800 dark:text-slate-100 hover:text-rose-600 transition-colors">' . esc_html($item->title) . '</a>';
            
            if ($has_children) {
                $output .= '<button type="button" class="p-4 text-slate-400 hover:text-rose-600 transition-colors" data-toggle-submenu aria-expanded="false">';
                $output .= '<i data-lucide="chevron-down" class="w-5 h-5 transition-transform duration-300"></i>';
                $output .= '</button>';
            }
            $output .= '</div>';
        } else {
            // Submenu Items
            $output .= '<a href="' . esc_url($item->url) . '" class="block px-3 py-2.5 text-sm font-medium text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-slate-700 hover:text-rose-600 rounded-lg transition-all shadow-sm hover:shadow-md">';
            $output .= '<div class="flex items-center gap-2">';
            $output .= '<span class="w-1.5 h-1.5 rounded-full bg-slate-300 dark:bg-slate-600 group-hover:bg-rose-500 transition-colors"></span>';
            $output .= esc_html($item->title);
            $output .= '</div>';
            $output .= '</a>';
        }
    }
    public function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= '</li>';
    }
}

add_action('pre_get_posts', function ($q) {
    if (is_admin() || !$q->is_main_query()) {
        return;
    }
    if ($q->is_category()) {
        $q->set('post_type', ['post']);
    }
    if ($q->is_search()) {
        $type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';
        if ($type === 'post') {
            $q->set('post_type', [$type]);
        } else {
            $q->set('post_type', ['post']);
        }
        $q->set('orderby', 'date');
        $q->set('order', 'DESC');
        $cat = isset($_GET['cat']) ? absint($_GET['cat']) : 0;
        if ($cat) {
            $q->set('cat', $cat);
        }
        $from = isset($_GET['from']) ? sanitize_text_field($_GET['from']) : '';
        $to = isset($_GET['to']) ? sanitize_text_field($_GET['to']) : '';
        $dq = [];
        if ($from) {
            $dq['after'] = $from;
        }
        if ($to) {
            $dq['before'] = $to;
        }
        if (!empty($dq)) {
            $dq['inclusive'] = true;
            $q->set('date_query', [$dq]);
        }
    }
});

add_filter('posts_search', function ($search, $query) {
    if (is_admin() || !$query->is_main_query() || !$query->is_search()) {
        return $search;
    }
    $search_term = $query->get('s');
    if (!$search_term || !$search) {
        return $search;
    }
    global $wpdb;
    $like = '%' . $wpdb->esc_like($search_term) . '%';
    $tag_sql = $wpdb->prepare(
        " OR EXISTS (SELECT 1 FROM {$wpdb->term_relationships} tr INNER JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id AND tt.taxonomy = 'post_tag' INNER JOIN {$wpdb->terms} t ON tt.term_id = t.term_id WHERE tr.object_id = {$wpdb->posts}.ID AND t.name LIKE %s)",
        $like
    );
    if (strpos($search, $tag_sql) !== false) {
        return $search;
    }
    return preg_replace('/\)\s*$/', $tag_sql . ')', $search);
}, 10, 2);


if (!function_exists('hasht_get_thumbnail')) {
    function hasht_get_thumbnail($size = 'medium', $attrs = [])
    {
        $post_id = get_the_ID();
        $attrs = is_array($attrs) ? $attrs : [];
        if ($post_id && has_post_thumbnail($post_id)) {
            return get_the_post_thumbnail($post_id, $size, $attrs);
        }
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 360"><rect width="640" height="360" fill="#f1f5f9"/><text x="320" y="180" text-anchor="middle" dominant-baseline="middle" fill="#94a3b8" font-size="24" font-family="Tahoma, sans-serif">Andishe Media</text></svg>';
        $src = 'data:image/svg+xml;charset=UTF-8,' . rawurlencode($svg);
        $merged = array_merge(['src' => $src, 'alt' => 'تصویر خبر'], $attrs);
        $attr_str = '';
        foreach ($merged as $k => $v) {
            $attr_str .= ' ' . $k . '="' . esc_attr($v) . '"';
        }
        return '<img' . $attr_str . ' />';
    }
}

/**
 * Helper: Safe Human Time Diff
 * Calculates time difference using GMT timestamps to avoid Parsi Date conflict.
 */
if (!function_exists('hasht_time_ago')) {
    function hasht_time_ago($post_id = null) {
        $post = get_post($post_id);
        if (!$post) return '';
        
        $post_time_gmt = get_post_time('U', true, $post);
        if (!$post_time_gmt) return '';

        $current_time_gmt = current_time('timestamp', true);
        if ($current_time_gmt < $post_time_gmt) {
            return human_time_diff($current_time_gmt, $post_time_gmt) . ' بعد';
        }

        return human_time_diff($post_time_gmt, $current_time_gmt) . ' پیش';
    }
}
