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

    register_widget('Hasht_Selected_News_Widget');
    register_widget('Hasht_Market_Widget');
    register_widget('Hasht_Advertisement_Widget');
}
add_action('widgets_init', 'hasht_widgets_init');

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
                echo '<h3 class="section-title flex items-center gap-4 text-xl font-black">';
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
                echo '<h3 class="section-title flex items-center gap-4 text-xl font-black">';
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
                echo '<h3 class="section-title flex items-center gap-4 text-xl font-black">';
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
 * Widget: Market Dashboard (Hardcoded static content for now, but wrapper as widget)
 */
class Hasht_Market_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'hasht_market_widget',
            'نماد اقتصاد: پیشخوان بازار',
            ['description' => 'نمایش قیمت‌های بازار (استاتیک)']
        );
    }

    public function widget($args, $instance) {
        // Output exactly what was in the partial
        echo '<section class="bg-white dark:bg-slate-900 p-3 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm transition-colors mb-6" aria-label="Market Widget">';
        echo '<h3 class="section-title flex items-center gap-4 mb-4 text-xl font-black">';
        echo '<div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0"><div class="h-1/3 bg-slate-400"></div><div class="h-2/3 bg-primary"></div></div>';
        echo 'پیشخوان بازار';
        echo '</h3>';
        echo '<div class="grid grid-cols-3 gap-3">';
        
        $items = [
            ['icon' => 'newspaper', 'label' => 'روزنامه‌ها'],
            ['icon' => 'dollar-sign', 'label' => 'ارز'],
            ['icon' => 'coins', 'label' => 'طلا و سکه'],
            ['icon' => 'bar-chart-3', 'label' => 'بورس'],
            ['icon' => 'bitcoin', 'label' => 'ارز دیجیتال'],
            ['icon' => 'car', 'label' => 'خودرو'],
        ];

        foreach ($items as $item) {
            echo '<a href="#" class="flex flex-col items-center gap-2 group transition-all">';
            echo '<div class="w-full aspect-square flex items-center justify-center bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 rounded-xl group-hover:border-primary group-hover:bg-white dark:group-hover:bg-slate-800 transition-all text-slate-500 dark:text-text-light group-hover:text-primary shadow-sm">';
            echo '<i data-lucide="' . esc_attr($item['icon']) . '" width="56" stroke-width="1.2"></i>';
            echo '</div>';
            echo '<span class="text-sm font-black text-text-main dark:text-slate-300 group-hover:text-primary text-center leading-tight">' . esc_html($item['label']) . '</span>';
            echo '</a>';
        }

        echo '</div>';
        echo '</section>';
    }

    public function form($instance) {
        echo '<p>این ابزارک تنظیمات خاصی ندارد.</p>';
    }

    public function update($new_instance, $old_instance) {
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
        echo '<div class="absolute top-6 right-6 px-3 py-1 bg-slate-200 dark:bg-slate-700 rounded-lg text-xs font-black group-hover:bg-primary group-hover:text-white transition-colors">تبلیغات</div>';
        echo '<div class="p-10 text-center">';
        echo '<div class="w-20 h-20 bg-slate-200 dark:bg-slate-700 rounded-2xl mx-auto mb-8 flex items-center justify-center group-hover:rotate-12 transition-transform">';
        echo '<i data-lucide="trending-up" width="40" class="text-slate-400 group-hover:text-primary transition-colors"></i>';
        echo '</div>';
        echo '<span class="text-2xl font-black block mb-4">فضای آگهی</span>';
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
