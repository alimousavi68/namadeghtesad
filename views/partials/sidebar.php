<!-- Sidebar Content -->
<div class="space-y-5 sticky top-4">
    <?php if (is_active_sidebar('main-sidebar')) : ?>
        <?php dynamic_sidebar('main-sidebar'); ?>
    <?php else : ?>
        <!-- Most Viewed Widget -->
        <?php core_view('partials/widget-most-viewed'); ?>

        <!-- Latest News Widget -->
        <?php core_view('partials/widget-latest-news'); ?>

        <!-- Market Widget -->
        <?php core_view('partials/widget-market'); ?>

        <!-- Ad Box -->
        <?php core_view('partials/widget-advertisement'); ?>
    <?php endif; ?>
</div>