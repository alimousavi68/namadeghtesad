<?php
/**
 * archive.php view
 */

if (is_post_type_archive('company') || is_tax('company_activity')) {
    core_start_section('content');

    $search = isset($_GET['q']) ? sanitize_text_field($_GET['q']) : '';
    $activity = isset($_GET['activity']) ? sanitize_text_field($_GET['activity']) : '';

    $queried = get_queried_object();
    if (is_tax('company_activity') && $queried && !empty($queried->term_id)) {
        $activity = (string) $queried->term_id;
    }

    $terms = get_terms([
        'taxonomy' => 'company_activity',
        'hide_empty' => false,
    ]);

    $paged = max(1, (int) get_query_var('paged'));

    $query_args = [
        'post_type' => 'company',
        'post_status' => 'publish',
        'paged' => $paged,
        'posts_per_page' => 12,
    ];

    if ($search !== '') {
        $query_args['s'] = $search;
    }

    if ($activity !== '' && $activity !== '0') {
        $tax_term = is_numeric($activity) ? absint($activity) : sanitize_title($activity);
        $query_args['tax_query'] = [
            [
                'taxonomy' => 'company_activity',
                'field' => is_numeric($activity) ? 'term_id' : 'slug',
                'terms' => $tax_term,
            ]
        ];
    }

    $companies = new WP_Query($query_args);
    $archive_link = get_post_type_archive_link('company');
    $title = is_tax('company_activity') && $queried ? ('موضوع فعالیت: ' . $queried->name) : 'شرکت‌ها';
    ?>

    <div class="container mx-auto px-4 mt-8 lg:mt-12">
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 md:p-6 shadow-sm">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="flex items-center gap-3">
                    <span class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                        <i data-lucide="building-2" width="18"></i>
                    </span>
                    <div>
                        <h1 class="text-lg md:text-xl font-bold text-slate-900 dark:text-slate-100"><?php echo esc_html($title); ?></h1>
                        <p class="text-sm text-slate-500 dark:text-slate-400">در این بخش می‌توانید پروفایل شرکت‌ها را مشاهده کنید، بر اساس نام جستجو کنید و با انتخاب موضوع فعالیت، نتایج را دقیق‌تر کنید.</p>
                    </div>
                </div>
                <form method="get" action="<?php echo esc_url($archive_link); ?>" class="w-full lg:w-auto">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <div class="md:col-span-2">
                            <div class="flex items-center gap-2 bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 rounded-xl px-3 py-2">
                                <i data-lucide="search" width="18" class="text-slate-400"></i>
                                <input type="text" name="q" value="<?php echo esc_attr($search); ?>" class="w-full bg-transparent outline-none text-sm text-slate-700 dark:text-slate-200 placeholder:text-slate-400" placeholder="نام شرکت را وارد کنید">
                            </div>
                        </div>
                        <div>
                            <select name="activity" class="w-full bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 rounded-xl px-3 py-2 text-sm text-slate-700 dark:text-slate-200">
                                <option value="0">همه موضوع‌ها</option>
                                <?php if (!is_wp_error($terms) && !empty($terms)) : ?>
                                    <?php foreach ($terms as $t) : ?>
                                        <option value="<?php echo esc_attr($t->term_id); ?>" <?php selected((string) $t->term_id, (string) $activity); ?>>
                                            <?php echo esc_html($t->name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 mt-3">
                        <button type="submit" class="px-4 py-2 rounded-xl bg-primary text-white font-bold text-sm hover:opacity-90 transition-opacity flex items-center gap-2">
                            <i data-lucide="filter" width="16"></i>
                            اعمال فیلتر
                        </button>
                        <a href="<?php echo esc_url($archive_link); ?>" class="px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-300 font-bold text-sm hover:border-primary hover:text-primary transition-colors">
                            پاک کردن
                        </a>
                        <span class="text-xs text-slate-400 mr-auto">
                            <?php echo number_format_i18n((int) $companies->found_posts); ?> نتیجه
                        </span>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            <?php if ($companies->have_posts()) : ?>
                <?php while ($companies->have_posts()) : $companies->the_post(); ?>
                    <?php
                    $company_id = get_the_ID();
                    $logo = get_the_post_thumbnail_url($company_id, 'thumbnail');
                    $website = get_post_meta($company_id, '_company_website', true);
                    $phones = get_post_meta($company_id, '_company_phones', true);
                    $intro = get_post_meta($company_id, '_company_intro', true);
                    $description = get_post_meta($company_id, '_company_description', true);
                    $summary_src = $intro ?: $description;
                    $summary = wp_trim_words(wp_strip_all_tags((string) $summary_src), 22, '…');
                    $activity_terms = get_the_terms($company_id, 'company_activity');
                    $first_phone = '';
                    if (!empty($phones)) {
                        $lines = preg_split('/\r\n|\r|\n/', (string) $phones);
                        $first_phone = trim((string) ($lines[0] ?? ''));
                    }
                    ?>
                    <article class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 shadow-sm hover:shadow-md hover:border-rose-200 dark:hover:border-rose-900/30 transition-all">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 rounded-2xl bg-slate-100 dark:bg-slate-800 overflow-hidden shrink-0 flex items-center justify-center">
                                <?php if ($logo) : ?>
                                    <img src="<?php echo esc_url($logo); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover">
                                <?php else : ?>
                                    <i data-lucide="building" width="22" class="text-slate-400"></i>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <h2 class="text-base font-bold text-slate-900 dark:text-slate-100">
                                        <a href="<?php the_permalink(); ?>" class="hover:text-primary transition-colors"><?php the_title(); ?></a>
                                    </h2>
                                </div>
                                <div class="mt-2 flex items-center gap-2 flex-wrap">
                                    <?php if (!is_wp_error($activity_terms) && !empty($activity_terms)) : ?>
                                        <?php foreach (array_slice($activity_terms, 0, 2) as $t) : ?>
                                            <a href="<?php echo esc_url(get_term_link($t)); ?>" class="text-[10px] font-bold text-primary bg-primary/10 px-2 py-0.5 rounded-md hover:opacity-90 transition-opacity">
                                                <?php echo esc_html($t->name); ?>
                                            </a>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <span class="text-[10px] font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 dark:text-slate-300 px-2 py-0.5 rounded-md">بدون موضوع</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <?php if ($summary !== '') : ?>
                            <p class="mt-4 text-sm text-slate-500 dark:text-slate-400 leading-relaxed text-justify line-clamp-3">
                                <?php echo esc_html($summary); ?>
                            </p>
                        <?php endif; ?>

                        <div class="mt-4 grid grid-cols-1 gap-2">
                            <?php if (!empty($website)) : ?>
                                <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                                    <i data-lucide="globe" width="14"></i>
                                    <a href="<?php echo esc_url($website); ?>" class="hover:text-primary transition-colors ltr" target="_blank" rel="noopener">
                                        <?php echo esc_html(preg_replace('#^https?://#', '', $website)); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($first_phone)) : ?>
                                <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                                    <i data-lucide="phone" width="14"></i>
                                    <span class="ltr"><?php echo esc_html($first_phone); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mt-5 pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                            <a href="<?php the_permalink(); ?>" class="text-sm font-bold text-primary flex items-center gap-2 hover:gap-3 transition-all">
                                مشاهده پروفایل
                                <i data-lucide="arrow-left" width="16"></i>
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="sm:col-span-2 lg:col-span-3 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-2xl p-8 text-center text-slate-500 dark:text-slate-300">
                    نتیجه‌ای یافت نشد.
                </div>
            <?php endif; ?>
        </div>

        <?php
        global $wp_query;
        $old_query = $wp_query;
        $wp_query = $companies;
        core_view('partials/pagination');
        $wp_query = $old_query;
        wp_reset_postdata();
        ?>
    </div>

    <?php
    core_end_section();
    core_view('layout/base');
    return;
}

