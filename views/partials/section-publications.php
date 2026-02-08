<?php
// Settings
$title    = get_theme_mod('hasht_home_publications_title', '');
$subtitle = get_theme_mod('hasht_home_publications_subtitle', '');
$cat_slug = get_theme_mod('hasht_home_publications_cat', '');
$count    = get_theme_mod('hasht_home_publications_count', 10);

$args = [
    'post_type'      => 'post',
    'posts_per_page' => $count,
    'post_status'    => 'publish',
];
if ($cat_slug) {
    $args['cat'] = $cat_slug;
}
$query = new WP_Query($args);
?>
<section class="bg-slate-100 dark:bg-slate-900/50 py-16 px-4 rounded-xl my-16 border border-slate-200 dark:border-slate-800 transition-colors">
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-12 gap-6">
            <div>
                <h3 class="text-3xl font-black text-slate-900 dark:text-white mb-2 flex items-center gap-3">
                    <i data-lucide="file-text" class="text-primary" width="32"></i>
                    <?php echo esc_html($title); ?>
                </h3>
                <p class="text-base text-slate-500 dark:text-slate-400 font-medium"><?php echo esc_html($subtitle); ?></p>
            </div>
            <button class="link-more font-black hover:gap-3 border-b-2 border-secondary/20 pb-1">
                مشاهده بیشتر <i data-lucide="arrow-left" width="12"></i>
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php if ($query->have_posts()) : ?>
                <?php foreach ($query->posts as $post) : setup_postdata($post); 
                    $thumb_url = get_the_post_thumbnail_url($post, 'hasht-portrait');
                   
                ?>
                <article class="group bg-white dark:bg-slate-900 p-5 rounded-xl flex flex-col shadow-sm hover:shadow-xl transition-all cursor-pointer border border-slate-100 dark:border-slate-800 relative">
                    <div class="aspect-[3/4] rounded-xl overflow-hidden mb-6 shadow-2xl transition-transform group-hover:-translate-y-2">
                        <a href="<?php echo get_permalink($post); ?>" class="block w-full h-full">
                            <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr(get_the_title($post)); ?>" class="w-full h-full object-cover">
                        </a>
                    </div>
                    <div class="flex flex-col flex-1">
                        <div class="mb-4">
                             <?php
                                $pub_type = get_post_meta($post->ID, '_news_publication_type', true);
                                if ( $pub_type ) {
                                    echo '<span class="inline-block px-3 py-1 rounded-full bg-rose-50 dark:bg-rose-900/30 text-primary dark:text-rose-400 text-[11px] font-black mb-3">' . esc_html( $pub_type ) . '</span>';
                                }
                            ?>
                            <h4 class="text-lg font-black text-slate-800 dark:text-slate-100 leading-tight mb-3 group-hover:text-primary transition-colors">
                                <a href="<?php echo get_permalink($post); ?>">
                                    <?php echo get_the_title($post); ?>
                                </a>
                            </h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-3 leading-relaxed">
                                <?php echo get_the_excerpt($post); ?>
                            </p>
                        </div>
                        <div class="mt-auto pt-4 border-t border-slate-50 dark:border-slate-800 flex items-center justify-between">
                            <span class="text-[10px] font-normal text-slate-400"><?php echo get_the_date('F Y', $post); ?></span>
                            <button class="text-[11px] font-black text-primary flex items-center gap-1">دریافت PDF</button>
                        </div>
                    </div>
                </article>
                <?php endforeach; wp_reset_postdata(); ?>
            <?php else : ?>
                <p class="text-center w-full col-span-4 text-slate-500">مطلبی یافت نشد.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
