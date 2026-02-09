<?php

/**
 * Custom Widgets for Namad Eghtesad Theme
 */

// Register Widgets and Sidebar
function hasht_widgets_init() {
    register_sidebar([
        'name'          => 'سایدبار صفحه اصلی',
        'id'            => 'home-sidebar',
        'description'   => 'ویجت‌های سایدبار صفحه اصلی را اینجا قرار دهید.',
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-6">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="section-title flex items-center gap-4 mb-4 text-xl font-medium"><div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0"><div class="h-1/3 bg-slate-400"></div><div class="h-2/3 bg-primary"></div></div>',
        'after_title'   => '</h3>',
    ]);

    register_sidebar([
        'name'          => 'سایدبار اصلی (صفحات داخلی)',
        'id'            => 'main-sidebar',
        'description'   => 'ویجت‌های سایدبار صفحات داخلی (نوشته‌ها، برگه‌ها و آرشیو) را اینجا قرار دهید.',
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-6">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="section-title flex items-center gap-4 mb-4 text-xl font-medium"><div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0"><div class="h-1/3 bg-slate-400"></div><div class="h-2/3 bg-primary"></div></div>',
        'after_title'   => '</h3>',
    ]);

    register_sidebar([
        'name'          => 'سایدبار هیرو (ستون کناری)',
        'id'            => 'hero-sidebar',
        'description'   => 'این سایدبار در بخش هیرو (بالای صفحه اصلی) نمایش داده می‌شود. می‌توانید ویجت پیشخوان بازار یا لیست اخبار را اینجا قرار دهید.',
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-6">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="section-title flex items-center gap-4 mb-4 text-xl font-medium"><div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0"><div class="h-1/3 bg-slate-400"></div><div class="h-2/3 bg-primary"></div></div>',
        'after_title'   => '</h3>',
    ]);

    register_widget('Hasht_Selected_News_Widget');
    register_widget('Hasht_Market_Widget');
    register_widget('Hasht_Advertisement_Widget');
    register_widget('Hasht_Pro_Ad_Widget');
}
add_action('widgets_init', 'hasht_widgets_init');

/**
 * Widget: Pro Advanced Advertisement
 * Supports Images (JPG, PNG, WebP, GIF) and Videos (MP4, WebM, MOV)
 * Features: Lazy Loading, Progressive Loading, Custom Sizes
 */
