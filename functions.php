<?php

/**
 * 
 * Bootstrap the Core 
 * 
 */

if (file_exists(__DIR__ . '/_hasht_core/bootstrap.php')) {
    require_once __DIR__ . '/_hasht_core/bootstrap.php';
}



add_action('wp_enqueue_scripts', function () {
    //1. Enqueue the lucide.js script
    wp_enqueue_script(
        'lucide',
        'https://unpkg.com/lucide@latest',
        [],
        '1.0',
        false
    );
 
});


// add_action('wp_head', function () {
// });


// theme support
add_theme_support('title-tag');
add_theme_support('post-thumbnails');

add_action('after_setup_theme', function () {
    register_nav_menus([
        'primary' => 'منوی اصلی',
        'mobile'  => 'منوی موبایل',
        'footer'  => 'منوی فوتر',
    ]);
});

// Load Seeder (Only for development)
if (file_exists(__DIR__ . '/inc/seeder.php')) {
    require_once __DIR__ . '/inc/seeder.php';
}

// Load News Aggregator Logic (CPT & Architecture)
if (file_exists(__DIR__ . '/inc/news-aggregator.php')) {
    require_once __DIR__ . '/inc/news-aggregator.php';
}

class Hasht_Header_Walker extends Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"absolute top-full right-0 bg-white border border-gray-100 rounded-lg shadow-lg mt-3 min-w-[200px] py-2 hidden group-hover:block\">\n";
    }
    public function end_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $has_children = in_array('menu-item-has-children', (array)$item->classes, true);
        $is_active = in_array('current-menu-item', (array)$item->classes, true)
            || in_array('current_page_item', (array)$item->classes, true)
            || in_array('current-menu-ancestor', (array)$item->classes, true)
            || in_array('current_page_ancestor', (array)$item->classes, true)
            || in_array('current-menu-parent', (array)$item->classes, true)
            || in_array('current_page_parent', (array)$item->classes, true);
        $li_classes = $depth === 0 ? 'relative group' : 'relative';
        $output .= '<li class="' . esc_attr($li_classes) . '">';
        $link_classes = $depth === 0
            ? 'py-3 text-base font-medium whitespace-nowrap border-b-[3px] transition-colors duration-200'
            : 'block px-4 py-2.5 text-base text-gray-700 hover:bg-gray-50';
        if ($depth === 0) {
            $link_classes .= $is_active ? ' text-blue-700 border-blue-700' : ' border-transparent text-gray-600 hover:text-gray-900';
        }
        $output .= '<a href="' . esc_url($item->url) . '" class="' . esc_attr($link_classes) . '">' . esc_html($item->title) . '</a>';
    }
    public function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>";
    }
}

class Hasht_Mobile_Walker extends Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '<ul class="hidden pl-3">';
    }
    public function end_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '</ul>';
    }
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $has_children = in_array('menu-item-has-children', (array)$item->classes, true);
        $output .= '<li class="relative">';
        $output .= '<div class="flex items-center justify-between">';
        $output .= '<a href="' . esc_url($item->url) . '" class="px-4 py-3 rounded-lg hover:bg-gray-50 text-gray-700 dark:text-gray-200 dark:hover:text-gray-400 font-medium transition-colors">' . esc_html($item->title) . '</a>';
        if ($has_children) {
            $output .= '<button type="button" class="px-2 text-gray-500" data-toggle-submenu aria-expanded="false"><i data-lucide="chevron-down" class="w-4 h-4"></i></button>';
        }
        $output .= '</div>';
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
        $q->set('post_type', ['post', 'aggregated_news']);
    }
    if ($q->is_search()) {
        $type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';
        if ($type === 'post' || $type === 'aggregated_news') {
            $q->set('post_type', [$type]);
        } else {
            $q->set('post_type', ['post', 'aggregated_news']);
        }
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
    if ($q->is_post_type_archive('aggregated_news')) {
        $src_name = isset($_GET['source_name']) ? sanitize_text_field($_GET['source_name']) : '';
        if ($src_name !== '') {
            $q->set('meta_query', [
                [
                    'key'   => 'i8_hrm_source_name',
                    'value' => $src_name,
                    'compare' => '=',
                ],
            ]);
        }
    }
});

add_action('init', function () {
    register_post_meta('aggregated_news', 'i8_hrm_source_name', [
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    register_post_meta('aggregated_news', 'i8_hrm_source_link', [
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'esc_url_raw',
    ]);
});

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
