<?php
/**
 * Partial: Company Grid
 * Displays a professional, responsive grid for companies.
 *
 * @var array $args Widget arguments and instances
 */

$title = !empty($args['title']) ? $args['title'] : '';
$count = !empty($args['count']) ? $args['count'] : 6;
$cat = !empty($args['cat']) ? $args['cat'] : 0;
$view_all_text = !empty($args['view_all_text']) ? $args['view_all_text'] : 'لیست همه';

$query_args = [
    'post_type'      => 'company',
    'posts_per_page' => $count,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
];

if ($cat > 0) {
    $query_args['tax_query'] = [
        [
            'taxonomy' => 'company_activity',
            'field'    => 'term_id',
            'terms'    => $cat,
        ],
    ];
}

$query = new WP_Query($query_args);

if (!$query->have_posts()) {
    return;
}
?>

<section class="company-stories-section py-4 overflow-hidden mb-8">
    <?php if ($title) : ?>
        <div class="flex items-center justify-between mb-6 px-4">
            <h3 class="section-title flex items-center gap-4 text-xl font-medium">
                <div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0">
                    <div class="h-1/3 bg-slate-400"></div>
                    <div class="h-2/3 bg-primary"></div>
                </div>
                <?php echo esc_html($title); ?>
            </h3>
            <div class="flex gap-2">
                <a href="<?php echo esc_url(get_post_type_archive_link('company')); ?>" class="link-more text-sm text-slate-500 hover:text-primary transition-colors flex items-center gap-1 font-medium">
                    <?php echo esc_html($view_all_text); ?> <i data-lucide="arrow-left" width="16"></i>
                </a>
            </div>
        </div>
    <?php endif; ?>

    <div class="px-4">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 sm:gap-6">
            <?php foreach ($query->posts as $post) : 
                $post_id = $post->ID;
                $logo_url = get_the_post_thumbnail_url($post_id, 'thumbnail'); 
                $has_logo = !empty($logo_url);
                $company_name = get_the_title($post);
                $permalink = get_permalink($post_id);
            ?>
                <a href="<?php echo esc_url($permalink); ?>" class="flex flex-col items-center gap-3 group/item">
                    <div class="relative group-hover/item:scale-110 transition-transform duration-500">
                        <div class="w-[72px] h-[72px] sm:w-[90px] sm:h-[90px] rounded-full p-[3px] bg-gradient-to-tr from-slate-200 to-slate-300 dark:from-slate-700 dark:to-slate-800">
                            <div class="w-full h-full rounded-full p-[2px] bg-white dark:bg-slate-900">
                                <div class="w-full h-full rounded-full overflow-hidden bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-700 flex items-center justify-center shadow-inner">
                                    <?php if ($has_logo) : ?>
                                        <img 
                                            src="<?php echo esc_url($logo_url); ?>" 
                                            alt="<?php echo esc_attr($company_name); ?>" 
                                            class="w-full h-full object-cover transition-all duration-700 group-hover/item:scale-110"
                                            loading="lazy"
                                        >
                                    <?php else : ?>
                                        <div class="w-full h-full flex flex-col items-center justify-center bg-slate-100 dark:bg-slate-800 text-slate-400">
                                            <i data-lucide="building-2" width="32" class="opacity-50"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="absolute inset-0 rounded-full bg-primary/5 opacity-0 group-hover/item:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                    </div>
                    
                    <span class="text-[11px] sm:text-xs font-bold text-slate-700 dark:text-slate-300 text-center max-w-[90px] sm:max-w-[110px] leading-tight group-hover/item:text-primary transition-colors line-clamp-2 min-h-[2.5em] flex items-center justify-center">
                        <?php echo esc_html($company_name); ?>
                    </span>
                </a>
            <?php endforeach; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
