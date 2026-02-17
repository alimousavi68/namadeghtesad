<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
    <!-- Industry & Mining -->
    <?php if (get_theme_mod('hasht_home_industry_enable', true)): ?>
    <?php
    $ind_title    = get_theme_mod('hasht_home_industry_title', '');
    $ind_cat_id   = get_theme_mod('hasht_home_industry_cat', ''); // Changed to ID
    $ind_count    = get_theme_mod('hasht_home_industry_count', 5);

    $ind_args = [
        'post_type'      => ['post'],
        'posts_per_page' => $ind_count,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];
    if ($ind_cat_id) {
        $ind_args['cat'] = $ind_cat_id;
    }
    $ind_query = new WP_Query($ind_args);
    
    $ind_link = '#';
    if ($ind_cat_id) {
        $ind_link = get_category_link($ind_cat_id);
    }
    ?>
    <section class="bg-white dark:bg-slate-900 rounded-xl p-5 border border-slate-100 dark:border-slate-800 shadow-sm">
        <div class="flex items-center justify-between mb-5">
            <h3 class="section-title flex items-center gap-4 text-xl font-medium">
                <div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0">
                    <div class="h-1/3 bg-slate-400"></div>
                    <div class="h-2/3 bg-primary"></div>
                </div>
                <?php echo esc_html($ind_title); ?>
            </h3>
            <a href="<?php echo esc_url($ind_link); ?>"
                class="link-more text-sm text-slate-500 hover:text-rose-600 transition-colors flex items-center gap-1">
                مشاهده بیشتر <i data-lucide="arrow-left" width="12"></i>
            </a>
        </div>

        <?php if ($ind_query->have_posts()): 
            $posts = $ind_query->posts;
            $main_post = $posts[0];
            $list_posts = array_slice($posts, 1);
            
            // Main Post
            // We use a separate variable to ensure we are referencing the correct post object
            // and explicitly calling setup_postdata on it.
            $post = $main_post; 
            setup_postdata($post);
            $thumb_url = get_the_post_thumbnail_url($post, 'hasht-large');
        ?>
        <!-- Main Feature Item -->
        <article class="news-card-overlay group">
            <div class="news-card-overlay-img-wrapper rounded-xl overflow-hidden aspect-[16/10] relative">
                <a href="<?php echo get_permalink($post); ?>" class="block w-full h-full">
                    <?php if ($thumb_url): ?>
                        <img src="<?php echo esc_url($thumb_url); ?>" class="news-card-overlay-img w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="<?php echo esc_attr(get_the_title($post)); ?>">
                    <?php else: ?>
                        <div class="w-full h-full bg-slate-200"></div>
                    <?php endif; ?>
                    <div class="news-card-overlay-content absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                        <h4 class="news-card-overlay-title text-white font-bold lg:text-lg md:text-sm sm:text-xs"></h4>
                            <?php echo get_the_title($post); ?>
                        </h4>
                    </div>
                </a>
            </div>
        </article>
        <?php wp_reset_postdata(); ?>

        <!-- List Items -->
        <div class="space-y-4 mt-4">
            <?php foreach ($list_posts as $post): setup_postdata($post); 
                $thumb_url = get_the_post_thumbnail_url($post, 'hasht-small-rect');
            ?>
            <article class="news-card-h group flex items-start gap-3">
                <div class="w-16 h-12 rounded-md overflow-hidden shrink-0">
                    <a href="<?php echo get_permalink($post); ?>" class="block w-full h-full">
                        <?php if ($thumb_url): ?>
                            <img src="<?php echo esc_url($thumb_url); ?>" class="w-full h-full object-cover" alt="<?php echo esc_attr(get_the_title($post)); ?>">
                        <?php else: ?>
                            <div class="w-full h-full bg-slate-200"></div>
                        <?php endif; ?>
                    </a>
                </div>
                <h5 class="news-card-h-title text-sm font-bold text-slate-700 dark:text-slate-200 leading-snug group-hover:text-primary transition-colors line-clamp-2">
                    <a href="<?php echo get_permalink($post); ?>"><?php echo get_the_title($post); ?></a>
                </h5>
            </article>
            <?php endforeach; wp_reset_postdata(); ?>
        </div>
        <?php else: ?>
            <p class="text-slate-500 text-sm">مطلبی یافت نشد.</p>
        <?php endif; ?>
    </section>
    <?php endif; ?>

    <!-- Energy -->
    <?php if (get_theme_mod('hasht_home_energy_enable', true)): ?>
    <?php
    $en_title    = get_theme_mod('hasht_home_energy_title', '');
    $en_cat_id   = get_theme_mod('hasht_home_energy_cat', '');
    $en_count    = get_theme_mod('hasht_home_energy_count', 1);

    $en_args = [
        'post_type'      => ['post'],
        'posts_per_page' => $en_count,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];
    if ($en_cat_id) {
        $en_args['cat'] = $en_cat_id;
    }
    $en_query = new WP_Query($en_args);
    
    $en_link = '#';
    if ($en_cat_id) {
        $en_link = get_category_link($en_cat_id);
    }
    ?>
    <section class="bg-white dark:bg-slate-900 rounded-xl p-5 border border-slate-100 dark:border-slate-800 shadow-sm">
        <div class="flex items-center justify-between mb-5">
            <h3 class="section-title flex items-center gap-4 text-xl font-medium">
                <div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0">
                    <div class="h-1/3 bg-slate-400"></div>
                    <div class="h-2/3 bg-primary"></div>
                </div>
                <?php echo esc_html($en_title); ?>
            </h3>
            <a href="<?php echo esc_url($en_link); ?>"
                class="link-more text-sm text-slate-500 hover:text-rose-600 transition-colors flex items-center gap-1">
                مشاهده بیشتر <i data-lucide="arrow-left" width="12"></i>
            </a>
        </div>

        <?php if ($en_query->have_posts()): 
            $posts = $en_query->posts;
            $main_post = $posts[0];
            $list_posts = array_slice($posts, 1);
            
            // Main Post
            $post = $main_post; setup_postdata($post);
            $thumb_url = get_the_post_thumbnail_url($post, 'hasht-large');
        ?>
        <!-- Main Feature Item -->
        <article class="news-card-overlay group">
            <div class="news-card-overlay-img-wrapper rounded-xl overflow-hidden aspect-[16/10] relative">
                <a href="<?php echo get_permalink($post); ?>" class="block w-full h-full">
                    <?php if ($thumb_url): ?>
                        <img src="<?php echo esc_url($thumb_url); ?>" class="news-card-overlay-img w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="<?php echo esc_attr(get_the_title($post)); ?>">
                    <?php else: ?>
                        <div class="w-full h-full bg-slate-200"></div>
                    <?php endif; ?>
                    <div class="news-card-overlay-content absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                        <h4 class="news-card-overlay-title text-white font-bold lg:text-lg md:text-sm sm:text-sm">
                            <?php echo get_the_title($post); ?>
                        </h4>
                    </div>
                </a>
            </div>
        </article>
        <?php wp_reset_postdata(); ?>

        <!-- List Items -->
        <div class="space-y-4 mt-4">
            <?php foreach ($list_posts as $post): setup_postdata($post); 
                $thumb_url = get_the_post_thumbnail_url($post, 'hasht-small-rect');
            ?>
            <article class="news-card-h group flex items-start gap-3">
                <div class="w-16 h-12 rounded-md overflow-hidden shrink-0">
                    <a href="<?php echo get_permalink($post); ?>" class="block w-full h-full">
                        <?php if ($thumb_url): ?>
                            <img src="<?php echo esc_url($thumb_url); ?>" class="w-full h-full object-cover" alt="<?php echo esc_attr(get_the_title($post)); ?>">
                        <?php else: ?>
                            <div class="w-full h-full bg-slate-200"></div>
                        <?php endif; ?>
                    </a>
                </div>
                <h5 class="news-card-h-title text-sm font-bold text-slate-700 dark:text-slate-200 leading-snug group-hover:text-primary transition-colors line-clamp-2">
                    <a href="<?php echo get_permalink($post); ?>"><?php echo get_the_title($post); ?></a>
                </h5>
            </article>
            <?php endforeach; wp_reset_postdata(); ?>
        </div>
        <?php else: ?>
            <p class="text-slate-500 text-sm">مطلبی یافت نشد.</p>
        <?php endif; ?>
    </section>
    <?php endif; ?>
</div>
