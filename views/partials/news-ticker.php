<?php
$enable = get_theme_mod('hasht_home_ticker_enable', true);
if (!$enable) return;

$title = get_theme_mod('hasht_home_ticker_title', 'اخبار فوری');
$cat   = get_theme_mod('hasht_home_ticker_cat', '');
$count = get_theme_mod('hasht_home_ticker_count', 5);
$speed = 300; // Hardcoded reasonable speed (seconds)

$args = [
    'post_type'      => 'post',
    'posts_per_page' => $count,
    'post_status'    => 'publish',
];
if ($cat) {
    $args['category_name'] = $cat;
}
$ticker_query = new WP_Query($args);

if ($ticker_query->have_posts()) :
    $posts = $ticker_query->posts;
?>
<aside class="bg-primary text-white overflow-hidden h-9 md:h-9 flex items-center w-full z-40 relative" aria-label="News Ticker">
    <div
        class="flex items-center bg-secondary text-white px-4 h-full shrink-0 font-bold text-sm gap-2 z-10 shadow-lg">
        <i data-lucide="circle" width="8" fill="currentColor" class="animate-pulse text-white"></i>
        <?php echo esc_html($title); ?>
    </div>
    <style>
        @keyframes ticker-move {
            0% { transform: translate3d(0, 0, 0); }
            100% { transform: translate3d(50%, 0, 0); }
        }
    </style>
    <div
        class="whitespace-nowrap flex items-center hover:[animation-play-state:paused] cursor-pointer"
        style="animation: ticker-move <?php echo esc_attr($speed); ?>s linear infinite;"
        dir="ltr">
        <!-- Repeat items for seamless loop -->
        <?php for ($i = 0; $i < 12; $i++) : ?>
        <div class="flex gap-12 px-6" dir="rtl">
            <?php foreach ($posts as $p) : 
                // We manually setup post data here to avoid loop interference if necessary, 
                // but standard loop is fine since we reset it.
            ?>
            <a href="<?php echo get_permalink($p); ?>"
                class="flex items-center gap-2 text-xs md:text-sm font-normal hover:text-slate-200 transition-colors"><i
                    data-lucide="circle" width="8" fill="currentColor" class="text-white"></i> 
                <?php echo get_the_title($p); ?>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endfor; ?>
    </div>
</aside>
<?php 
    wp_reset_postdata(); 
endif; 
?>
