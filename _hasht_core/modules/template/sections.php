<?php

$GLOBALS['__core_sections'] = [];
$GLOBALS['__core_current_section'] = null;

/**
 * 
 * start a section
 */
if (!function_exists('core_section_start')) {
    function core_start_section(string $name): void
    {
        $GLOBALS['__core_current_section'] = $name;
        ob_start();
    }

    /**
     * 
     * end section
     */
    if (!function_exists('core_end_section')) {
        function core_end_section(): void
        {
            $name = $GLOBALS['__core_current_section'];
            if (!$name) return;

            $content = ob_get_clean();
            $GLOBALS['__core_sections'][$name] = $content;
            $GLOBALS['__core_current_section'] = null;
        }
    }
}

// echo section content
if (!function_exists('core_yield')) {
    function core_yield(string $name): void
    {
        if (isset($GLOBALS['__core_sections'][$name])) {
            echo $GLOBALS['__core_sections'][$name];
        }
    }
}
