<?php 
// loader.php
// simple view loader for Core + theme override
// Usage: core_view ('components/button', ['label'=>'Click me']);

if (!function_exists('core_get_view_path')){
    function core_get_view_path(string $relative): ?string{
        // path from config (assume config return array)
        $cfg = require dirname(__DIR__,2).'/config.php';
        $themeViews = rtrim($cfg['paths']['theme_views'],'/');
        $coreViews  = rtrim($cfg['paths']['core_views'],'/');

        $themePath = $themeViews. '/' . $relative . '.php';
        $corePath = $coreViews . '/' . $relative . '.php';

        error_log('this error:' . $themePath);
        if (file_exists($themePath)) return $themePath;
        if (file_exists($corePath)) return $corePath;

        return null;

    }
}

if ( !function_exists('core_view'))
{
    /**
     * Render a view from theme/view or fall back to core/view 
     * @param  string $relative path relative to view / with out .php , e.g . 'components/button'
     * @param array $data data to extract into view scope
     * @return void
     */

    function core_view(string $relative, array $data=[]):void{
        $path = core_get_view_path($relative);

        if (!$path){
            // optinal : trigger error or fallback silent 
            trigger_error("core view : view not found : {$relative}", E_USER_WARNING);
            return;
        }

        // extract variable safely : existing variables won't be overwritten
        if (!empty($data))
        {
            extract($data, EXTR_SKIP);
        }

        include $path;
    }
}

if (!function_exists('core_view_exists')){
    function core_view_exists(string $relative):bool{
        return core_get_view_path($relative)!==null;
    }
}