class Hasht_Pro_Ad_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'hasht_pro_ad_widget',
            'نماد اقتصاد: تبلیغات حرفه‌ای (بنر/ویدیو)',
            ['description' => 'نمایش بنرهای تبلیغاتی (تصویر/ویدیو) با قابلیت بارگذاری تنبل و تنظیمات پیشرفته']
        );
    }

    public function widget($args, $instance) {
        // 1. Get Settings
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $media_type = !empty($instance['media_type']) ? $instance['media_type'] : 'image';
        $media_url = !empty($instance['media_url']) ? $instance['media_url'] : '';
        $poster_url = !empty($instance['poster_url']) ? $instance['poster_url'] : ''; // For video poster or LQIP
        $link_url = !empty($instance['link_url']) ? $instance['link_url'] : '';
        $link_target = !empty($instance['link_target']) ? $instance['link_target'] : '_self';
        $loading_strategy = !empty($instance['loading_strategy']) ? $instance['loading_strategy'] : 'lazy';
        $size_strategy = !empty($instance['size_strategy']) ? $instance['size_strategy'] : 'responsive';
        $width = !empty($instance['width']) ? $instance['width'] : '';
        $height = !empty($instance['height']) ? $instance['height'] : '';

        // If no media, return
        if (empty($media_url)) return;

        // Container Styles
        $container_style = '';
        if ($size_strategy === 'custom' && !empty($width) && !empty($height)) {
            $container_style = "width: {$width}px; height: {$height}px;";
        } elseif ($size_strategy === 'standard_300_250') {
            $container_style = "width: 300px; height: 250px;";
        } elseif ($size_strategy === 'standard_728_90') {
            $container_style = "width: 728px; height: 90px;";
        } elseif ($size_strategy === 'standard_300_600') {
            $container_style = "width: 300px; height: 600px;";
        } else {
            // Responsive
            $container_style = "width: 100%; height: auto;";
        }

        echo $args['before_widget'];

        if (!empty($title)) {
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }

        // Wrapper
        echo '<div class="hasht-ad-wrapper relative rounded-xl overflow-hidden group shadow-sm hover:shadow-md transition-shadow duration-300 bg-slate-50 dark:bg-slate-800" style="' . esc_attr($container_style) . '">';
        
        // Link Wrapper Start
        if (!empty($link_url)) {
            echo '<a href="' . esc_url($link_url) . '" target="' . esc_attr($link_target) . '" class="block w-full h-full relative" rel="nofollow sponsored">';
        }

        // Media Output
        if ($media_type === 'video') {
            // Video
            $preload = ($loading_strategy === 'eager') ? 'auto' : 'none';
            $poster_attr = !empty($poster_url) ? 'poster="' . esc_url($poster_url) . '"' : '';
            
            echo '<video class="w-full h-full object-cover" muted loop autoplay playsinline ' . $poster_attr . ' preload="' . esc_attr($preload) . '">';
            echo '<source src="' . esc_url($media_url) . '" type="video/mp4">'; // Assuming MP4 mostly, browser handles rest if supported source
            echo 'مرورگر شما پشتیبانی نمی‌کند.';
            echo '</video>';

        } else {
            // Image
            $img_loading = ($loading_strategy === 'eager') ? 'eager' : 'lazy';
            $img_class = 'w-full h-full object-cover transition-opacity duration-500';
            
            // Progressive Loading Logic
            if ($loading_strategy === 'progressive' && !empty($poster_url)) {
                // Blur Up Technique
                echo '<div class="progressive-media relative w-full h-full">';
                // LQIP (Low Quality)
                echo '<img src="' . esc_url($poster_url) . '" class="absolute inset-0 w-full h-full object-cover blur-sm scale-105" aria-hidden="true">';
                // Real Image
                echo '<img src="' . esc_url($media_url) . '" loading="lazy" class="relative z-10 w-full h-full object-cover opacity-0 transition-opacity duration-700" onload="this.classList.remove(\'opacity-0\')">';
                echo '</div>';
            } else {
                // Standard Image
                echo '<img src="' . esc_url($media_url) . '" loading="' . esc_attr($img_loading) . '" class="' . esc_attr($img_class) . '" alt="Advertisement">';
            }
        }

        // Ad Badge
        echo '<span class="absolute top-2 left-2 bg-black/50 text-white text-[10px] px-1.5 py-0.5 rounded opacity-0 group-hover:opacity-100 transition-opacity z-20">آگهی</span>';

        // Link Wrapper End
        if (!empty($link_url)) {
            echo '</a>';
        }

        echo '</div>'; // End Wrapper

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $media_type = !empty($instance['media_type']) ? $instance['media_type'] : 'image';
        $media_url = !empty($instance['media_url']) ? $instance['media_url'] : '';
        $poster_url = !empty($instance['poster_url']) ? $instance['poster_url'] : '';
        $link_url = !empty($instance['link_url']) ? $instance['link_url'] : '';
        $link_target = !empty($instance['link_target']) ? $instance['link_target'] : '_blank';
        $loading_strategy = !empty($instance['loading_strategy']) ? $instance['loading_strategy'] : 'lazy';
        $size_strategy = !empty($instance['size_strategy']) ? $instance['size_strategy'] : 'responsive';
        $width = !empty($instance['width']) ? $instance['width'] : '';
        $height = !empty($instance['height']) ? $instance['height'] : '';
        ?>
        <div class="hasht-ad-widget-form">
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>">عنوان (اختیاری):</label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
            </p>

            <div style="background: #f0f0f1; padding: 10px; border-radius: 4px; margin-bottom: 10px;">
                <strong>رسانه</strong>
                <p>
                    <label for="<?php echo $this->get_field_id('media_type'); ?>">نوع رسانه:</label>
                    <select class="widefat" id="<?php echo $this->get_field_id('media_type'); ?>" name="<?php echo $this->get_field_name('media_type'); ?>">
                        <option value="image" <?php selected($media_type, 'image'); ?>>تصویر (JPG, PNG, GIF, WebP)</option>
                        <option value="video" <?php selected($media_type, 'video'); ?>>ویدیو (MP4, WebM)</option>
                    </select>
                </p>
                <p>
                    <label for="<?php echo $this->get_field_id('media_url'); ?>">لینک فایل اصلی (URL):</label>
                    <input class="widefat" id="<?php echo $this->get_field_id('media_url'); ?>" name="<?php echo $this->get_field_name('media_url'); ?>" type="text" value="<?php echo esc_attr($media_url); ?>" placeholder="https://...">
                    <small>آدرس تصویر یا ویدیو را وارد کنید.</small>
                </p>
                <p>
                    <label for="<?php echo $this->get_field_id('poster_url'); ?>">لینک تصویر جایگزین / پوستر:</label>
                    <input class="widefat" id="<?php echo $this->get_field_id('poster_url'); ?>" name="<?php echo $this->get_field_name('poster_url'); ?>" type="text" value="<?php echo esc_attr($poster_url); ?>" placeholder="https://...">
                    <small>برای ویدیو (Poster) یا برای بارگذاری تدریجی (تصویر کم‌حجم LQIP) استفاده می‌شود.</small>
                </p>
            </div>

            <div style="background: #f0f0f1; padding: 10px; border-radius: 4px; margin-bottom: 10px;">
                <strong>تنظیمات نمایش</strong>
                <p>
                    <label for="<?php echo $this->get_field_id('loading_strategy'); ?>">استراتژی بارگذاری:</label>
                    <select class="widefat" id="<?php echo $this->get_field_id('loading_strategy'); ?>" name="<?php echo $this->get_field_name('loading_strategy'); ?>">
                        <option value="lazy" <?php selected($loading_strategy, 'lazy'); ?>>تنبلی (Lazy Loading) - پیشنهادی</option>
                        <option value="eager" <?php selected($loading_strategy, 'eager'); ?>>فوری (Eager) - برای بالای صفحه</option>
                        <option value="progressive" <?php selected($loading_strategy, 'progressive'); ?>>تدریجی (Blur Up) - نیازمند تصویر جایگزین</option>
                    </select>
                </p>
                <p>
                    <label for="<?php echo $this->get_field_id('size_strategy'); ?>">ابعاد:</label>
                    <select class="widefat" id="<?php echo $this->get_field_id('size_strategy'); ?>" name="<?php echo $this->get_field_name('size_strategy'); ?>">
                        <option value="responsive" <?php selected($size_strategy, 'responsive'); ?>>واکنش‌گرا (عرض ۱۰۰٪ خودکار)</option>
                        <option value="standard_300_250" <?php selected($size_strategy, 'standard_300_250'); ?>>مستطیل متوسط (300x250)</option>
                        <option value="standard_728_90" <?php selected($size_strategy, 'standard_728_90'); ?>>لیدربرد (728x90)</option>
                        <option value="standard_300_600" <?php selected($size_strategy, 'standard_300_600'); ?>>نیم‌صفحه (300x600)</option>
                        <option value="custom" <?php selected($size_strategy, 'custom'); ?>>ابعاد سفارشی</option>
                    </select>
                </p>
                <div class="custom-sizes" style="<?php echo ($size_strategy !== 'custom') ? 'display:none;' : ''; ?>">
                    <p>
                        <label for="<?php echo $this->get_field_id('width'); ?>">عرض (پیکسل):</label>
                        <input class="tiny-text" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="number" value="<?php echo esc_attr($width); ?>">
                    </p>
                    <p>
                        <label for="<?php echo $this->get_field_id('height'); ?>">ارتفاع (پیکسل):</label>
                        <input class="tiny-text" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="number" value="<?php echo esc_attr($height); ?>">
                    </p>
                </div>
            </div>

            <div style="background: #f0f0f1; padding: 10px; border-radius: 4px; margin-bottom: 10px;">
                <strong>لینک مقصد</strong>
                <p>
                    <label for="<?php echo $this->get_field_id('link_url'); ?>">آدرس لینک:</label>
                    <input class="widefat" id="<?php echo $this->get_field_id('link_url'); ?>" name="<?php echo $this->get_field_name('link_url'); ?>" type="text" value="<?php echo esc_attr($link_url); ?>">
                </p>
                <p>
                    <label for="<?php echo $this->get_field_id('link_target'); ?>">نحوه باز شدن:</label>
                    <select class="widefat" id="<?php echo $this->get_field_id('link_target'); ?>" name="<?php echo $this->get_field_name('link_target'); ?>">
                        <option value="_blank" <?php selected($link_target, '_blank'); ?>>تب جدید (_blank)</option>
                        <option value="_self" <?php selected($link_target, '_self'); ?>>همان صفحه (_self)</option>
                    </select>
                </p>
            </div>
        </div>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = [];
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['media_type'] = sanitize_key($new_instance['media_type']);
        $instance['media_url'] = esc_url_raw($new_instance['media_url']);
        $instance['poster_url'] = esc_url_raw($new_instance['poster_url']);
        $instance['link_url'] = esc_url_raw($new_instance['link_url']);
        $instance['link_target'] = sanitize_key($new_instance['link_target']);
        $instance['loading_strategy'] = sanitize_key($new_instance['loading_strategy']);
        $instance['size_strategy'] = sanitize_key($new_instance['size_strategy']);
        $instance['width'] = absint($new_instance['width']);
        $instance['height'] = absint($new_instance['height']);
        return $instance;
    }
}

