<aside class="lg:col-span-4 space-y-8">
    <div class="lg:sticky lg:top-6 space-y-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <div class="flex items-center gap-2 mb-5 border-b border-gray-100 pb-3">
                <span class="w-1 h-6 bg-blue-600 rounded-full"></span>
                <h3 class="text-lg font-bold text-gray-900">پربازدیدترین‌ها</h3>
            </div>
            <div class="space-y-5">
                <?php
                $visited_query = new WP_Query([
                    'post_type'           => ['post', 'aggregated_news'],
                    'posts_per_page'      => 5,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                    'orderby'             => 'comment_count',
                    'order'               => 'DESC',
                ]);
                while ($visited_query->have_posts()) : $visited_query->the_post();
                ?>
                    <a href="<?php the_permalink(); ?>" class="block group">
                        <div class="relative mb-3">
                            <?php echo hasht_get_thumbnail('medium', ['class' => 'w-full h-40 object-cover rounded-lg']); ?>
                            <span class="absolute top-2 right-2 bg-blue-600 text-white text-[10px] px-2 py-1 rounded shadow-sm">
                                <?php 
                                $cats = get_the_category();
                                echo !empty($cats) ? esc_html($cats[0]->name) : 'خبر';
                                ?>
                            </span>
                        </div>
                        <h4 class="text-sm font-bold text-gray-800 group-hover:text-blue-600 transition-colors leading-6"><?php the_title(); ?></h4>
                        <div class="flex items-center justify-end text-[11px] text-gray-400 mt-1">
                            <span><?php echo get_the_date('Y/m/d'); ?></span>
                        </div>
                    </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 sticky top-4">
            <div class="flex items-center gap-2 mb-5 border-b border-gray-100 pb-3">
                <span class="w-1 h-6 bg-blue-600 rounded-full"></span>
                <h3 class="text-lg font-bold text-gray-900">آخرین اخبار</h3>
            </div>
            <div class="divide-y divide-gray-50">
                <?php
                $latest_query = new WP_Query([
                    'post_type'           => ['post', 'aggregated_news'],
                    'posts_per_page'      => 10,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                ]);
                while ($latest_query->have_posts()) : $latest_query->the_post();
                ?>
                    <div class="py-3 group">
                        <div class="flex items-center justify-end text-[11px] text-gray-400 mb-1">
                            <span><?php echo get_the_time('H:i'); ?></span>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="text-sm font-medium text-gray-700 group-hover:text-blue-600 transition-colors leading-6 line-clamp-2">
                            <?php the_title(); ?>
                        </a>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</aside>
