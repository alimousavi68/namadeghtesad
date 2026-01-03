<!-- Hero Section -->
<section class="mt-8 mb-10">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Content Area (3/4) -->
        <div class="lg:col-span-9">
            <?php if (isset($query) && $query->have_posts()) : $query->the_post(); ?>
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 p-0 sm:p-5">
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Main Story Image (55%) -->
                    <div class="md:w-[55%] relative group cursor-pointer overflow-hidden rounded-xl">
                        <a href="<?php the_permalink(); ?>">
                            <?php echo hasht_get_thumbnail('large', ['class' => 'w-full h-72 md:h-[420px] object-cover transition-transform duration-500 group-hover:scale-105']); ?>
                        </a>
                        <div
                            class="absolute bottom-0 right-0 left-0 bg-gradient-to-t from-black/90 to-transparent p-6 md:hidden">
                            <div class="flex items-center gap-2 mb-2">
                                <?php
                                $badge_label = '';
                                if (get_post_type() === 'aggregated_news') {
                                    $badge_label = trim((string) get_post_meta(get_the_ID(), 'i8_hrm_source_name', true));
                                    if ($badge_label === '') {
                                        $terms = get_the_terms(get_the_ID(), 'news_source');
                                        if ($terms && !is_wp_error($terms)) {
                                            $badge_label = $terms[0]->name;
                                        }
                                    }
                                }
                                if ($badge_label === '') {
                                    $categories = get_the_category();
                                    if (!empty($categories)) {
                                        $badge_label = $categories[0]->name;
                                    }
                                }
                                if ($badge_label !== '') {
                                    echo '<span class="inline-block px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 text-[10px] font-bold">' . esc_html($badge_label) . '</span>';
                                }
                                ?>
                                <span class="text-gray-200 text-xs"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' پیش'; ?></span>
                            </div>
                            <h2 class="text-white font-bold text-xl leading-snug">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                        </div>
                    </div>

                    <!-- Stories List (45%) -->
                    <div class="md:w-[45%] flex flex-col px-4 sm:px-0 pb-4 sm:pb-0">
                        <!-- Main Story Title (Desktop) -->
                        <div class="hidden md:block mb-6 cursor-pointer group">
                            <div class="mb-3">
                                <?php
                                if (!isset($badge_label)) {
                                    $badge_label = '';
                                }
                                if ($badge_label !== '') {
                                    echo '<span class="inline-block px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 text-[10px] font-bold">' . esc_html($badge_label) . '</span>';
                                }
                                ?>
                            </div>
                            <h2
                                class="text-gray-900 font-extrabold text-[28px] leading-tight group-hover:text-blue-700 transition-colors mb-3">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="text-sm text-gray-500"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' پیش'; ?></div>
                        </div>
                        <div class="border-t border-gray-200 my-2 md:hidden"></div>

                        <!-- Sub List -->
                        <div class="flex flex-col flex-1 justify-between">
                            <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <div class="group cursor-pointer border-b border-gray-100 pb-3 mb-3 last:mb-0 last:border-0">
                                <h3
                                    class="text-[17px] font-bold text-gray-800 leading-snug mb-1 group-hover:underline decoration-blue-600 decoration-2 underline-offset-4">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="flex items-center gap-2 text-xs text-gray-500 mt-2">
                                    <span><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' پیش'; ?></span>
                                    <?php
                                    $sub_badge = '';
                                    if (get_post_type() === 'aggregated_news') {
                                        $sub_badge = trim((string) get_post_meta(get_the_ID(), 'i8_hrm_source_name', true));
                                        if ($sub_badge === '') {
                                            $terms = get_the_terms(get_the_ID(), 'news_source');
                                            if ($terms && !is_wp_error($terms)) {
                                                $sub_badge = $terms[0]->name;
                                            }
                                        }
                                    }
                                    if ($sub_badge === '') {
                                        $sub_cats = get_the_category();
                                        if (!empty($sub_cats)) {
                                            $sub_badge = $sub_cats[0]->name;
                                        }
                                    }
                                    if ($sub_badge !== '') {
                                        echo '<span class="inline-block px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 text-[10px] font-bold">' . esc_html($sub_badge) . '</span>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar (1/4) -->
        <div class="lg:col-span-3 flex flex-col gap-3">
            <!-- Ad -->
            <div
                class="bg-gray-50 border border-gray-200 rounded-xl flex items-center justify-center min-h-[100px] relative overflow-hidden">
                <div class="absolute top-2 right-2 bg-gray-200 text-gray-500 text-[10px] px-2 py-0.5 rounded">
                    تبلیغات</div>
                <div class="text-center p-6">
                    <span class="block text-gray-400 font-bold text-xl mb-2">بنر تبلیغاتی</span>
                    <span class="block text-gray-400 text-sm">۱۰۰ × ۲۵۰</span>
                </div>
            </div>
                <!-- Ad -->
            <div
                class="bg-gray-50 border border-gray-200 rounded-xl flex items-center justify-center min-h-[100px] relative overflow-hidden">
                <div class="absolute top-2 right-2 bg-gray-200 text-gray-500 text-[10px] px-2 py-0.5 rounded">
                    تبلیغات</div>
                <div class="text-center p-6">
                    <span class="block text-gray-400 font-bold text-xl mb-2">بنر تبلیغاتی</span>
                    <span class="block text-gray-400 text-sm">۱۰۰ × ۲۵۰</span>
                </div>
            </div>
                <!-- Ad -->
            <div
                class="bg-gray-50 border border-gray-200 rounded-xl flex items-center justify-center min-h-[100px] relative overflow-hidden">
                <div class="absolute top-2 right-2 bg-gray-200 text-gray-500 text-[10px] px-2 py-0.5 rounded">
                    تبلیغات</div>
                <div class="text-center p-6">
                    <span class="block text-gray-400 font-bold text-xl mb-2">بنر تبلیغاتی</span>
                    <span class="block text-gray-400 text-sm">۱۰۰ × ۲۵۰</span>
                </div>
            </div>
                <!-- Ad -->
            <div
                class="bg-gray-50 border border-gray-200 rounded-xl flex items-center justify-center min-h-[100px] relative overflow-hidden">
                <div class="absolute top-2 right-2 bg-gray-200 text-gray-500 text-[10px] px-2 py-0.5 rounded">
                    تبلیغات</div>
                <div class="text-center p-6">
                    <span class="block text-gray-400 font-bold text-xl mb-2">بنر تبلیغاتی</span>
                    <span class="block text-gray-400 text-sm">۱۰۰ × ۲۵۰</span>
                </div>
            </div>
            

        </div>
    </div>
    </div>
</section>
