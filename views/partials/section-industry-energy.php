<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
    <!-- Industry & Mining -->
    <?php
    $ind_title    = get_theme_mod('hasht_home_industry_title', 'صنعت و معدن');
    $ind_cat_slug = get_theme_mod('hasht_home_industry_cat', '');
    $ind_count    = get_theme_mod('hasht_home_industry_count', 5);

    $ind_args = [
        'post_type'      => ['post', 'aggregated_news'],
        'posts_per_page' => $ind_count,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];
    if ($ind_cat_slug) {
        $ind_args['category_name'] = $ind_cat_slug;
    }
    $ind_query = new WP_Query($ind_args);
    
    $ind_link = '#';
    if ($ind_cat_slug) {
        $cat_obj = get_category_by_slug($ind_cat_slug);
        if ($cat_obj) {
            $ind_link = get_category_link($cat_obj->term_id);
        }
    }
    ?>
    <section class="bg-white dark:bg-slate-900 rounded-xl p-5 border border-slate-100 dark:border-slate-800 shadow-sm">
        <div class="flex items-center justify-between mb-5">
            <h3 class="section-title flex items-center gap-4">
                <div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0">
                    <div class="h-1/3 bg-slate-400"></div>
                    <div class="h-2/3 bg-primary"></div>
                </div>
                <?php echo esc_html($ind_title); ?>
            </h3>
            <a href="<?php echo esc_url($ind_link); ?>"
                class="flex items-center gap-1 text-sm font-bold text-text-light dark:text-slate-500 hover:text-primary transition-all">
                مشاهده بیشتر <i data-lucide="arrow-left" width="16"></i>
            </a>
        </div>

        <?php if ($ind_query->have_posts()): 
            $posts = $ind_query->posts;
            $main_post = $posts[0];
            $list_posts = array_slice($posts, 1);
            
            // Main Post
            $post = $main_post; setup_postdata($post);
            $thumb_url = get_the_post_thumbnail_url($post, 'medium_large');
        ?>
        <!-- Main Feature Item -->
        <article class="news-card-overlay group">
            <div class="news-card-overlay-img-wrapper">
                <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                    <?php if ($thumb_url): ?>
                        <img src="<?php echo esc_url($thumb_url); ?>" class="news-card-overlay-img" alt="<?php the_title_attribute(); ?>">
                    <?php else: ?>
                        <div class="w-full h-full bg-slate-200"></div>
                    <?php endif; ?>
                    <div class="news-card-overlay-content">
                        <h4 class="news-card-overlay-title">
                            <?php the_title(); ?>
                        </h4>
                    </div>
                </a>
            </div>
        </article>
        <?php wp_reset_postdata(); ?>

        <!-- List Items -->
        <div class="space-y-4 mt-4">
            <?php foreach ($list_posts as $post): setup_postdata($post); 
                $thumb_url = get_the_post_thumbnail_url($post, 'thumbnail');
            ?>
            <article class="news-card-h group">
                <div class="w-16 h-12 rounded-md overflow-hidden shrink-0">
                    <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                        <?php if ($thumb_url): ?>
                            <img src="<?php echo esc_url($thumb_url); ?>" class="w-full h-full object-cover" alt="<?php the_title_attribute(); ?>">
                        <?php else: ?>
                            <div class="w-full h-full bg-slate-200"></div>
                        <?php endif; ?>
                    </a>
                </div>
                <h5 class="news-card-h-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h5>
            </article>
            <?php endforeach; wp_reset_postdata(); ?>
        </div>
        <?php else: ?>
            <p class="text-slate-500 text-sm">مطلبی یافت نشد.</p>
        <?php endif; ?>
    </section>

    <!-- Energy -->
    <?php
    $en_title    = get_theme_mod('hasht_home_energy_title', 'انرژی');
    $en_cat_slug = get_theme_mod('hasht_home_energy_cat', '');
    $en_count    = get_theme_mod('hasht_home_energy_count', 1);

    $en_args = [
        'post_type'      => ['post', 'aggregated_news'],
        'posts_per_page' => $en_count,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];
    if ($en_cat_slug) {
        $en_args['category_name'] = $en_cat_slug;
    }
    $en_query = new WP_Query($en_args);
    
    $en_link = '#';
    if ($en_cat_slug) {
        $cat_obj = get_category_by_slug($en_cat_slug);
        if ($cat_obj) {
            $en_link = get_category_link($cat_obj->term_id);
        }
    }
    ?>
    <section class="bg-white dark:bg-slate-900 rounded-xl p-5 border border-slate-100 dark:border-slate-800 shadow-sm">
        <div class="flex items-center justify-between mb-5">
            <h3 class="section-title flex items-center gap-4">
                <div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0">
                    <div class="h-1/3 bg-slate-400"></div>
                    <div class="h-2/3 bg-primary-600"></div>
                </div>
                <?php echo esc_html($en_title); ?>
            </h3>
            <a href="<?php echo esc_url($en_link); ?>"
                class="link-more">
                مشاهده بیشتر <i data-lucide="arrow-left" width="16"></i>
            </a>
        </div>

        <?php if ($en_query->have_posts()): 
            $posts = $en_query->posts;
            $main_post = $posts[0];
            $list_posts = array_slice($posts, 1);
            
            // Main Post
            $post = $main_post; setup_postdata($post);
            $thumb_url = get_the_post_thumbnail_url($post, 'medium_large');
        ?>
        <!-- Main Feature Item -->
        <article class="news-card-overlay group">
            <div class="news-card-overlay-img-wrapper">
                <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                    <?php if ($thumb_url): ?>
                        <img src="<?php echo esc_url($thumb_url); ?>" class="news-card-overlay-img" alt="<?php the_title_attribute(); ?>">
                    <?php else: ?>
                        <div class="w-full h-full bg-slate-200"></div>
                    <?php endif; ?>
                    <div class="news-card-overlay-content">
                        <h4 class="news-card-overlay-title">
                            <?php the_title(); ?>
                        </h4>
                    </div>
                </a>
            </div>
        </article>
        <?php wp_reset_postdata(); ?>

        <!-- List Items -->
        <div class="space-y-4 mt-4">
            <?php foreach ($list_posts as $post): setup_postdata($post); 
                $thumb_url = get_the_post_thumbnail_url($post, 'thumbnail');
            ?>
            <article class="news-card-h group">
                <div class="w-16 h-12 rounded-md overflow-hidden shrink-0">
                    <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                        <?php if ($thumb_url): ?>
                            <img src="<?php echo esc_url($thumb_url); ?>" class="w-full h-full object-cover" alt="<?php the_title_attribute(); ?>">
                        <?php else: ?>
                            <div class="w-full h-full bg-slate-200"></div>
                        <?php endif; ?>
                    </a>
                </div>
                <h5 class="news-card-h-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h5>
            </article>
            <?php endforeach; wp_reset_postdata(); ?>
        </div>
        <?php else: ?>
            <p class="text-slate-500 text-sm">مطلبی یافت نشد.</p>
        <?php endif; ?>
    </section>
</div>
