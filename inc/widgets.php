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
        'before_title'  => '<h3 class="section-title flex items-center gap-4 mb-4 text-xl font-black"><div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0"><div class="h-1/3 bg-slate-400"></div><div class="h-2/3 bg-primary"></div></div>',
        'after_title'   => '</h3>',
    ]);

    register_sidebar([
        'name'          => 'سایدبار اصلی (صفحات داخلی)',
        'id'            => 'main-sidebar',
        'description'   => 'ویجت‌های سایدبار صفحات داخلی (نوشته‌ها، برگه‌ها و آرشیو) را اینجا قرار دهید.',
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-6">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="section-title flex items-center gap-4 mb-4 text-xl font-black"><div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0"><div class="h-1/3 bg-slate-400"></div><div class="h-2/3 bg-primary"></div></div>',
        'after_title'   => '</h3>',
    ]);

    register_sidebar([
        'name'          => 'سایدبار هیرو (ستون کناری)',
        'id'            => 'hero-sidebar',
        'description'   => 'این سایدبار در بخش هیرو (بالای صفحه اصلی) نمایش داده می‌شود. می‌توانید ویجت پیشخوان بازار یا لیست اخبار را اینجا قرار دهید.',
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-6">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="section-title flex items-center gap-4 mb-4 text-xl font-black"><div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0"><div class="h-1/3 bg-slate-400"></div><div class="h-2/3 bg-primary"></div></div>',
        'after_title'   => '</h3>',
    ]);

    register_sidebar([
        'name'          => 'سایدبار یادداشت و مصاحبه (صفحه اصلی)',
        'id'            => 'home-notes-sidebar',
        'description'   => 'این سایدبار مخصوص ویجت یادداشت و مصاحبه در صفحه اصلی است.',
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-6">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="section-title flex items-center gap-4 mb-4 text-xl font-black"><div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0"><div class="h-1/3 bg-slate-400"></div><div class="h-2/3 bg-primary"></div></div>',
        'after_title'   => '</h3>',
    ]);

    register_widget('Hasht_Selected_News_Widget');
    register_widget('Hasht_Market_Widget');
    register_widget('Hasht_Advertisement_Widget');
    register_widget('Hasht_Pro_Ad_Widget');
    register_widget('Hasht_Notes_Interviews_Widget');
}
add_action('widgets_init', 'hasht_widgets_init');

/**
 * Widget: Selected News (Numbered List)
 */
class Hasht_Selected_News_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'hasht_selected_news_widget',
            'نماد اقتصاد: اخبار برگزیده',
            ['description' => 'نمایش لیست اخبار برگزیده با شماره‌گذاری (مشابه بخش کناری هیرو)']
        );
    }

    public function widget($args, $instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'اخبار برگزیده';
        $cat = !empty($instance['cat']) ? $instance['cat'] : 0;
        $count = !empty($instance['count']) ? $instance['count'] : 5;

        // Start Widget
        // Note: We use custom HTML structure based on hero-section.php
        
        echo '<div class="flex items-center gap-3 mb-4 lg:mb-6">';
        echo '<h3 class="section-title flex items-center gap-4 text-xl font-black">';
        echo '<div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0">';
        echo '<div class="h-1/3 bg-slate-400"></div><div class="h-2/3 bg-rose-600"></div>';
        echo '</div>';
        echo esc_html($title);
        echo '</h3>';
        echo '</div>';

        echo '<div class="flex flex-col space-y-4">';

        $query_args = [
            'post_type'      => 'post',
            'posts_per_page' => $count,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ];
        if ($cat) {
            $query_args['cat'] = $cat;
        }

        $query = new WP_Query($query_args);
        $i = 1;

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                ?>
                <a href="<?php the_permalink(); ?>" class="group cursor-pointer flex gap-5 border-b border-slate-50 dark:border-slate-800/50 py-4 last:border-none">
                    <span class="text-4xl font-black text-rose-600 group-hover:text-slate-200 dark:group-hover:text-slate-800 transition-colors min-w-[2.5rem] mt-0">
                        <?php echo $i; ?>
                    </span>
                    <h4 class="text-[14px] font-bold text-slate-700 dark:text-slate-300 group-hover:text-rose-600 transition-colors line-clamp-2 leading-snug">
                        <?php the_title(); ?>
                    </h4>
                </a>
                <?php
                $i++;
            }
            wp_reset_postdata();
        } else {
            echo '<p class="text-slate-500 text-sm">مطلبی یافت نشد.</p>';
        }

        echo '</div>'; // End list
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'اخبار برگزیده';
        $cat = !empty($instance['cat']) ? $instance['cat'] : 0;
        $count = !empty($instance['count']) ? $instance['count'] : 5;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">عنوان:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('cat'); ?>">دسته‌بندی:</label>
            <?php wp_dropdown_categories([
                'show_option_all' => 'همه دسته‌ها',
                'name'            => $this->get_field_name('cat'),
                'id'              => $this->get_field_id('cat'),
                'selected'        => $cat,
                'class'           => 'widefat',
                'hide_empty'      => 0,
            ]); ?>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('count'); ?>">تعداد نمایش:</label>
            <input class="tiny-text" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($count); ?>" size="3">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = [];
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['cat'] = absint($new_instance['cat']);
        $instance['count'] = absint($new_instance['count']);
        return $instance;
    }
}

