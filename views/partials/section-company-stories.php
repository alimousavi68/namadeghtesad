<?php
/**
 * Partial: Company Stories
 * Displays a professional, responsive Instagram-style story carousel for companies.
 *
 * @var array $args Widget arguments and instances
 */

$title = !empty($args['title']) ? $args['title'] : '';
$count = !empty($args['count']) ? $args['count'] : 12;
$show_name = isset($args['show_name']) ? $args['show_name'] : true;
$cat = !empty($args['cat']) ? $args['cat'] : 0;
$visible_items = !empty($args['visible_items']) ? $args['visible_items'] : 8;
$autoplay = isset($args['autoplay']) ? (bool) $args['autoplay'] : false;

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
                <button class="swiper-prev-stories w-10 h-10 flex items-center justify-center rounded-full border border-slate-200 dark:border-slate-700 text-slate-400 hover:text-primary hover:border-primary transition-all disabled:opacity-30 disabled:pointer-events-none">
                    <i data-lucide="chevron-right" width="20"></i>
                </button>
                <button class="swiper-next-stories w-10 h-10 flex items-center justify-center rounded-full border border-slate-200 dark:border-slate-700 text-slate-400 hover:text-primary hover:border-primary transition-all disabled:opacity-30 disabled:pointer-events-none">
                    <i data-lucide="chevron-left" width="20"></i>
                </button>
            </div>
        </div>
    <?php endif; ?>

    <div class="relative px-4">
        <!-- Shadow Box Container (No background color as requested, but shadow enabled) -->
        <div class="rounded-3xl  border border-slate-100 dark:border-slate-800/50">
            <div class="swiper companyStoriesSwiper">
                <div class="swiper-wrapper !ease-out">
                    <?php foreach ($query->posts as $post) : 
                        $post_id = $post->ID;
                        // Use 'thumbnail' size as requested (smallest appropriate)
                        $logo_url = get_the_post_thumbnail_url($post_id, 'thumbnail'); 
                        $has_logo = !empty($logo_url);
                        if (!$has_logo) {
                            // Using a consistent UI placeholder instead of a missing file
                            $logo_url = ''; 
                        }
                        $company_name = get_the_title($post);
                        $permalink = get_permalink($post_id);
                    ?>
                        <div class="swiper-slide !w-[100px] sm:!w-[120px]">
                            <a href="<?php echo esc_url($permalink); ?>" class="flex flex-col items-center gap-3 group/item">
                                <!-- Instagram Style Ring -->
                                <div class="relative group-hover/item:scale-110 transition-transform duration-500">
                                    <!-- Fit and Fill: Ensuring the image fills the circle container -->
                                    <div class="w-[72px] h-[72px] sm:w-[90px] sm:h-[90px] rounded-full p-[3px] bg-gradient-to-tr from-[#f9ce34] via-[#ee2a7b] to-[#6228d7] animate-story-ring">
                                        <div class="w-full h-full rounded-full p-[2px] bg-white dark:bg-slate-900">
                                            <div class="w-full h-full rounded-full overflow-hidden bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-700 flex items-center justify-center">
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
                                    
                                    <!-- Hover Overlay -->
                                    <div class="absolute inset-0 rounded-full bg-primary/5 opacity-0 group-hover/item:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                                </div>
                                
                                <?php if ($show_name) : ?>
                                    <!-- Long name support: Removed truncate, added line-clamp-2 or wrapping -->
                                    <span class="text-[11px] sm:text-xs font-bold text-slate-700 dark:text-slate-300 text-center max-w-[90px] sm:max-w-[110px] leading-tight group-hover/item:text-primary transition-colors line-clamp-2 min-h-[2.5em] flex items-center justify-center">
                                        <?php echo esc_html($company_name); ?>
                                    </span>
                                <?php endif; ?>
                            </a>
                        </div>
                    <?php endforeach; wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.animate-story-ring {
    background-size: 200% 200%;
    animation: story-gradient-shift 4s ease infinite;
}
@keyframes story-gradient-shift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Swiper !== 'undefined') {
        const storiesContainer = document.querySelector('.companyStoriesSwiper');
        const slideCount = storiesContainer ? storiesContainer.querySelectorAll('.swiper-slide').length : 0;
        
        const swiper = new Swiper('.companyStoriesSwiper', {
            slidesPerView: 'auto',
            spaceBetween: 16,
            loop: slideCount >= 5, // Loop works best with more slides
            loopedSlides: slideCount >= 5 ? slideCount : null,
            loopAdditionalSlides: 3,
            centeredSlides: false,
            <?php if ($autoplay) : ?>
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            <?php endif; ?>
            freeMode: {
                enabled: true,
                sticky: true,
                momentumBounce: false,
            },
            grabCursor: true,
            mousewheel: {
                forceToAxis: true,
            },
            navigation: {
                nextEl: '.swiper-next-stories',
                prevEl: '.swiper-prev-stories',
            },
            breakpoints: {
                640: {
                    spaceBetween: 20,
                },
                768: {
                    spaceBetween: 24,
                },
                1024: {
                    spaceBetween: 28,
                }
            },
            on: {
                init: function() {
                    // Lucide icons are initialized globally in main.js
                }
            }
        });
    }
});
</script>