/**
 * Widget: Posts List (multi-style)
 */
class Hasht_Selected_News_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'hasht_selected_news',
            'نماد اقتصاد: لیست پست‌ها',
            ['description' => 'نمایش لیست پست‌ها بر اساس دسته یا پست‌های چسبان با استایل‌های مختلف']
        );
    }

    public function widget($args, $instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'لیست پست‌ها';
        $category = !empty($instance['category']) ? $instance['category'] : 0;
        $count = !empty($instance['count']) ? $instance['count'] : 5;
        $sticky_only = !empty($instance['sticky_only']) ? true : false;
        $query_type = !empty($instance['query_type']) ? $instance['query_type'] : 'latest';
        $exclude_cats_raw = !empty($instance['exclude_cats']) ? $instance['exclude_cats'] : '';
        $style = !empty($instance['style']) ? $instance['style'] : 'list';
        $view_more_text = !empty($instance['view_more_text']) ? $instance['view_more_text'] : 'مشاهده بیشتر';
        $view_more_url = !empty($instance['view_more_url']) ? $instance['view_more_url'] : '';

        $query_args = [
            'post_type'      => 'post',
            'posts_per_page' => $count,
            'post_status'    => 'publish',
            'ignore_sticky_posts' => 1,
        ];

        $exclude_cats = [];
        if (!empty($exclude_cats_raw)) {
            $parts = array_filter(array_map('trim', explode(',', $exclude_cats_raw)));
            foreach ($parts as $part) {
                $id = absint($part);
                if ($id > 0) {
                    $exclude_cats[] = $id;
                }
            }
        }
        if (!empty($exclude_cats)) {
            $query_args['category__not_in'] = $exclude_cats;
        }

        if ($sticky_only) {
            $sticky = get_option('sticky_posts');
            if (!empty($sticky)) {
                $query_args['post__in'] = $sticky;
            } else {
                return; 
            }
        } elseif ($query_type === 'category' && $category > 0) {
            $query_args['cat'] = $category;
        }

        $query = new WP_Query($query_args);

        if (empty($view_more_url)) {
            if ($category > 0) {
                $cat_link = get_category_link($category);
                if (!is_wp_error($cat_link)) {
                    $view_more_url = $cat_link;
                }
            }
            if (empty($view_more_url)) {
                $posts_page_id = get_option('page_for_posts');
                if ($posts_page_id) {
                    $view_more_url = get_permalink($posts_page_id);
                } else {
                    $archive = get_post_type_archive_link('post');
                    $view_more_url = $archive ? $archive : home_url('/');
                }
            }
        }

        if ($query->have_posts()) {
            if ($style === 'latest') {
                echo '<div class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm flex flex-col">';

                echo '<div class="flex items-center justify-between mb-4 shrink-0">';
                echo '<h3 class="section-title flex items-center gap-4 text-xl font-medium">';
                echo '<div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0">';
                echo '<div class="h-1/3 bg-slate-400"></div><div class="h-2/3 bg-primary"></div>';
                echo '</div>';
                echo esc_html($title);
                echo '</h3>';
                if (!empty($view_more_url)) {
                    echo '<a href="' . esc_url($view_more_url) . '" class="flex items-center gap-1 text-[10px] font-medium text-rose-600 hover:gap-2 transition-all">';
                    echo esc_html($view_more_text) . ' <i data-lucide="arrow-left" width="12"></i>';
                    echo '</a>';
                }
                echo '</div>';

                echo '<div class="flex flex-col space-y-1 max-h-[800px] overflow-y-auto custom-scroll pl-2">';
                while ($query->have_posts()) {
                    $query->the_post();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="py-2.5 border-b border-slate-50 dark:border-slate-800/50 last:border-none group cursor-pointer">
                        <div class="flex items-start gap-3">
                            <div class="w-1 h-1 rounded-full bg-rose-600 shrink-0 mt-2 opacity-30 group-hover:opacity-100 transition-opacity"></div>
                            <div>
                                <h3 class="text-[14px] font-bold text-slate-700 dark:text-slate-300 group-hover:text-rose-600 transition-colors line-clamp-2 leading-relaxed">
                                    <?php the_title(); ?>
                                </h3>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                echo '</div>';
                echo '</div>';
            } elseif ($style === 'most_viewed') {
                echo '<div class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm flex flex-col">';
                echo '<div class="flex items-center justify-between mb-4 shrink-0">';
                echo '<h3 class="section-title flex items-center gap-4 text-xl font-medium">';
                echo '<div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0">';
                echo '<div class="h-1/3 bg-slate-400"></div><div class="h-2/3 bg-primary"></div>';
                echo '</div>';
                echo esc_html($title);
                echo '</h3>';
                if (!empty($view_more_url)) {
                    echo '<a href="' . esc_url($view_more_url) . '" class="flex items-center gap-1 text-[10px] font-medium text-rose-600 hover:gap-2 transition-all">';
                    echo esc_html($view_more_text) . ' <i data-lucide="arrow-left" width="12"></i>';
                    echo '</a>';
                }
                echo '</div>';

                echo '<div class="flex flex-col space-y-4">';
                $i = 1;
                while ($query->have_posts()) {
                    $query->the_post();
                    $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'hasht-small-rect');
                    ?>
                    <a href="<?php the_permalink(); ?>" class="group flex gap-3 items-start">
                        <div class="w-24 h-20 rounded-lg overflow-visible shrink-0 relative shadow-sm">
                            <?php if ($thumb_url) : ?>
                                <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover rounded-lg group-hover:scale-110 transition-transform duration-500">
                            <?php else : ?>
                                <div class="w-full h-full rounded-lg bg-slate-200 dark:bg-slate-700"></div>
                            <?php endif; ?>
                            <div class="absolute -top-2 -right-2 bg-rose-600 text-white text-sm font-light w-6 h-6 flex items-center justify-center rounded-full shadow-md z-10">
                                <?php echo $i++; ?>
                            </div>
                        </div>
                        <h4 class="text-[14px] font-bold text-slate-700 dark:text-slate-300 leading-relaxed group-hover:text-rose-600 transition-colors line-clamp-2">
                            <?php the_title(); ?>
                        </h4>
                    </a>
                    <?php
                }
                echo '</div>';
                echo '</div>';
            } else {
                echo '<div class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">';

                echo '<div class="flex items-center justify-between mb-4 shrink-0">';
                echo '<h3 class="section-title flex items-center gap-4 text-xl font-medium">';
                echo '<div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0">';
                echo '<div class="h-1/3 bg-slate-400"></div><div class="h-2/3 bg-primary"></div>';
                echo '</div>';
                echo esc_html($title);
                echo '</h3>';
                if (!empty($view_more_url)) {
                    echo '<a href="' . esc_url($view_more_url) . '" class="flex items-center gap-1 text-[10px] font-medium text-rose-600 hover:gap-2 transition-all">';
                    echo esc_html($view_more_text) . ' <i data-lucide="arrow-left" width="12"></i>';
                    echo '</a>';
                }
                echo '</div>';

                echo '<div class="flex flex-col space-y-4">';

                while ($query->have_posts()) {
                    $query->the_post();
                    ?>
                    <div class="group cursor-pointer flex items-center gap-5 border-b border-slate-50 dark:border-slate-800/50 py-4 last:border-none">
                        <div class="flex shrink-0 items-center justify-center min-w-[0.875rem] h-3.5 rounded-full border border-primary/40 bg-primary/5 group-hover:bg-primary transition-colors">
                            <div class="w-1 h-1 rounded-full bg-primary group-hover:bg-white transition-colors"></div>
                        </div>
                        <h4 class="text-[14px] font-bold text-text-main dark:text-slate-300 group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h4>
                    </div>
                    <?php
                }
                echo '</div>';
                echo '</div>';
            }
            wp_reset_postdata();
        }
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'لیست پست‌ها';
        $category = !empty($instance['category']) ? $instance['category'] : 0;
        $count = !empty($instance['count']) ? $instance['count'] : 5;
        $sticky_only = !empty($instance['sticky_only']) ? true : false;
        $query_type = !empty($instance['query_type']) ? $instance['query_type'] : 'latest';
        $exclude_cats = !empty($instance['exclude_cats']) ? $instance['exclude_cats'] : '';
        $style = !empty($instance['style']) ? $instance['style'] : 'list';
        $view_more_text = !empty($instance['view_more_text']) ? $instance['view_more_text'] : 'مشاهده بیشتر';
        $view_more_url = !empty($instance['view_more_url']) ? $instance['view_more_url'] : '';

        $styles = [
            'list'        => 'لیستی کلاسیک (پیش‌فرض)',
            'latest'      => 'لیستی اسکرولی (الگوی آخرین اخبار)',
            'most_viewed' => 'کارتی با تصویر (الگوی پربازدیدها)',
        ];
        $query_types = [
            'latest'   => 'آخرین پست‌ها (بدون دسته خاص)',
            'category' => 'فقط یک دسته خاص',
        ];
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">عنوان:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('count')); ?>">تعداد نمایش:</label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($count); ?>" size="3">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('query_type')); ?>">نوع کوئری:</label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('query_type')); ?>" name="<?php echo esc_attr($this->get_field_name('query_type')); ?>">
                <?php foreach ($query_types as $key => $label) : ?>
                    <option value="<?php echo esc_attr($key); ?>" <?php selected($query_type, $key); ?>><?php echo esc_html($label); ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('style')); ?>">استایل نمایش:</label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('style')); ?>" name="<?php echo esc_attr($this->get_field_name('style')); ?>">
                <?php foreach ($styles as $key => $label) : ?>
                    <option value="<?php echo esc_attr($key); ?>" <?php selected($style, $key); ?>><?php echo esc_html($label); ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($sticky_only); ?> id="<?php echo esc_attr($this->get_field_id('sticky_only')); ?>" name="<?php echo esc_attr($this->get_field_name('sticky_only')); ?>">
            <label for="<?php echo esc_attr($this->get_field_id('sticky_only')); ?>">نمایش فقط پست‌های چسبان (Sticky)</label>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('category')); ?>">دسته‌بندی (اگر چسبان انتخاب نشده باشد):</label>
            <?php wp_dropdown_categories([
                'show_option_all' => 'همه دسته‌ها',
                'hide_empty'      => 0,
                'id'              => $this->get_field_id('category'),
                'name'            => $this->get_field_name('category'),
                'selected'        => $category,
                'class'           => 'widefat',
            ]); ?>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('exclude_cats')); ?>">شناسه دسته‌هایی که نباید نمایش داده شوند (با کاما جدا کنید):</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('exclude_cats')); ?>" name="<?php echo esc_attr($this->get_field_name('exclude_cats')); ?>" type="text" value="<?php echo esc_attr($exclude_cats); ?>" placeholder="مثلاً 1,5,12">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('view_more_text')); ?>">متن دکمه (در استایل‌های ۲ و ۳):</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('view_more_text')); ?>" name="<?php echo esc_attr($this->get_field_name('view_more_text')); ?>" type="text" value="<?php echo esc_attr($view_more_text); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('view_more_url')); ?>">لینک دکمه (در استایل‌های ۲ و ۳):</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('view_more_url')); ?>" name="<?php echo esc_attr($this->get_field_name('view_more_url')); ?>" type="text" value="<?php echo esc_attr($view_more_url); ?>" placeholder="<?php echo esc_attr(home_url()); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = [];
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['count'] = (!empty($new_instance['count'])) ? absint($new_instance['count']) : 5;
        $instance['category'] = (!empty($new_instance['category'])) ? absint($new_instance['category']) : 0;
        $instance['sticky_only'] = (!empty($new_instance['sticky_only'])) ? true : false;
        $instance['query_type'] = (!empty($new_instance['query_type'])) ? sanitize_key($new_instance['query_type']) : 'latest';
        $instance['exclude_cats'] = (!empty($new_instance['exclude_cats'])) ? trim($new_instance['exclude_cats']) : '';
        $instance['style'] = (!empty($new_instance['style'])) ? sanitize_key($new_instance['style']) : 'list';
        $instance['view_more_text'] = (!empty($new_instance['view_more_text'])) ? strip_tags($new_instance['view_more_text']) : 'مشاهده بیشتر';
        $instance['view_more_url'] = (!empty($new_instance['view_more_url'])) ? esc_url_raw($new_instance['view_more_url']) : '';
        return $instance;
    }
}