/**
 * Widget: Market (Static Grid)
 */
class Hasht_Market_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'hasht_market_widget',
            'نماد اقتصاد: پیشخوان بازار',
            ['description' => 'نمایش باکس‌های قیمت بازار (استاتیک)']
        );
    }

    public function widget($args, $instance) {
        // Output static HTML from widget-market.php
        ?>
        <section class="bg-white dark:bg-slate-900 p-3 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm transition-colors" aria-label="Market Widget">
            <h3 class="section-title flex items-center gap-4 mb-4 text-xl font-black">
                <div class="w-1.5 h-8 flex flex-col  rounded-full overflow-hidden shrink-0">
                    <div class="h-1/3 bg-slate-400"></div>
                    <div class="h-2/3 bg-rose-600"></div>
                </div>
                پیشخوان بازار
            </h3>
            <div class="grid grid-cols-3 gap-3">
                <a href="#" class="flex flex-col items-center gap-2 group transition-all">
                    <div class="w-full aspect-square flex items-center justify-center bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 rounded-xl group-hover:border-rose-600 group-hover:bg-white dark:group-hover:bg-slate-800 transition-all text-slate-500 dark:text-slate-400 group-hover:text-rose-600 shadow-sm">
                        <i data-lucide="newspaper" width="56" stroke-width="1.2"></i>
                    </div>
                    <span class="text-sm font-black text-slate-700 dark:text-slate-300 group-hover:text-rose-600 text-center leading-tight">روزنامه‌ها</span>
                </a>
                <a href="#" class="flex flex-col items-center gap-2 group transition-all">
                    <div class="w-full aspect-square flex items-center justify-center bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 rounded-xl group-hover:border-rose-600 group-hover:bg-white dark:group-hover:bg-slate-800 transition-all text-slate-500 dark:text-slate-400 group-hover:text-rose-600 shadow-sm">
                        <i data-lucide="dollar-sign" width="56" stroke-width="1.2"></i>
                    </div>
                    <span class="text-sm font-black text-slate-700 dark:text-slate-300 group-hover:text-rose-600 text-center leading-tight">ارز</span>
                </a>
                <a href="#" class="flex flex-col items-center gap-2 group transition-all">
                    <div class="w-full aspect-square flex items-center justify-center bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 rounded-xl group-hover:border-rose-600 group-hover:bg-white dark:group-hover:bg-slate-800 transition-all text-slate-500 dark:text-slate-400 group-hover:text-rose-600 shadow-sm">
                        <i data-lucide="coins" width="56" stroke-width="1.2"></i>
                    </div>
                    <span class="text-sm font-black text-slate-700 dark:text-slate-300 group-hover:text-rose-600 text-center leading-tight">طلا و سکه</span>
                </a>
                <a href="#" class="flex flex-col items-center gap-2 group transition-all">
                    <div class="w-full aspect-square flex items-center justify-center bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 rounded-xl group-hover:border-rose-600 group-hover:bg-white dark:group-hover:bg-slate-800 transition-all text-slate-500 dark:text-slate-400 group-hover:text-rose-600 shadow-sm">
                        <i data-lucide="bar-chart-3" width="56" stroke-width="1.2"></i>
                    </div>
                    <span class="text-sm font-black text-slate-700 dark:text-slate-300 group-hover:text-rose-600 text-center leading-tight">بورس</span>
                </a>
                <a href="#" class="flex flex-col items-center gap-2 group transition-all">
                    <div class="w-full aspect-square flex items-center justify-center bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 rounded-xl group-hover:border-rose-600 group-hover:bg-white dark:group-hover:bg-slate-800 transition-all text-slate-500 dark:text-slate-400 group-hover:text-rose-600 shadow-sm">
                        <i data-lucide="bitcoin" width="56" stroke-width="1.2"></i>
                    </div>
                    <span class="text-sm font-black text-slate-700 dark:text-slate-300 group-hover:text-rose-600 text-center leading-tight">ارز دیجیتال</span>
                </a>
                <a href="#" class="flex flex-col items-center gap-2 group transition-all">
                    <div class="w-full aspect-square flex items-center justify-center bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 rounded-xl group-hover:border-rose-600 group-hover:bg-white dark:group-hover:bg-slate-800 transition-all text-slate-500 dark:text-slate-400 group-hover:text-rose-600 shadow-sm">
                        <i data-lucide="car" width="56" stroke-width="1.2"></i>
                    </div>
                    <span class="text-sm font-black text-slate-700 dark:text-slate-300 group-hover:text-rose-600 text-center leading-tight">خودرو</span>
                </a>
            </div>
        </section>
        <?php
    }
}

