<?php
// Settings
$cat1_title = get_theme_mod('hasht_home_bottom_cat1_title', '');
$cat1_slug  = get_theme_mod('hasht_home_bottom_cat1_slug', '');
$cat1_count = get_theme_mod('hasht_home_bottom_cat1_count', 10);

$cat2_title = get_theme_mod('hasht_home_bottom_cat2_title', '');
$cat2_slug  = get_theme_mod('hasht_home_bottom_cat2_slug', '');
$cat2_count = get_theme_mod('hasht_home_bottom_cat2_count', 10);

$cat3_title = get_theme_mod('hasht_home_bottom_cat3_title', '');
$cat3_slug  = get_theme_mod('hasht_home_bottom_cat3_slug', '');
$cat3_count = get_theme_mod('hasht_home_bottom_cat3_count', 10);

$cat4_title = get_theme_mod('hasht_home_bottom_cat4_title', '');
$cat4_slug  = get_theme_mod('hasht_home_bottom_cat4_slug', '');
$cat4_count = get_theme_mod('hasht_home_bottom_cat4_count', 10);

// Queries
$queries = [];
$configs = [
    1 => ['slug' => $cat1_slug, 'count' => $cat1_count, 'title' => $cat1_title],
    2 => ['slug' => $cat2_slug, 'count' => $cat2_count, 'title' => $cat2_title],
    3 => ['slug' => $cat3_slug, 'count' => $cat3_count, 'title' => $cat3_title],
    4 => ['slug' => $cat4_slug, 'count' => $cat4_count, 'title' => $cat4_title],
];

foreach ($configs as $key => $conf) {
    $args = ['post_type' => 'post', 'posts_per_page' => $conf['count']];
    if ($conf['slug']) {
        $args['cat'] = $conf['slug'];
    }
    $queries[$key] = new WP_Query($args);
}
?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-0 lg:divide-x lg:rtl:divide-x-reverse lg:divide-[#cfcfcf] lg:dark:divide-slate-600 mt-24 mb-16 pt-20 border-t border-slate-200 dark:border-slate-800">
    <?php foreach ($configs as $key => $conf) : 
        $query = $queries[$key];
        // Dynamic padding classes
        $padding_class = 'lg:px-6';
        if ($key === 1) $padding_class = 'lg:pl-6';
        if ($key === 4) $padding_class = 'lg:pr-6';

        // Generate Category Link
        $cat_link = '#';
        if (!empty($conf['slug'])) {
            $cat_link = get_category_link($conf['slug']);
        }
    ?>
    <section class="<?php echo esc_attr($padding_class); ?>">
        <div class="flex items-center justify-between mb-6">
            <h3 class="section-title flex items-center gap-4 text-xl font-medium">
                <div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0">
                    <div class="h-1/3 bg-slate-400"></div>
                    <div class="h-2/3 bg-primary"></div>
                </div>
                <?php echo esc_html($conf['title']); ?>
            </h3>
            <a href="<?php echo esc_url($cat_link); ?>" class="link-more text-sm text-slate-500 hover:text-rose-600 transition-colors flex items-center gap-1">مشاهده بیشتر <i data-lucide="arrow-left" width="12"></i></a>
        </div>
        <div class="space-y-4">
            <?php if ($query->have_posts()) : foreach ($query->posts as $post) : setup_postdata($post); 
                $thumb_url = get_the_post_thumbnail_url($post, 'hasht-medium');
            ?>
            <article class="group cursor-pointer flex flex-col h-full">
                <div class="h-[200px] overflow-hidden rounded-xl mb-4 shrink-0 shadow-md">
                    <a href="<?php echo get_permalink($post); ?>" class="block w-full h-full">
                        <?php if ($thumb_url) : ?>
                            <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr(get_the_title($post)); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <?php else: ?>
                            <div class="w-full h-full bg-slate-200 dark:bg-slate-800 flex items-center justify-center">
                                <span class="text-slate-400 text-xs">بدون تصویر</span>
                            </div>
                        <?php endif; ?>
                    </a>
                </div>
                <div class="flex flex-col flex-1">
                    <h3 class="text-base font-medium text-slate-800 dark:text-slate-100 leading-tight mb-2 group-hover:text-primary transition-colors line-clamp-2 h-[40px]">
                        <a href="<?php echo get_permalink($post); ?>">
                            <?php echo get_the_title($post); ?>
                        </a>
                    </h3>
                    <span class="text-[10px] font-normal text-slate-400 mt-auto block pt-1"><?php echo hasht_time_ago($post->ID); ?></span>
                </div>
            </article>
            <?php endforeach; wp_reset_postdata(); else: ?>
                <p class="text-slate-500 text-sm">مطلبی یافت نشد.</p>
            <?php endif; ?>
        </div>
    </section>
    <?php endforeach; ?>
</div>
