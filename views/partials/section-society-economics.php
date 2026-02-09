<?php
// Retrieve settings
$title    = get_theme_mod('hasht_home_society_title', '');
$cat_id   = get_theme_mod('hasht_home_society_cat', '');
$count    = get_theme_mod('hasht_home_society_count', 4);

// Query
$args = [
    'post_type'      => ['post'],
    'posts_per_page' => $count,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
];
if ($cat_id) {
    $args['cat'] = $cat_id;
}
$query = new WP_Query($args);

// Link to category if selected
$cat_link = '#';
if ($cat_id) {
    $cat_link = get_category_link($cat_id);
}
?>

<?php if ($query->have_posts()) : ?>
<section class="mb-16">
    <div class="flex items-center justify-between mb-8">
        <h3 class="section-title flex items-center gap-4 text-xl font-medium">
            <div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0">
                <div class="h-1/3 bg-slate-400"></div>
                <div class="h-2/3 bg-primary"></div>
            </div>
            <?php echo esc_html($title); ?>
        </h3>
        <a href="<?php echo esc_url($cat_link); ?>"
            class="link-more">
            مشاهده بیشتر <i data-lucide="arrow-left" width="12"></i>
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
        <?php foreach ($query->posts as $post) : setup_postdata($post); 
             $thumb_url = get_the_post_thumbnail_url($post, 'hasht-medium');
        ?>
        <article class="news-card-v group">
            <div class="news-card-v-img-wrapper rounded-xl overflow-hidden aspect-[16/10]">
                <a href="<?php echo get_permalink($post); ?>" class="block w-full h-full">
                    <?php if ($thumb_url): ?>
                        <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr(get_the_title($post)); ?>"
                            class="news-card-v-img w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <?php else: ?>
                        <div class="w-full h-full bg-slate-200"></div>
                    <?php endif; ?>
                </a>
            </div>
            <div class="news-card-v-content">
                <h3 class="news-card-v-title">
                    <a href="<?php echo get_permalink($post); ?>"><?php echo get_the_title($post); ?></a>
                </h3>
                <span class="meta-text mt-auto block pt-1 text-[10px] font-normal text-slate-400 dark:text-slate-500"><?php echo human_time_diff(get_the_time('U', $post), current_time('timestamp')) . ' پیش'; ?></span>
            </div>
        </article>
        <?php endforeach; wp_reset_postdata(); ?>
    </div>
</section>
<?php endif; ?>

