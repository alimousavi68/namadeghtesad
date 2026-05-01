<?php

/**
 * 
 * Enqueue System Logic
 */

if (!function_exists('core_enqueue_assets')) {

    function core_enqueue_assets()
    {
        $debug_version = defined('WP_DEBUG') && WP_DEBUG ? (string) time() : null;
        $base_dir = get_template_directory();
        $ver = function ($relative_path) use ($debug_version, $base_dir) {
            if ($debug_version) {
                return $debug_version;
            }
            $full_path = $base_dir . $relative_path;
            $mtime = @filemtime($full_path);
            return $mtime ? (string) $mtime : '1.0.0';
        };

        // 1. Core Static 
        if (file_exists(get_template_directory() . '/_hasht_core/assets/css/core-static.css')) {
            wp_enqueue_style(
                'core-static',
                get_stylesheet_directory_uri() . '/_hasht_core/assets/css/core-static.css',
                [],
                $ver('/_hasht_core/assets/css/core-static.css')
            );
        }

        // 2. Core RTL 
        if (is_rtl() && file_exists(get_template_directory() . '/_hasht_core/assets/css/core-rtl.css')) {
            wp_enqueue_style(
                'core-rtl',
                get_stylesheet_directory_uri() . '/_hasht_core/assets/css/core-rtl.css',
                ['core-static'],
                $ver('/_hasht_core/assets/css/core-rtl.css')
            );
        }

        // 3. Theme Token
        if (file_exists(get_template_directory() . '/assets/css/tokens.css')) {
            wp_enqueue_style(
                'theme-tokens',
                get_stylesheet_directory_uri() . '/assets/css/tokens.css',
                [],
                $ver('/assets/css/tokens.css')
            );
        }

        // 4. Theme Main
        if (file_exists(get_template_directory() . '/assets/css/theme.css')) {
            wp_enqueue_style(
                'theme-main',
                get_stylesheet_directory_uri() . '/assets/css/theme.css',
                ['core-static', 'theme-tokens'],
                $ver('/assets/css/theme.css')
            );
        }

        // 5. Theme Style.css
        $style_mtime = @filemtime(get_stylesheet_directory() . '/style.css');
        wp_enqueue_style('theme-style', get_stylesheet_uri(), ['theme-main'], $debug_version ?: ($style_mtime ? (string) $style_mtime : '1.0.0'));


        // --- JavaScript ---

        // 1. Core JS
        if (file_exists(get_template_directory() . '/_hasht_core/assets/js/core.js')) {
            wp_enqueue_script(
                'core-js',
                get_stylesheet_directory_uri() . '/_hasht_core/assets/js/core.js',
                ['jquery'],
                $ver('/_hasht_core/assets/js/core.js'),
                true
            );
        }

        // 2. Theme JS (Redundant - logic merged into main.js)
        /*
        if (file_exists(get_template_directory() . '/assets/js/theme.js')) {
            wp_enqueue_script(
                'theme-js',
                get_stylesheet_directory_uri() . '/assets/js/theme.js',
                ['core-js'],
                $ver('/assets/js/theme.js'),
                true
            );
        }
        */
    }
}


add_action('wp_enqueue_scripts', 'core_enqueue_assets');