/**
 * Widget: Market Dashboard (Dynamic)
 */
class Hasht_Market_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'hasht_market_widget',
            'نماد اقتصاد: پیشخوان بازار',
            ['description' => 'نمایش باکس‌های دسترسی سریع (روزنامه، ارز، بورس و...) با قابلیت ویرایش']
        );
    }

    public function widget($args, $instance) {
        // Defaults
        $defaults = [
            1 => ['label' => 'روزنامه‌ها', 'icon' => 'newspaper', 'link' => '#'],
            2 => ['label' => 'ارز', 'icon' => 'dollar-sign', 'link' => '#'],
            3 => ['label' => 'طلا و سکه', 'icon' => 'coins', 'link' => '#'],
            4 => ['label' => 'بورس', 'icon' => 'bar-chart-3', 'link' => '#'],
            5 => ['label' => 'ارز دیجیتال', 'icon' => 'bitcoin', 'link' => '#'],
            6 => ['label' => 'خودرو', 'icon' => 'car', 'link' => '#'],
        ];

        // Title
        $title = !empty($instance['title']) ? $instance['title'] : 'پیشخوان بازار';

        echo '<section class="bg-white dark:bg-slate-900 p-3 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm transition-colors mb-6" aria-label="Market Widget">';
        echo '<h3 class="section-title flex items-center gap-4 mb-4 text-xl font-medium">';
        echo '<div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0"><div class="h-1/3 bg-slate-400"></div><div class="h-2/3 bg-primary"></div></div>';
        echo esc_html($title);
        echo '</h3>';
        echo '<div class="grid grid-cols-3 gap-3">';

        for ($i = 1; $i <= 6; $i++) {
            $label = !empty($instance["item_{$i}_label"]) ? $instance["item_{$i}_label"] : $defaults[$i]['label'];
            $icon  = !empty($instance["item_{$i}_icon"]) ? $instance["item_{$i}_icon"] : $defaults[$i]['icon'];
            $link  = !empty($instance["item_{$i}_link"]) ? $instance["item_{$i}_link"] : $defaults[$i]['link'];

            echo '<a href="' . esc_url($link) . '" class="flex flex-col items-center gap-2 group transition-all">';
            echo '<div class="w-full aspect-square flex items-center justify-center bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 rounded-xl group-hover:border-primary group-hover:bg-white dark:group-hover:bg-slate-800 transition-all text-slate-500 dark:text-text-light group-hover:text-primary shadow-sm">';
            echo '<i data-lucide="' . esc_attr($icon) . '" width="56" stroke-width="1.2"></i>';
            echo '</div>';
            echo '<span class="text-sm font-medium text-text-main dark:text-slate-300 group-hover:text-primary text-center leading-tight">' . esc_html($label) . '</span>';
            echo '</a>';
        }

        echo '</div>';
        echo '</section>';
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'پیشخوان بازار';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">عنوان ویجت:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <hr>
        <?php
        $defaults = [
            1 => ['label' => 'روزنامه‌ها', 'icon' => 'newspaper'],
            2 => ['label' => 'ارز', 'icon' => 'dollar-sign'],
            3 => ['label' => 'طلا و سکه', 'icon' => 'coins'],
            4 => ['label' => 'بورس', 'icon' => 'bar-chart-3'],
            5 => ['label' => 'ارز دیجیتال', 'icon' => 'bitcoin'],
            6 => ['label' => 'خودرو', 'icon' => 'car'],
        ];

        for ($i = 1; $i <= 6; $i++) {
            $label = !empty($instance["item_{$i}_label"]) ? $instance["item_{$i}_label"] : $defaults[$i]['label'];
            $icon  = !empty($instance["item_{$i}_icon"]) ? $instance["item_{$i}_icon"] : $defaults[$i]['icon'];
            $link  = !empty($instance["item_{$i}_link"]) ? $instance["item_{$i}_link"] : '';
            ?>
            <div style="border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; background: #fafafa;">
                <strong>آیتم شماره <?php echo $i; ?></strong>
                <p>
                    <label for="<?php echo esc_attr($this->get_field_id("item_{$i}_label")); ?>">عنوان:</label>
                    <input class="widefat" id="<?php echo esc_attr($this->get_field_id("item_{$i}_label")); ?>" name="<?php echo esc_attr($this->get_field_name("item_{$i}_label")); ?>" type="text" value="<?php echo esc_attr($label); ?>">
                </p>
                <p>
                    <label for="<?php echo esc_attr($this->get_field_id("item_{$i}_link")); ?>">لینک:</label>
                    <input class="widefat" id="<?php echo esc_attr($this->get_field_id("item_{$i}_link")); ?>" name="<?php echo esc_attr($this->get_field_name("item_{$i}_link")); ?>" type="text" value="<?php echo esc_attr($link); ?>" placeholder="https://...">
                </p>
                <p>
                    <label for="<?php echo esc_attr($this->get_field_id("item_{$i}_icon")); ?>">نام آیکون (Lucide):</label>
                    <input class="widefat" id="<?php echo esc_attr($this->get_field_id("item_{$i}_icon")); ?>" name="<?php echo esc_attr($this->get_field_name("item_{$i}_icon")); ?>" type="text" value="<?php echo esc_attr($icon); ?>">
                </p>
            </div>
            <?php
        }
    }

    public function update($new_instance, $old_instance) {
        $instance = [];
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        for ($i = 1; $i <= 6; $i++) {
            $instance["item_{$i}_label"] = (!empty($new_instance["item_{$i}_label"])) ? strip_tags($new_instance["item_{$i}_label"]) : '';
            $instance["item_{$i}_link"]  = (!empty($new_instance["item_{$i}_link"])) ? esc_url_raw($new_instance["item_{$i}_link"]) : '';
            $instance["item_{$i}_icon"]  = (!empty($new_instance["item_{$i}_icon"])) ? sanitize_key($new_instance["item_{$i}_icon"]) : '';
        }
        return $instance;
    }
}

