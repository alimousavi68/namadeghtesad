<?php 
// config.php --Core setting

return [
    // فعال یا غیرفعال کردن ماژول ها
    'modules' => [
        'customizer' => true,
        'tokens' => true,
        'enqueue' => true,
        'template' => true,
    ],
    'paths' => [
        'core_views' => __DIR__ . '/views', // کامپوننت‌ها و layout های core
        'theme_views' => get_stylesheet_directory() . '/views', // فایل‌های اختصاصی قالب
        'assets' => get_stylesheet_directory(). '/assets' ,
    ],
];