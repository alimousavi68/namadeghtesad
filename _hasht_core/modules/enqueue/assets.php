<?php

/**
 * 
 * Enqueue System Logic
 */

if (!function_exists('core_enqueue_assets')) {

    function core_enqueue_assets()
    {
        // if wp debug is true assets is not cached
        $version = defined('WP_DEBUG') && WP_DEBUG ? time() : '1.0.0';

        // 1. Core Static 
        if (file_exists(get_template_directory() . '/_hasht_core/assets/css/core-static.css')) {
            wp_enqueue_style(
                'core-static',
                get_stylesheet_directory_uri() . '/_hasht_core/assets/css/core-static.css',
                [],
                $version
            );
        }

        // 2. Core RTL 
        if (is_rtl() && file_exists(get_template_directory() . '/_hasht_core/assets/css/core-rtl.css')) {
            wp_enqueue_style(
                'core-rtl',
                get_stylesheet_directory_uri() . '/_hasht_core/assets/css/core-rtl.css',
                ['core-static'],
                $version
            );
        }

        // 3. Theme Token
        if (file_exists(get_template_directory() . '/assets/css/tokens.css')) {
            wp_enqueue_style(
                'theme-tokens',
                get_stylesheet_directory_uri() . '/assets/css/tokens.css',
                [],
                $version
            );
        }

        // 4. Theme Main
        if (file_exists(get_template_directory() . '/assets/css/theme.css')) {
            wp_enqueue_style(
                'theme-main',
                get_stylesheet_directory_uri() . '/assets/css/theme.css',
                ['core-static', 'theme-tokens'],
                $version
            );
        }

        // 5. Theme Style.css
        wp_enqueue_style('theme-style', get_stylesheet_uri(), ['theme-main'], $version);

        // 6. Theme Tables CSS
        if (file_exists(get_template_directory() . '/assets/css/theme-tables.css')) {
            wp_enqueue_style(
                'theme-tables',
                get_stylesheet_directory_uri() . '/assets/css/theme-tables.css',
                ['theme-main'],
                $version
            );
        }


        // --- JavaScript ---

        // 1. Core JS
        if (file_exists(get_template_directory() . '/_hasht_core/assets/js/core.js')) {
            wp_enqueue_script(
                'core-js',
                get_stylesheet_directory_uri() . '/_hasht_core/assets/js/core.js',
                ['jquery'],
                $version,
                true
            );
        }

        // 2. Theme JS
        if (file_exists(get_template_directory() . '/assets/js/theme.js')) {
            wp_enqueue_script(
                'theme-js',
                get_stylesheet_directory_uri() . '/assets/js/theme.js',
                ['core-js'],
                $version,
                true
            );
        }
    }
}


add_action('wp_enqueue_scripts', 'core_enqueue_assets');
