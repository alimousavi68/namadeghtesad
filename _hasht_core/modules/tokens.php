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

/**
 * Generate CSS variables from Customizer settings dynamically (fallback)
 */
if (!function_exists('core_generate_tokens_css')) {
    function core_generate_tokens_css() {
        if (!class_exists('Core_Customizer_Logic')) {
            return '';
        }
        $config = Core_Customizer_Logic::get_config();
        $tokens = [];

        foreach ($config as $section) {
            if (!empty($section['fields'])) {
                foreach ($section['fields'] as $key => $props) {
                    $default = isset($props['default']) ? $props['default'] : '';
                    $value = get_theme_mod($key, $default);
                    $token_key = str_replace('_', '-', $key);
                    $tokens[$token_key] = $value;
                }
            }

            if (!empty($section['sections']) && is_array($section['sections'])) {
                foreach ($section['sections'] as $subsection) {
                    if (empty($subsection['fields']) || !is_array($subsection['fields'])) {
                        continue;
                    }

                    foreach ($subsection['fields'] as $key => $props) {
                        $default = isset($props['default']) ? $props['default'] : '';
                        $value = get_theme_mod($key, $default);
                        $token_key = str_replace('_', '-', $key);
                        $tokens[$token_key] = $value;
                    }
                }
            }
        }

        $root_vars = [];
        $dark_vars = [];

        foreach ($tokens as $key => $value) {
            $clean_key = str_replace('_', '-', $key);
            $clean_value = strip_tags($value);

            if (substr($clean_key, -5) === '-dark') {
                $base_key = substr($clean_key, 0, -5);
                $dark_vars[$base_key] = $clean_value;
            } else {
                $root_vars[$clean_key] = $clean_value;
            }
        }

        $css = ":root {\n";
        foreach ($root_vars as $k => $v) {
            $css .= "    --{$k}: {$v};\n";
        }
        $css .= "}\n";

        if (!empty($dark_vars)) {
            $css .= "\n[data-theme=\"dark\"] {\n";
            foreach ($dark_vars as $k => $v) {
                $css .= "    --{$k}: {$v};\n";
            }
            $css .= "}\n";
        }

        return $css;
    }
}
