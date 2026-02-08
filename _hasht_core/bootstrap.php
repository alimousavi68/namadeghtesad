<?php 
// bootstrap.php -- Core entry point


// Load config
$config = require __DIR__ . '/config.php';

// Load helpers
require_once __DIR__.'/helpers.php';

// Load modules 
foreach ($config['modules'] as $module => $active){
    if ($active){
        $module_file = __DIR__. '/modules/' . $module. '.php';
        // if ($module =='tokens') core_dd('sf:' . $module_file);
        if(file_exists($module_file)){
            require_once $module_file;
        }
    }
}