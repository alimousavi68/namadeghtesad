<?php
/**
 * News Aggregator Functionality
 *
 * Registers the 'aggregated_news' Custom Post Type, 'news_source' taxonomy,
 * and handles source URL meta boxes.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register 'aggregated_news' Custom Post Type
 */
function hasht_register_aggregated_news_cpt() {
    $labels = [
        'name'               => 'اخبار تجمیعی',
        'singular_name'      => 'خبر تجمیعی',
        'menu_name'          => 'اخبار تجمیعی',
        'add_new'            => 'افزودن خبر',
        'add_new_item'       => 'افزودن خبر تجمیعی جدید',
        'edit_item'          => 'ویرایش خبر',
        'view_item'          => 'مشاهده خبر',
        'all_items'          => 'همه اخبار',
        'search_items'       => 'جستجوی اخبار',
        'not_found'          => 'خبری یافت نشد',
        'not_found_in_trash' => 'خبری در زباله‌دان یافت نشد'
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => ['slug' => 'news'], // URL Structure: site.com/news/post-name
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-rss',
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'author'],
        'taxonomies'         => ['category', 'post_tag'], // Add standard categories and tags
        'show_in_rest'       => true, // Enable Block Editor
    ];

    register_post_type('aggregated_news', $args);
}
add_action('init', 'hasht_register_aggregated_news_cpt');

/**
 * Register 'news_source' Taxonomy
 */
function hasht_register_news_source_taxonomy() {
    $labels = [
        'name'              => 'منابع خبری',
        'singular_name'     => 'منبع خبری',
        'search_items'      => 'جستجوی منابع',
        'all_items'         => 'همه منابع',
        'edit_item'         => 'ویرایش منبع',
        'update_item'       => 'بروزرسانی منبع',
        'add_new_item'      => 'افزودن منبع جدید',
        'new_item_name'     => 'نام منبع جدید',
        'menu_name'         => 'منابع خبری',
    ];

    $args = [
        'hierarchical'      => true, 
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'source'],
        'show_in_rest'      => true,
    ];

    register_taxonomy('news_source', ['aggregated_news'], $args);
}
add_action('init', 'hasht_register_news_source_taxonomy');

/**
 * Add Meta Box for Source URL
 */
function hasht_add_source_meta_box() {
    add_meta_box(
        'hasht_source_meta',
        'مشخصات منبع خبر',
        'hasht_render_source_meta_box',
        'aggregated_news',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'hasht_add_source_meta_box');

/**
 * Render Meta Box Content
 */
function hasht_render_source_meta_box($post) {
    wp_nonce_field('hasht_save_source_meta', 'hasht_source_meta_nonce');
    $value_link = get_post_meta($post->ID, 'i8_hrm_source_link', true);
    $value_name = get_post_meta($post->ID, 'i8_hrm_source_name', true);

    echo '<label for="hasht_news_source_name_field">نام منبع خبر:</label>';
    echo '<input type="text" id="hasht_news_source_name_field" name="hasht_news_source_name_field" value="' . esc_attr($value_name) . '" style="width:100%; margin-top: 10px;" placeholder="نام رسانه یا وب‌سایت">';
    echo '<p class="description">نام منبع برای نمایش در قالب استفاده می‌شود.</p>';

    echo '<hr style="margin:12px 0;border:none;border-top:1px solid #eee;" />';

    echo '<label for="i8_hrm_source_link_field">آدرس اینترنتی (URL) منبع اصلی خبر:</label>';
    echo '<input type="url" id="i8_hrm_source_link_field" name="i8_hrm_source_link_field" value="' . esc_attr($value_link) . '" style="width:100%; margin-top: 10px; direction: ltr;" placeholder="https://example.com/news/123" />';
    echo '<p class="description">این لینک برای دکمه "مشاهده خبر کامل" استفاده می‌شود (dofollow).</p>';
}

/**
 * Save Meta Box Data
 */
function hasht_save_source_meta($post_id) {
    if (!isset($_POST['hasht_source_meta_nonce']) || !wp_verify_nonce($_POST['hasht_source_meta_nonce'], 'hasht_save_source_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (function_exists('wp_is_post_autosave') && wp_is_post_autosave($post_id)) {
        return;
    }
    if (function_exists('wp_is_post_revision') && wp_is_post_revision($post_id)) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['hasht_news_source_name_field'])) {
        $name_data = sanitize_text_field($_POST['hasht_news_source_name_field']);
        update_post_meta($post_id, 'i8_hrm_source_name', $name_data);
    }
    if (isset($_POST['i8_hrm_source_link_field'])) {
        $link_data = esc_url_raw($_POST['i8_hrm_source_link_field']);
        update_post_meta($post_id, 'i8_hrm_source_link', $link_data);
    }
}
add_action('save_post_aggregated_news', 'hasht_save_source_meta');
