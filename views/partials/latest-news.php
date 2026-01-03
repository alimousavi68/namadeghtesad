<div class="max-w-[1200px] mx-auto px-4 sm:px-6 mb-10">
    <div class="border-t border-gray-200"></div>
</div>


<!-- Horizontal Ad (Desktop Only) -->
<div class="hidden md:block max-w-[1200px] mx-auto px-4 sm:px-6 mb-10">
    <div
        class="bg-gray-100 border border-gray-200 rounded-xl flex items-center justify-center h-32 relative overflow-hidden">
        <div class="absolute top-2 right-2 bg-gray-200 text-gray-500 text-[10px] px-2 py-0.5 rounded">تبلیغات
        </div>
        <span class="text-gray-400 font-bold text-2xl">جایگاه تبلیغاتی (۹۷۰ × ۲۵۰)</span>
    </div>
</div>

<!-- Latest News (For You) -->
<section class="mb-14">
    <?php if (isset($query) && $query->have_posts()) : ?>
    <div class="flex items-center gap-2 mb-4">
        <h2 class="text-[24px] font-normal text-gray-800">
            <?php 
            $title_parts = explode(' ', isset($title) ? $title : 'جدیدترین اخبار');
            $last_word = array_pop($title_parts);
            $first_part = implode(' ', $title_parts);
            echo esc_html($first_part); 
            ?> 
            <span class="font-bold text-blue-700"><?php echo esc_html($last_word); ?></span>
        </h2>
        <a href="#" class="text-sm font-bold text-blue-600 hover:underline mr-auto">بیشتر...</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-12">
        <!-- Column 1 -->
        <div class="flex flex-col">
            <?php 
            $count = 0;
            $half = ceil($query->post_count / 2);
            while ($query->have_posts()) : $query->the_post(); 
                $count++;
                if ($count > $half) break; 
            ?>
            <div class="group flex flex-row items-start gap-5 py-5 border-b border-gray-200 last:border-0">
                <div class="w-24 h-24 sm:w-28 sm:h-28 flex-shrink-0 order-first">
                    <a href="<?php the_permalink(); ?>">
                        <?php echo hasht_get_thumbnail('thumbnail', ['class' => 'w-full h-full object-cover rounded-xl border border-gray-200']); ?>
                    </a>
                </div>
                <div class="flex-1 flex flex-col justify-between h-full min-h-[100px]">
                    <div>
                        <div class="mb-2">
                            <?php
                            $badge = '';
                            if (get_post_type() === 'aggregated_news') {
                                $badge = trim((string) get_post_meta(get_the_ID(), 'i8_hrm_source_name', true));
                                if ($badge === '') {
                                    $terms = get_the_terms(get_the_ID(), 'news_source');
                                    if ($terms && !is_wp_error($terms)) {
                                        $badge = $terms[0]->name;
                                    }
                                }
                            }
                            if ($badge === '') {
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    $badge = $categories[0]->name;
                                }
                            }
                            if ($badge !== '') {
                                echo '<span class="inline-block px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 text-[10px] font-bold">' . esc_html($badge) . '</span>';
                            }
                            ?>
                        </div>
                        <h3 class="text-base font-bold text-gray-900 leading-6 mb-2 line-clamp-2 group-hover:text-blue-700 transition-colors">
                            <a href="<?php the_permalink(); ?>" class="hover:text-blue-700 transition-colors"><?php the_title(); ?></a>
                        </h3>
                        <p class="text-xs text-gray-500 mt-2 line-clamp-2 leading-5"><?php echo get_the_excerpt(); ?></p>
                    </div>
                    <div class="flex items-center justify-between mt-1">
                        <span class="text-xs text-gray-500 font-medium"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' پیش'; ?></span>
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="<?php the_permalink(); ?>"
                                class="inline-flex items-center gap-1 text-[10px] text-blue-600 hover:text-blue-800 font-medium bg-blue-50 px-2 py-1 rounded-md transition-colors">
                                مطالعه خبر <i data-lucide="external-link" class="w-3 h-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        
        <!-- Column 2 -->
        <div class="flex flex-col">
            <?php 
            $query->rewind_posts();
            $current = 0;
            while ($query->have_posts()) : $query->the_post();
                $current++;
                if ($current <= $half) continue; 
            ?>
             <div class="group flex flex-row items-start gap-5 py-5 border-b border-gray-200 last:border-0">
                <div class="w-24 h-24 sm:w-28 sm:h-28 flex-shrink-0 order-first">
                    <a href="<?php the_permalink(); ?>">
                        <?php echo hasht_get_thumbnail('thumbnail', ['class' => 'w-full h-full object-cover rounded-xl border border-gray-200']); ?>
                    </a>
                </div>
                <div class="flex-1 flex flex-col justify-between h-full min-h-[100px]">
                    <div>
                        <div class="mb-2">
                            <?php
                            $badge2 = '';
                            if (get_post_type() === 'aggregated_news') {
                                $badge2 = trim((string) get_post_meta(get_the_ID(), 'i8_hrm_source_name', true));
                                if ($badge2 === '') {
                                    $terms = get_the_terms(get_the_ID(), 'news_source');
                                    if ($terms && !is_wp_error($terms)) {
                                        $badge2 = $terms[0]->name;
                                    }
                                }
                            }
                            if ($badge2 === '') {
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    $badge2 = $categories[0]->name;
                                }
                            }
                            if ($badge2 !== '') {
                                echo '<span class="inline-block px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 text-[10px] font-bold">' . esc_html($badge2) . '</span>';
                            }
                            ?>
                        </div>
                        <h3 class="text-base font-bold text-gray-900 leading-6 mb-2 line-clamp-2 group-hover:text-blue-700 transition-colors">
                            <a href="<?php the_permalink(); ?>" class="hover:text-blue-700 transition-colors"><?php the_title(); ?></a>
                        </h3>
                        <p class="text-xs text-gray-500 mt-2 line-clamp-2 leading-5"><?php echo get_the_excerpt(); ?></p>
                    </div>
                    <div class="flex items-center justify-between mt-1">
                        <span class="text-xs text-gray-500 font-medium"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' پیش'; ?></span>
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="<?php the_permalink(); ?>"
                                class="inline-flex items-center gap-1 text-[10px] text-blue-600 hover:text-blue-800 font-medium bg-blue-50 px-2 py-1 rounded-md transition-colors">
                                مطالعه خبر <i data-lucide="external-link" class="w-3 h-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
    <?php endif; ?>
</section>