/**
 * Widget: Advertisement (Static Box)
 */
class Hasht_Advertisement_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'hasht_advertisement_widget',
            'نماد اقتصاد: تبلیغات (ساده)',
            ['description' => 'نمایش باکس تبلیغات ساده']
        );
    }

    public function widget($args, $instance) {
        ?>
        <aside class="hidden md:flex w-full h-[100px] bg-slate-50 dark:bg-slate-800/40 rounded-xl flex-row items-center justify-start px-3 border-2 border-dashed border-slate-200 dark:border-slate-800 text-slate-400 cursor-pointer transition-all hover:bg-slate-100 dark:hover:bg-slate-800/60 group relative mt-6 gap-3" aria-label="Advertisement">
            <div class="w-10 h-10 bg-slate-200 dark:bg-slate-700 rounded-lg flex items-center justify-center group-hover:rotate-12 transition-transform shrink-0">
                <i data-lucide="trending-up" width="20" class="text-slate-400 group-hover:text-rose-600 transition-colors"></i>
            </div>
            <div class="flex flex-col items-start justify-center">
                <span class="text-xs font-black text-slate-600 dark:text-slate-300 group-hover:text-rose-600 transition-colors block">فضای آگهی</span>
                <span class="text-[10px] font-medium opacity-60 leading-none mt-1">جهت درج رپورتاژ و بنر کلیک کنید</span>
            </div>
        </aside>
        <?php
    }
}

/**
 * Widget: Notes and Interviews
 * Displays notes and interviews with author metadata and specific styling.
 */
