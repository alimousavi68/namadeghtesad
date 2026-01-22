<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="rtl">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php core_yield('title'); ?></title>

    <?php core_view('partials/head'); ?>

    <?php core_yield('head'); ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class('transition-colors duration-300'); ?>>
    
    <?php 
    // نمایش منوی موبایل
    if (core_view_exists('partials/mobile-menu')) {
        core_view('partials/mobile-menu');
    }

    // نمایش هدر از پوشه partials
    if (core_view_exists('partials/header')) {
        core_view('partials/header');
    }
    ?>

    <main id="main-content" class="flex-1 pb-16">
        <?php core_yield('content'); ?>
    </main>

    <?php 
    // نمایش فوتر از پوشه partials
    if (core_view_exists('partials/footer')) {
        core_view('partials/footer');
    }
    ?>

    <?php core_yield('scripts'); ?>
    <?php wp_footer(); ?>
</body>
</html>
