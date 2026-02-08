<?php

/**
 * 
 * Token Module Entry Point
 * 
 */

require_once __DIR__ . '/tokens/compiler.php';

/**
 * Helper function to compile token manually
 */

if (!function_exists('core_compile_tokens')) {
    function core_compile_tokens($tokens)
    {
        return Core_Token_Compiler::compile($tokens);
    }
}

/**
 * Setup Default Tokens (Temporary)
 * This ensures we always have a base token file even before Customizer is ready.
 */
add_action('after_switch_theme', function () {
    $default_tokens = [
        'color-primary' => '#3b82f6',   // Default Blue
        'color-secondary' => '#10b981', // Default Green
        'font-base' => '16px',
        'container-width' => '1200px',
        'spacing-unit' => '1rem',
    ];

    // Only compile if file doesn't exist to avoid overwriting user settings
    if (!file_exists(get_stylesheet_directory() . '/assets/css/tokens.css')) {
        core_compile_tokens($default_tokens);
    }
});