class Hasht_Notes_Interviews_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'hasht_notes_interviews_widget',
            'نماد اقتصاد: یادداشت و مصاحبه',
            ['description' => 'نمایش یادداشت‌ها و مصاحبه‌ها با استایل مخصوص و متای نویسنده']
        );
    }

    public function widget($args, $instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'یادداشت و مصاحبه';
        $cat = !empty($instance['cat']) ? $instance['cat'] : 0;
        $count = !empty($instance['count']) ? $instance['count'] : 3;

        $cat_link = '#';
        if ($cat) {
            $cat_link = get_category_link($cat);
        }

        echo '<div class="space-y-5 sticky top-10">';
        echo '<div class="flex items-center justify-between">';
        echo '<h3 class="section-title flex items-center gap-4 dark:text-white">';
        echo '<div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0">';
        echo '<div class="h-1/3 bg-slate-400"></div><div class="h-2/3 bg-rose-600"></div>';
        echo '</div>';
        echo esc_html($title);
        echo '</h3>';
        
        // See More Link
        if ($cat) {
             echo '<a href="' . esc_url($cat_link) . '" class="link-more text-sm text-slate-500 hover:text-rose-600 transition-colors flex items-center gap-1">مشاهده بیشتر <i data-lucide="arrow-left" width="12"></i></a>';
        }
        echo '</div>';

        $query_args = [
            'post_type'      => 'post',
            'posts_per_page' => $count,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ];
        if ($cat) {
            $query_args['cat'] = $cat;
        }

        $query = new WP_Query($query_args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $post_id = get_the_ID();
                $content_type = get_post_meta($post_id, '_news_content_type', true);

                // Default logic
                $author_name = ''; 
                $author_role = '';
                $icon = 'quote';

                if ($content_type === 'note') {
                    $meta_name = get_post_meta($post_id, '_news_author_name', true);
                    // Use meta name if exists, otherwise keep empty
                    if (!empty($meta_name)) $author_name = $meta_name;

                    $meta_role = get_post_meta($post_id, '_news_author_position', true);
                    if (!empty($meta_role)) $author_role = $meta_role;

                    $icon = 'quote';
                } elseif ($content_type === 'interview') {
                    $meta_name = get_post_meta($post_id, '_news_interviewee_name', true);
                    if (!empty($meta_name)) $author_name = $meta_name;

                    $meta_role = get_post_meta($post_id, '_news_interviewee_position', true);
                    if (!empty($meta_role)) $author_role = $meta_role;

                    $icon = 'mic-vocal';
                }
                
                // Fallback ONLY if author_name is still empty
                if (empty($author_name)) {
                     $author_name = get_the_author(); 
                }

                $thumb_url = get_the_post_thumbnail_url($post_id, 'thumbnail');
                if (!$thumb_url) {
                    // Fallback to avatar
                    $thumb_url = get_avatar_url(get_the_author_meta('ID'), ['size' => 150]);
                }

                ?>
                <a href="<?php the_permalink(); ?>" class="block">
                    <div class="flex flex-col gap-4 p-3 bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 transition-all cursor-pointer group dark:hover:border-rose-900/30 shadow-sm hover:shadow-md">
                        <div class="flex items-center gap-2">
                            <div class="w-16 h-16 rounded-full border-2 border-rose-100 dark:border-rose-900/50 overflow-hidden shadow-inner shrink-0">
                                <img src="<?php echo esc_url($thumb_url); ?>"
                                    class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700"
                                    alt="<?php echo esc_attr($author_name); ?>">
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm font-black text-slate-800 dark:text-slate-200 group-hover:text-rose-600 transition-colors">
                                    <?php echo esc_html($author_name); ?>
                                </span>
                                <span class="text-[10px] text-slate-400 font-bold mt-0.5">
                                    <?php echo esc_html($author_role); ?>
                                </span>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="shrink-0 mt-1 text-rose-600 group-hover:text-rose-600 transition-colors">
                                <i data-lucide="<?php echo esc_attr($icon); ?>" width="18"></i>
                            </div>
                            <h4 class="text-xl font-bold text-slate-700 dark:text-slate-300 leading-relaxed group-hover:text-slate-950 dark:group-hover:text-white transition-colors">
                                <?php the_title(); ?>
                            </h4>
                        </div>
                    </div>
                </a>
                <?php
            }
            wp_reset_postdata();
        } else {
            echo '<p class="text-slate-500 text-sm">مطلبی یافت نشد.</p>';
        }

        echo '</div>';
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'یادداشت و مصاحبه';
        $cat = !empty($instance['cat']) ? $instance['cat'] : 0;
        $count = !empty($instance['count']) ? $instance['count'] : 3;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">عنوان:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('cat'); ?>">دسته‌بندی:</label>
            <?php wp_dropdown_categories([
                'show_option_all' => 'همه دسته‌ها',
                'name'            => $this->get_field_name('cat'),
                'id'              => $this->get_field_id('cat'),
                'selected'        => $cat,
                'class'           => 'widefat',
                'hide_empty'      => 0,
            ]); ?>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('count'); ?>">تعداد نمایش:</label>
            <input class="tiny-text" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($count); ?>" size="3">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = [];
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['cat'] = (!empty($new_instance['cat'])) ? absint($new_instance['cat']) : 0;
        $instance['count'] = (!empty($new_instance['count'])) ? absint($new_instance['count']) : 3;
        return $instance;
    }
}

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
        
        // Link Wrapper (Optional)
        if (!empty($link_url)) {
            echo '<a href="' . esc_url($link_url) . '" target="' . esc_attr($link_target) . '" class="block w-full h-full">';
        }

        // Media Content
        if ($media_type === 'video') {
            echo '<video class="w-full h-full object-cover" autoplay muted loop playsinline poster="' . esc_url($poster_url) . '">';
            echo '<source src="' . esc_url($media_url) . '" type="video/mp4">';
            echo '</video>';
        } else {
            // Image
            $loading_attr = ($loading_strategy === 'eager') ? 'eager' : 'lazy';
            echo '<img src="' . esc_url($media_url) . '" alt="' . esc_attr($title) . '" class="w-full h-full object-cover" loading="' . esc_attr($loading_attr) . '">';
        }

        if (!empty($link_url)) {
            echo '</a>';
        }

        // Advertisement Label
        echo '<span class="absolute top-0 right-0 bg-black/30 text-white text-[9px] px-1.5 py-0.5 rounded-bl-lg backdrop-blur-sm">تبلیغات</span>';

        echo '</div>'; // End wrapper

        echo $args['after_widget'];
    }

    public function form($instance) {
        // Simple Form for now
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $media_url = !empty($instance['media_url']) ? $instance['media_url'] : '';
        $link_url = !empty($instance['link_url']) ? $instance['link_url'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">عنوان:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('media_url'); ?>">لینک مدیا (تصویر/ویدیو):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('media_url'); ?>" name="<?php echo $this->get_field_name('media_url'); ?>" type="text" value="<?php echo esc_attr($media_url); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link_url'); ?>">لینک مقصد:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('link_url'); ?>" name="<?php echo $this->get_field_name('link_url'); ?>" type="text" value="<?php echo esc_attr($link_url); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['media_url'] = strip_tags($new_instance['media_url']);
        $instance['link_url'] = strip_tags($new_instance['link_url']);
        return $instance;
    }
}
