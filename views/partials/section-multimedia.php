<?php
// Retrieve settings
$title    = get_theme_mod('hasht_home_multimedia_title', 'چندرسانه‌ای');
$subtitle = get_theme_mod('hasht_home_multimedia_subtitle', 'تازه‌ترین گفتگوهای اختصاصی');
$cat_slug = get_theme_mod('hasht_home_multimedia_cat', '');
$count    = get_theme_mod('hasht_home_multimedia_count', 3);

// Query
$args = [
    'post_type'      => ['post', 'aggregated_news'],
    'posts_per_page' => $count,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
];
if ($cat_slug) {
    $args['category_name'] = $cat_slug;
}
$query = new WP_Query($args);

// Link to category if selected
$cat_link = '#';
if ($cat_slug) {
    $cat_obj = get_category_by_slug($cat_slug);
    if ($cat_obj) {
        $cat_link = get_category_link($cat_obj->term_id);
    }
}
?>

<?php if ($query->have_posts()) : ?>
<section class="bg-slate-900 dark:bg-slate-950 rounded-xl p-8 md:p-10 text-white shadow-2xl relative overflow-hidden group">

    <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary/10 blur-[150px] rounded-full"></div>
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6 relative z-10 gap-8">
        <div>
            <h3 class="text-2xl font-bold text-white mb-4 flex items-center gap-4">
                <div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0">
                    <div class="h-1/3 bg-slate-400"></div>
                    <div class="h-2/3 bg-primary"></div>
                </div>
                <?php echo esc_html($title); ?>
            </h3>
            <p class="text-text-light text-lg font-medium"><?php echo esc_html($subtitle); ?></p>
        </div>
        <a href="<?php echo esc_url($cat_link); ?>"
            class="flex items-center gap-1 text-sm font-bold text-white/70 hover:text-primary transition-all">
            مشاهده آرشیو <i data-lucide="arrow-left" width="16"></i>
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative z-10">
        <?php while ($query->have_posts()) : $query->the_post(); 
             $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
        ?>
        <!-- Video Item -->
        <div class="group/item cursor-pointer">
            <div class="relative aspect-video rounded-3xl overflow-hidden mb-8 bg-slate-800 shadow-2xl ring-1 ring-white/10">
                <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                    <?php if ($thumb_url): ?>
                        <img src="<?php echo esc_url($thumb_url); ?>" class="w-full h-full object-cover opacity-60 group-hover/item:scale-110 group-hover/item:opacity-90 transition-all duration-1000" alt="<?php the_title_attribute(); ?>">
                    <?php else: ?>
                        <div class="w-full h-full bg-slate-700 opacity-60"></div>
                    <?php endif; ?>
                    <div class="absolute inset-0 flex items-center justify-center bg-black/30 group-hover/item:bg-transparent transition-colors">
                        <div class="w-20 h-20 rounded-full bg-primary flex items-center justify-center group-hover/item:bg-rose-300 group-hover/item:scale-110 transition-all shadow-2xl border-4 border-slate-400">
                            <i data-lucide="play" fill="white" class="text-white ml-1.5" width="32"></i>
                        </div>
                    </div>
                </a>
            </div>
            <h4 class="font-black text-lg leading-relaxed line-clamp-2 group-hover/item:text-rose-400 transition-colors">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h4>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
</section>
<?php endif; ?>

