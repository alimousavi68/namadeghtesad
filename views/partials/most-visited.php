<div class="max-w-[1200px] mx-auto px-4 sm:px-6 mb-10">
    <div class="border-t border-gray-200"></div>
</div>

<!-- Most Visited & Tags Section -->
<section class="max-w-[1200px] mx-auto px-4 sm:px-6 mb-14">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        <!-- Right Column: Most Visited News (8/12) -->
        <div class="lg:col-span-8">

            <div class="flex items-center gap-2 mb-4">
                <h2 class="text-[24px] font-normal text-gray-800">اخبار <span class="font-bold text-blue-700">پربازدید</span></h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <?php if (isset($query) && $query instanceof WP_Query && $query->have_posts()) : ?>
                    <?php
                    $counter = 0;
                    while ($query->have_posts()) : $query->the_post();
                        $counter++;
                        $num = str_pad((string)$counter, 2, '0', STR_PAD_LEFT);
                        // فارسی‌سازی ارقام 0-9 به ۰-۹
                        $persian_nums = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
                        $latin_nums   = ['0','1','2','3','4','5','6','7','8','9'];
                        $num_fa = str_replace($latin_nums, $persian_nums, $num);

                        $is_aggr = (get_post_type() === 'aggregated_news');
                        $display_meta = '';
                        if ($is_aggr) {
                            $meta_name = trim((string) get_post_meta(get_the_ID(), 'i8_hrm_source_name', true));
                            if ($meta_name === '') {
                                $terms = get_the_terms(get_the_ID(), 'news_source');
                                if ($terms && !is_wp_error($terms)) {
                                    $meta_name = $terms[0]->name;
                                }
                            }
                            $display_meta = $meta_name !== '' ? $meta_name : 'اندیشه مدیا';
                        } else {
                            $cats = get_the_category();
                            $display_meta = !empty($cats) ? $cats[0]->name : 'دسته‌بندی';
                        }
                    ?>
                    <div class="group flex gap-4 items-start">
                        <span class="text-2xl font-bold text-gray-200 group-hover:text-blue-200 transition-colors"><?php echo esc_html($num_fa); ?></span>
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-800 leading-snug mb-2 group-hover:text-blue-700 transition-colors line-clamp-2">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <div class="flex items-center gap-3 text-[11px] text-gray-400">
                                <span><?php echo esc_html(get_the_time('H:i')); ?></span>
                                <span class="text-blue-600"><?php echo esc_html($display_meta); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                <?php else : ?>
                    <p class="text-sm text-gray-500">موردی برای نمایش یافت نشد.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Left Column: Popular Tags (4/12) -->
        <div class="lg:col-span-4">
            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                <div class="flex items-center gap-2 mb-4">
                    <i data-lucide="hash" class="w-5 h-5 text-blue-600"></i>
                    <h2 class="text-lg font-bold text-gray-800">برچسب‌های <span class="text-blue-700">داغ</span></h2>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="#" class="px-3 py-1.5 bg-white border border-gray-200 text-gray-600 text-sm rounded-lg hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition-colors">#انتخابات</a>
                    <a href="#" class="px-3 py-1.5 bg-white border border-gray-200 text-gray-600 text-sm rounded-lg hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition-colors">#هوش_مصنوعی</a>
                    <a href="#" class="px-3 py-1.5 bg-white border border-gray-200 text-gray-600 text-sm rounded-lg hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition-colors">#استقلال</a>
                    <a href="#" class="px-3 py-1.5 bg-white border border-gray-200 text-gray-600 text-sm rounded-lg hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition-colors">#قیمت_دلار</a>
                    <a href="#" class="px-3 py-1.5 bg-white border border-gray-200 text-gray-600 text-sm rounded-lg hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition-colors">#آیفون۱۶</a>
                </div>
            </div>
            <div class="lg:col-span-3 flex flex-col gap-6">
                <div class="bg-gray-50 border border-gray-200 rounded-xl flex items-center justify-center min-h-[100px] relative overflow-hidden">
                    <div class="absolute top-2 right-2 bg-gray-200 text-gray-500 text-[10px] px-2 py-0.5 rounded">تبلیغات</div>
                    <div class="text-center p-6">
                        <span class="block text-gray-400 font-bold text-xl mb-2">بنر تبلیغاتی</span>
                        <span class="block text-gray-400 text-sm">۱۰۰ × ۲۵۰</span>
                    </div>
                </div>
                <div class="bg-gray-50 border border-gray-200 rounded-xl flex items-center justify-center min-h-[100px] relative overflow-hidden">
                    <div class="absolute top-2 right-2 bg-gray-200 text-gray-500 text-[10px] px-2 py-0.5 rounded">تبلیغات</div>
                    <div class="text-center p-6">
                        <span class="block text-gray-400 font-bold text-xl mb-2">بنر تبلیغاتی</span>
                        <span class="block text-gray-400 text-sm">۱۰۰ × ۲۵۰</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
