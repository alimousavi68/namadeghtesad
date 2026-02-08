<?php 
// helpers.php -- common functions

/**
 * simple debug
 */
function core_dd($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    exit;
}

/**
 * Load template
 */
function core_render($template, $data = [])
{
    $paths = require __DIR__ . '/config.php';
    $theme_path = $paths['paths']['theme_views'] . '/' . $template . '.php';
    $core_path = $paths['paths']['core_views'] . '/' . $template . '.php';

    $file = file_exists($theme_path) ? $theme_path : $core_path;

    extract($data);
    include $file;
}


/**
 * Standard post query wrapper
 * Provides a clean way to fetch posts with defaults
 * 
 * @param array $args WP_Query arguments
 * @return WP_Query
 */
function hasht_get_posts($args = []) {
    $default = [
        'post_type'           => 'post',
        'posts_per_page'      => 5,
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
    ];

    $query_args = wp_parse_args($args, $default);
    return new WP_Query($query_args);
}

