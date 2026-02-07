<?php
/**
 * archive.php view
 */

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
                                $time_diff = human_time_diff(get_the_time('U'), current_time('timestamp')) . ' پیش';
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
                                    <h2 class="news-title text-lg md:text-xl font-black text-slate-800 dark:text-slate-100 leading-snug mb-3 transition-colors">
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