// 1. Prepare Archive Header Data
$is_author_archive = false;
$archive_title = '';
$archive_description = get_the_archive_description();
$author_name = '';
$author_role = '';
$author_bio = '';
$author_image = '';

if (is_category()) {
    $archive_title = 'آرشیو دسته‌بندی: ' . single_cat_title('', false);
} elseif (is_tag()) {
    $archive_title = 'آرشیو برچسب: ' . single_tag_title('', false);
} elseif (is_author()) {
    $is_author_archive = true;
    $author_id = get_the_author_meta('ID');
    $author_name = get_the_author();
    $author_bio = get_the_author_meta('description');
    $author_image = get_avatar_url($author_id, ['size' => 200]);
    // Optional: Fetch custom role if exists, otherwise default
    $author_role = 'نویسنده'; 
    $archive_title = 'آرشیو نویسنده: ' . $author_name;
} elseif (is_day()) {
    $archive_title = 'آرشیو روز: ' . get_the_date('j F Y');
} elseif (is_month()) {
    $archive_title = 'آرشیو ماه: ' . get_the_date('F Y');
} elseif (is_year()) {
    $archive_title = 'آرشیو سال: ' . get_the_date('Y');
} else {
    $archive_title = get_the_archive_title();
}

?>

<?php core_start_section('content'); ?>
    
    <div class="container mx-auto px-4 mt-8 lg:mt-12">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">

            <!-- Main Content (Columns 1-9) -->
            <div class="lg:col-span-9">
                
                <!-- Archive Header Component -->
                <?php 
                core_view('partials/archive-header', [
                    'is_author_archive' => $is_author_archive,
                    'archive_title' => $archive_title,
                    'archive_description' => $archive_description,
                    'author_name' => $author_name,
                    'author_role' => $author_role,
                    'author_bio' => $author_bio,
                    'author_image' => $author_image
                ]); 
                ?>

                <!-- News List -->
                <div class="flex flex-col space-y-6">
                    
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <?php 
                                $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'hasht-medium');
                                if (!$thumb_url) {
                                    $thumb_url = get_template_directory_uri() . '/assets/images/placeholder.jpg'; // Fallback
                                }
                                $categories = get_the_category();
                                $first_cat = !empty($categories) ? $categories[0] : null;
                                $time_diff = hasht_time_ago(get_the_ID());
                                $rotiter = get_post_meta(get_the_ID(), '_news_rotiter', true);
                            ?>
                            
                            <article class="news-card-archive bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 md:p-5 flex flex-col md:flex-row gap-6 shadow-sm hover:shadow-md hover:border-rose-200 dark:hover:border-rose-900/30">
                                <figure class="w-full md:w-64 aspect-[16/10] md:aspect-[4/3] rounded-xl overflow-hidden shrink-0 relative">
                                    <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                                        <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transition-transform duration-700 hover:scale-110">
                                    </a>
                                </figure>
                                <div class="flex-1 flex flex-col">
                                    <div class="flex items-center gap-2 mb-3">
                                        <?php if ($first_cat) : ?>
                                            <a href="<?php echo esc_url(get_category_link($first_cat->term_id)); ?>" class="text-[10px] font-bold text-rose-600 bg-rose-50 dark:bg-rose-900/20 px-2 py-0.5 rounded-md hover:bg-rose-100 dark:hover:bg-rose-900/40 transition-colors">
                                                <?php echo esc_html($first_cat->name); ?>
                                            </a>
                                        <?php endif; ?>
                                        <span class="text-[10px] text-slate-400 flex items-center gap-1">
                                            <i data-lucide="clock" width="10"></i>
                                            <?php echo $time_diff; ?>
                                        </span>
                                    </div>
                                    <?php if (!empty($rotiter)) : ?>
                                        <span class="text-[11px] font-light text-secondary block mb-2"><?php echo esc_html($rotiter); ?></span>
                                    <?php endif; ?>
                                    <h2 class="news-title text-lg md:text-xl font-medium text-slate-800 dark:text-slate-100 leading-snug mb-3 transition-colors">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed text-justify mb-4 line-clamp-2 md:line-clamp-3">
                                        <?php echo get_the_excerpt(); ?>
                                    </p>
                                    <div class="mt-auto flex items-center justify-between border-t border-slate-100 dark:border-slate-800 pt-4">
                                        <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                                            <i data-lucide="user" width="14"></i>
                                            <span><?php the_author(); ?></span>
                                        </div>
                                        <a href="<?php the_permalink(); ?>" class="text-xs font-bold text-rose-600 flex items-center gap-1 hover:gap-2 transition-all">
                                            ادامه مطلب <i data-lucide="arrow-left" width="14"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>

                        <?php endwhile; ?>
                    <?php else : ?>
                        <div class="p-8 text-center text-slate-500 dark:text-slate-400 bg-slate-50 dark:bg-slate-800/50 rounded-2xl">
                            مطلبی یافت نشد.
                        </div>
                    <?php endif; ?>

                </div>

                <!-- Pagination -->
                <?php core_view('partials/pagination'); ?>

            </div>

            <!-- Sidebar Area (Columns 10-12) -->
            <aside class="lg:col-span-3">
                <div class="space-y-8">
                    <?php core_view('partials/sidebar'); ?>
                </div>
            </aside>

        </div>
    </div>

<?php core_end_section(); ?>

<?php core_view('layout/base'); ?>
