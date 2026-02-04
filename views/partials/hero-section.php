        <?php
// Retrieve Customizer Settings
$cat_slug   = get_theme_mod('hasht_home_hero_cat', '');
$count      = get_theme_mod('hasht_home_hero_count', 4);

// Build Query Arguments
$args = [
    'post_type'           => ['post'], // Fixed to standard types
    'posts_per_page'      => $count,
    'post_status'         => 'publish',
    'orderby'             => 'date',
    'order'               => 'DESC',
];

if (!empty($cat_slug)) {
    $args['cat'] = $cat_slug;
}

$hero_query = new WP_Query($args);


if ($hero_query->have_posts()) :
    $posts = $hero_query->posts;
    
    // Distribute posts
    $lead_post     = isset($posts[0]) ? $posts[0] : null;
    $middle_vert   = isset($posts[1]) ? $posts[1] : null;
    $middle_thumbs = array_slice($posts, 2, 2);
    $selected_list = array_slice($posts, 4);
?>
<section class="bg-white dark:bg-slate-900/30 border-b border-slate-200 dark:border-slate-800 pt-8 pb-12 lg:pt-8 lg:pb-12">
    <div class="container mx-auto px-0 md:px-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-3 lg:gap-4 items-start">

            <!-- Lead News -->
            <div class="lg:col-span-6 lg:border-l lg:border-slate-100 lg:dark:border-slate-800 lg:pl-4 relative mb-8 lg:mb-0 px-4 lg:px-0">
                <?php if ($lead_post): 
                    $post = $lead_post; setup_postdata($post);
                    $thumb_url = get_the_post_thumbnail_url($post, 'large'); // Use large size
                    $category = get_the_category($post->ID);
                    $cat_name = !empty($category) ? $category[0]->name : '';
                    $cat_link = !empty($category) ? get_category_link($category[0]->term_id) : '#';
                ?>
                <div class="relative group cursor-pointer w-full">
                    <div class="w-full h-[400px] lg:h-[430px] relative overflow-hidden rounded-xl shadow-xl bg-slate-900">
                        <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                            <?php if ($thumb_url): ?>
                                <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000 opacity-90 group-hover:opacity-100">
                            <?php else: ?>
                                <div class="w-full h-full bg-slate-200 flex items-center justify-center text-slate-400">بدون تصویر</div>
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="absolute -bottom-8 lg:-bottom-12 left-1/2 -translate-x-1/2 w-[90%] bg-white dark:bg-slate-900 p-4 lg:p-7 transition-transform duration-500 group-hover:-translate-y-2 z-20 border border-slate-100 dark:border-slate-800 rounded-t-xl">
                        <div class="pt-2 pb-2">
                            <h2 class="text-lg lg:text-2xl font-black text-slate-900 dark:text-white leading-tight group-hover:text-primary dark:group-hover:text-primary transition-colors">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="mt-3 flex items-center text-slate-400 text-[10px] lg:text-xs font-bold gap-3">
                                <span><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' پیش'; ?></span>
                                <span class="w-1 h-1 rounded-full bg-slate-200 dark:bg-slate-800"></span>
                                <a href="<?php the_permalink(); ?>" class="text-primary">مشاهده کامل گزارش</a>
                            </div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 h-1.5 flex overflow-hidden">
                            <div class="w-1/4 bg-slate-400"></div>
                            <div class="w-3/4 bg-primary"></div>
                        </div>
                    </div>
                </div>
                <?php wp_reset_postdata(); endif; ?>
            </div>

            <!-- Middle Column -->
            <div class="lg:col-span-3 flex flex-col gap-2 lg:border-l lg:border-slate-100 lg:dark:border-slate-800 lg:pl-4 px-4 lg:px-0">
                <!-- Vertical Card -->
                <?php if ($middle_vert): 
                    $post = $middle_vert; setup_postdata($post);
                    $thumb_url = get_the_post_thumbnail_url($post, 'medium_large');
                    $category = get_the_category($post->ID);
                    $cat_name = !empty($category) ? $category[0]->name : '';
                ?>
                <div class="h-auto">
                    <div class="group cursor-pointer flex flex-row lg:flex-col gap-4 lg:gap-0 h-full items-center lg:items-start">
                        <div class="w-20 lg:w-full aspect-[3/2] lg:aspect-[16/10] overflow-hidden rounded-xl mb-0 lg:mb-2 shrink-0 shadow-md">
                            <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                                <?php if ($thumb_url): ?>
                                    <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <?php else: ?>
                                    <div class="w-full h-full bg-slate-200"></div>
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="flex flex-col flex-1">
                            <?php if ($cat_name): ?>
                                <span class="text-[10px] font-black text-primary mb-1 hidden lg:block uppercase"><?php echo esc_html($cat_name); ?></span>
                            <?php endif; ?>
                            <h3 class="text-sm lg:text-base font-black text-slate-800 dark:text-slate-100 leading-tight mb-2 group-hover:text-primary transition-colors line-clamp-2">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <span class="text-[10px] text-slate-400 mt-auto block pt-1"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' پیش'; ?></span>
                        </div>
                    </div>
                </div>
                <?php wp_reset_postdata(); endif; ?>

                <!-- Thumbs -->
                <div class="flex flex-col divide-y divide-slate-100 dark:divide-slate-800">
                    <?php foreach ($middle_thumbs as $post): setup_postdata($post); 
                        $thumb_url = get_the_post_thumbnail_url($post, 'thumbnail');
                    ?>
                    <div class="flex items-center gap-3 py-1 group cursor-pointer border-b border-slate-100 dark:border-slate-800 last:border-none">
                        <div class="w-20 aspect-[3/2] lg:w-28 shrink-0 overflow-hidden rounded-lg shadow-sm">
                            <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                                <?php if ($thumb_url): ?>
                                    <img src="<?php echo esc_url($thumb_url); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="<?php the_title_attribute(); ?>">
                                <?php else: ?>
                                    <div class="w-full h-full bg-slate-200"></div>
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="flex flex-col justify-center">
                            <h4 class="text-sm font-bold text-slate-800 dark:text-slate-200 line-clamp-2 leading-snug group-hover:text-primary transition-colors">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                            <span class="text-[10px] font-black text-slate-400 mt-1"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' پیش'; ?></span>
                        </div>
                    </div>
                    <?php endforeach; wp_reset_postdata(); ?>
                </div>
            </div>

            <!-- Selected News (Left Column) replaced by Market Widget -->
            <aside class="lg:col-span-3 px-4 lg:px-0 mt-8 lg:mt-0">
                <?php core_view('partials/widget-market'); ?>
            </aside>

        </div>
    </div>
</section>
<?php endif; ?>

