<!-- Horizontal Ad (Desktop Only) -->
<div class="hidden md:block max-w-[1200px] mx-auto px-4 sm:px-6 mb-10">
    <div
        class="bg-gray-100 border border-gray-200 rounded-xl flex items-center justify-center h-32 relative overflow-hidden">
        <div class="absolute top-2 right-2 bg-gray-200 text-gray-500 text-[10px] px-2 py-0.5 rounded">تبلیغات
        </div>
        <span class="text-gray-400 font-bold text-2xl">جایگاه تبلیغاتی (۹۷۰ × ۲۵۰)</span>
    </div>
</div>

<!-- Topic Section -->
<section class="mb-20">

    <?php if (isset($topics) && !empty($topics)) : ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($topics as $topic) : 
            $t_title = $topic['title'];
            $t_query = $topic['query'];
            $t_cat_slug = isset($topic['cat_slug']) ? $topic['cat_slug'] : '';
        ?>
        <!-- Topic Block -->
        <div class="bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-200 transition-colors">
            <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-50 cursor-pointer group">
                <h3 class="text-lg font-bold text-gray-800">
                    <a href="<?php echo esc_url(get_category_link(get_category_by_slug($t_cat_slug)->term_id)); ?>">
                        <?php echo esc_html($t_title); ?>
                    </a>
                </h3>
                <i data-lucide="chevron-left"
                    class="w-5 h-5 text-gray-500 group-hover:text-blue-600 transition-colors"></i>
            </div>
            <div class="space-y-5">
                <?php 
                $counter = 0;
                while ($t_query->have_posts()) : $t_query->the_post(); 
                    $counter++;
                    $border_class = ($counter === 1) ? '' : 'pt-5 border-t border-gray-200';
                ?>
                <div class="group flex items-start gap-3 cursor-pointer <?php echo $border_class; ?>">
                    <div class="flex-1">
                        <h4
                            class="text-[14px] font-bold text-gray-900 leading-6 mb-1 group-hover:text-blue-700 line-clamp-2">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h4>
                        <div class="flex items-center gap-3 mt-2">
                            <?php
                            $t_badge = '';
                            if (get_post_type() === 'aggregated_news') {
                                $t_badge = trim((string) get_post_meta(get_the_ID(), 'i8_hrm_source_name', true));
                                if ($t_badge === '') {
                                    $t_terms = get_the_terms(get_the_ID(), 'news_source');
                                    if ($t_terms && !is_wp_error($t_terms)) {
                                        $t_badge = $t_terms[0]->name;
                                    }
                                }
                            }
                            if ($t_badge === '') {
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    $t_badge = $categories[0]->name;
                                }
                            }
                            if ($t_badge !== '') {
                                echo '<span class="inline-block px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 text-[10px] font-bold">' . esc_html($t_badge) . '</span>';
                            }
                            ?>
                            <span class="text-[11px] text-gray-400"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' پیش'; ?></span>
                        </div>
                    </div>
                    <div class="flex-shrink-0 order-first mt-2"><span
                            class="block w-1.5 h-1.5 bg-gray-300 rounded-full  group-hover:bg-blue-700 transition-colors"></span>
                    </div>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <div class="mt-4 pt-2 text-center border-t border-gray-50">
                 <a href="<?php echo esc_url(get_category_link(get_category_by_slug($t_cat_slug)->term_id)); ?>"
                     class="block text-blue-600 text-xs font-bold w-full py-1 hover:bg-blue-50 rounded transition-colors">مشاهده
                     بیشتر</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</section>

<!-- Horizontal Ad (Desktop Only) -->
<div class="hidden md:block max-w-[1200px] mx-auto px-4 sm:px-6 mb-10">
    <div
        class="bg-gray-100 border border-gray-200 rounded-xl flex items-center justify-center h-32 relative overflow-hidden">
        <div class="absolute top-2 right-2 bg-gray-200 text-gray-500 text-[10px] px-2 py-0.5 rounded">تبلیغات
        </div>
        <span class="text-gray-400 font-bold text-2xl">جایگاه تبلیغاتی (۹۷۰ × ۲۵۰)</span>
    </div>
</div>
