<?php

/**
 * Core Customizer Logic
 * 
 * 
 * This class acts as a registry and factory for Customizer settings.
 * It reads configuration files from the 'sections' directory and registers them.
 */


class Core_Customizer_Logic
{

    /**
     * cache for configuration
     */
    private static $config = null;

    /**
     * 
     * load all configuration files from the 'section' directory
     * 
     * @return array combined configuration array
     */
    public static function get_config()
    {
        if (self::$config !== null) {
            return self::$config;
        }

        $config = [];
        
        // 1. Core Sections
        $core_dir = __DIR__ . '/sections/';
        $config = self::load_files_from_dir($core_dir, $config);

        // 2. Theme Sections (Extendable)
        $theme_dir = get_template_directory() . '/inc/customizer/sections/';
        $config = self::load_files_from_dir($theme_dir, $config);

        self::$config = $config;
        return $config;
    }

    /**
     * Helper to load php files from a directory
     */
    private static function load_files_from_dir($dir, $current_config) {
        if (is_dir($dir)) {
            $files = glob($dir . '*.php');
            foreach ($files as $file) {
                $section_config = require $file;
                if (is_array($section_config)) {
                    $current_config = array_merge($current_config, $section_config);
                }
            }
        }
        return $current_config;
    }



    /**
     * 
     * Register everything in Wordpress
     * 
     */

    public static function register($wp_customize)
    {
        $config = self::get_config();

        foreach ($config as $id => $data) {
            
            // Check type (panel or section) - default is section for backward compatibility
            $type = isset($data['type']) ? $data['type'] : 'section';

            if ($type === 'panel') {
                // 1. Register Panel
                $wp_customize->add_panel($id, [
                    'title'       => $data['title'],
                    'priority'    => isset($data['priority']) ? $data['priority'] : 10,
                    'description' => isset($data['description']) ? $data['description'] : ''
                ]);

                // 2. Process Sections inside Panel
                if (!empty($data['sections'])) {
                    foreach ($data['sections'] as $sec_id => $sec_data) {
                        $sec_args = [
                            'title'       => $sec_data['title'],
                            'priority'    => isset($sec_data['priority']) ? $sec_data['priority'] : 10,
                            'description' => isset($sec_data['description']) ? $sec_data['description'] : '',
                            'panel'       => $id // Link to parent panel
                        ];
                        $wp_customize->add_section($sec_id, $sec_args);

                        // 3. Process Fields inside Section
                        if (!empty($sec_data['fields'])) {
                            foreach ($sec_data['fields'] as $setting_id => $field_data) {
                                self::add_field($wp_customize, $sec_id, $setting_id, $field_data);
                            }
                        }
                    }
                }

            } else {
                // Standard Section (Top Level)
                $wp_customize->add_section($id, [
                    'title'       => $data['title'],
                    'priority'    => isset($data['priority']) ? $data['priority'] : '',
                    'description' => isset($data['description']) ? $data['description'] : ''
                ]);

                if (!empty($data['fields'])) {
                    foreach ($data['fields'] as $setting_id => $field_data) {
                        self::add_field($wp_customize, $id, $setting_id, $field_data);
                    }
                }
            }
        }
    }

    /**
     *Helper to add single field  (setting+ control)
     */
    private static function add_field($wp_customize, $section_id, $setting_id, $field_data)
    {

        // A. Add Setting
        $wp_customize->add_setting($setting_id, [
            'defualt' => isset($field_data['defualt']) ? $field_data['defualt'] : '',
            'transport' => isset($field_data['transport']) ? $field_data['transport'] : 'refresh',
            'sanitize_callback' => isset($field_data['sanitize_callback']) ? $field_data['sanitize_callback'] : 'sanitize_text_field',
        ]);

        // B. Add Control (Factory pattern)
        $control_args = [
            'label'       => $field_data['label'],
            'section'     => $section_id,
            'description' => isset($field_data['description']) ? $field_data['description'] : '',
            'choices'     => isset($field_data['choices']) ? $field_data['choices'] : [], // For select/radio
        ];

        $type = isset($field_data['type']) ? $field_data['type'] : 'text';


        switch ($type) {
            case 'color':
                $wp_customize->add_control(new WP_Customize_Color_Control(
                    $wp_customize,
                    $setting_id,
                    $control_args
                ));
                break;

            case 'image':
            case 'upload':
                $wp_customize->add_control(new WP_Customize_Upload_Control(
                    $wp_customize,
                    $setting_id,
                    $control_args
                ));
                break;

            // Add more custom controls here (e.g., date, media, etc.)

            default:
                // Standard input types (text, textarea, checkbox, select, etc.)
                $control_args['type'] = $type;
                $wp_customize->add_control($setting_id, $control_args);
                break;
        }
    }


    /**
     * 
     * Compile settings into token.css
     */
    public static function compile_settings($manager)
    {
        $config = self::get_config();
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

        // call the compiler module
        if (function_exists('core_compile_tokens')) {
            core_compile_tokens($tokens);
        }
    }
}