/**
 * Widget: Advertisement (Flexible Height)
 */
class Hasht_Advertisement_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'hasht_advertisement_widget',
            'نماد اقتصاد: تبلیغات (متغیر)',
            ['description' => 'باکس تبلیغاتی با قابلیت تنظیم ارتفاع']
        );
    }

    public function widget($args, $instance) {
        $height_class = !empty($instance['height_class']) ? $instance['height_class'] : 'h-[900px]';
        // Allow custom height class or style
        
        echo '<aside class="hidden md:flex w-full ' . esc_attr($height_class) . ' bg-slate-50 dark:bg-slate-800/40 rounded-xl flex-col items-center justify-center border-2 border-dashed border-slate-200 dark:border-slate-800 text-slate-400 cursor-pointer transition-all hover:bg-slate-100 dark:hover:bg-slate-800/60 group relative mb-6" aria-label="Advertisement">';
        echo '<div class="absolute top-6 right-6 px-3 py-1 bg-slate-200 dark:bg-slate-700 rounded-lg text-xs font-medium group-hover:bg-primary group-hover:text-white transition-colors">تبلیغات</div>';
        echo '<div class="p-10 text-center">';
        echo '<div class="w-20 h-20 bg-slate-200 dark:bg-slate-700 rounded-2xl mx-auto mb-8 flex items-center justify-center group-hover:rotate-12 transition-transform">';
        echo '<i data-lucide="trending-up" width="40" class="text-slate-400 group-hover:text-primary transition-colors"></i>';
        echo '</div>';
        echo '<span class="text-2xl font-medium block mb-4">فضای آگهی</span>';
        echo '<p class="text-sm font-medium opacity-60">جهت درج رپورتاژ و بنر در نماد اقتصاد کلیک کنید</p>';
        echo '</div>';
        echo '</aside>';
    }

    public function form($instance) {
        $height_class = !empty($instance['height_class']) ? $instance['height_class'] : 'h-[900px]';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('height_class')); ?>">کلاس ارتفاع (Tailwind):</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('height_class')); ?>" name="<?php echo esc_attr($this->get_field_name('height_class')); ?>" type="text" value="<?php echo esc_attr($height_class); ?>" placeholder="مثلاً h-[500px] یا h-full">
            <small>برای پر کردن فضا می‌توانید از h-full استفاده کنید (اگر والد فلکس باشد) یا ارتفاع ثابت بدهید.</small>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = [];
        $instance['height_class'] = (!empty($new_instance['height_class'])) ? strip_tags($new_instance['height_class']) : 'h-[900px]';
        return $instance;
    }
}
