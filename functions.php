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
