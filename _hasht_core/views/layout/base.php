<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title><?php core_yield('title'); ?></title>

    <?php core_yield('head'); ?>

    <?php wp_head(); ?>
</head>

<body>
    <header>
        <?php if(function_exists('core_view_exists') && core_view_exists('components/header'))  core_view('component/header'); ?>
    </header>

    <main>
        <?php core_yield('content'); ?>
    </main>

    <footer>
        <?php if(function_exists('core_view_exists') && core_view_exists('components/footer'))  core_view('component/footer'); ?>
    </footer>

    <?php core_yield('scripts'); ?>
    <?php wp_footer(); ?>
</body>
</html>