<?php
/**
 * single.php view
 */
?>

<?php core_start_section('content'); ?>
<?php
$post_id = get_the_ID();

// 1. Fetch Metadata
$content_type = get_post_meta($post_id, '_news_content_type', true);
if (empty($content_type)) $content_type = 'standard';

// Author / Interviewee
$custom_author_name = get_post_meta($post_id, '_news_author_name', true);
$custom_author_role = get_post_meta($post_id, '_news_author_position', true);

$interviewee_name = get_post_meta($post_id, '_news_interviewee_name', true);
$interviewee_role = get_post_meta($post_id, '_news_interviewee_position', true);

// Source
$source_name = get_post_meta($post_id, '_news_source_name', true);
$source_link = get_post_meta($post_id, '_news_source_link', true);

// Video Fields
$video_duration = get_post_meta($post_id, '_news_video_duration', true);
$video_source_type = get_post_meta($post_id, '_news_video_source_type', true);
$video_hq = get_post_meta($post_id, '_news_video_hq_link', true);
$video_lq = get_post_meta($post_id, '_news_video_lq_link', true);
$video_embed = get_post_meta($post_id, '_news_video_embed_code', true);

// Photo Report Fields
$photographer_name = get_post_meta($post_id, '_news_photographer_name', true);
$gallery_images = get_post_meta($post_id, '_news_gallery_images', true);

// Publication Fields
$pub_type = get_post_meta($post_id, '_news_publication_type', true);
$pub_file_id = get_post_meta($post_id, '_news_publication_file_id', true);
$pub_file_url = '';
if ($pub_file_id) {
    $pub_file_url = wp_get_attachment_url($pub_file_id);
}

// Author Box Logic (Always WP Author)
$author_id = get_post_field('post_author', $post_id);
$box_display_name = get_the_author_meta('display_name', $author_id);
if (empty($box_display_name)) {
    $box_display_name = get_the_author_meta('user_login', $author_id);
}
$box_avatar = get_avatar($author_id, 64, '', 'Author', ['class' => 'w-full h-full object-cover']);
$box_link = get_author_posts_url($author_id);
$box_description = get_the_author_meta('description', $author_id);

// Header Logic: Note > Interview > Standard
if ($content_type === 'note' && !empty($custom_author_name)) {
    $display_name = $custom_author_name;
    $display_role = $custom_author_role;
} elseif ($content_type === 'interview' && !empty($interviewee_name)) {
    $display_name = $interviewee_name;
    $display_role = $interviewee_role;
} elseif ($content_type === 'photo_report' && !empty($photographer_name)) {
    $display_name = $photographer_name;
    $display_role = 'عکاس';
} else {
    // For Standard/Video/Photo/Publication: Show WP Author in Header too
    $display_name = $box_display_name;
    $display_role = ''; 
}

// Image
$thumb_url = get_the_post_thumbnail_url($post_id, 'full');
?>
<!-- Print Header (Visible only in print) -->
    <div class="hidden print:flex flex-col items-center mb-8 pt-8">
        <img src="logona (1) copy.webp" alt="نماد اقتصاد" class="h-20 w-auto object-contain mb-4 grayscale" />
        <div class="flex items-center justify-between w-full text-xs text-black font-bold mb-2">
            <span>تاریخ انتشار: <?php echo get_the_date('j F Y'); ?></span>
            <span><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></span>
        </div>
        <div class="w-full h-px bg-black mb-4"></div>
    </div>

    <!-- Header Container -->
    

    
        <div class="container mx-auto px-4 mt-6 lg:mt-10">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 print:block">

                <!-- Main Content (Columns 1-9) -->
                <article class="lg:col-span-9 print:w-full">

                    <!-- Breadcrumb (Moved inside Article) -->
                    <div class="flex items-center justify-between mb-6 print:hidden">
                        <!-- Breadcrumb Links -->
                        <nav class="flex items-center gap-2 text-sm text-slate-500 dark:text-text-light">
                            <a href="<?php echo home_url('/'); ?>" class="hover:text-primary transition-colors">خانه</a>
                            <i data-lucide="chevron-left" width="14"></i>
                            <?php 
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="hover:text-primary transition-colors">' . esc_html($categories[0]->name) . '</a>';
                                } else {
                                    echo '<a href="#" class="hover:text-primary transition-colors">اخبار</a>';
                                }
                            ?>
                        </nav>

                        <!-- Author & Date (Moved here) -->
                        <div class="flex items-center gap-6 text-xs text-text-light font-bold">
                            <!-- News ID (Moved here) -->
                            <div class="flex items-center gap-2">
                                <span class="">کد خبر:</span>
                                <span class=""><?php the_ID(); ?></span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <i data-lucide="calendar" width="14"></i>
                                <span><?php echo get_the_date('j F Y'); ?></span>
                            </div>
                            <?php if ($content_type === 'video' && !empty($video_duration)): ?>
                                <div class="flex items-center gap-1.5 text-rose-500">
                                    <i data-lucide="clock" width="14"></i>
                                    <span><?php echo esc_html($video_duration); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Article Header -->
                    <header class="mb-8">
                        <!-- Category Badge Removed -->

                        <h1 class="text-2xl md:text-3xl lg:text-4xl font-black text-slate-900 dark:text-white leading-tight mb-6">
                            <?php the_title(); ?>
                        </h1>

                        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 dark:border-slate-800 pb-6 mb-6 print:border-black">
                            <!-- Author Name (Replaced News ID) -->
                            <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-text-light print:text-black">
                                <?php if ($content_type === 'photo_report'): ?>
                                    <i data-lucide="camera" width="16" class="text-primary"></i>
                                <?php else: ?>
                                    <i data-lucide="user" width="16" class="text-primary"></i>
                                <?php endif; ?>

                                <?php if ($content_type === 'interview'): ?>
                                    <span class="text-xs text-slate-400">گفت‌وگو با:</span>
                                <?php elseif ($content_type === 'photo_report'): ?>
                                    <span class="text-xs text-slate-400">عکاس:</span>
                                <?php endif; ?>
                                <span class="font-bold text-text-main dark:text-slate-200"><?php echo esc_html($display_name); ?></span>
                            </div>

                            <!-- Tools (Print, Share) - Hidden in Print -->
                            <div class="flex items-center gap-3 print:hidden">
                                <button id="scroll-to-comments" class="share-btn" title="دیدگاه‌ها">
                                    <i data-lucide="message-square" width="18"></i>
                                </button>
                                <button id="scroll-to-shortlink" class="share-btn" title="لینک کوتاه">
                                    <i data-lucide="link" width="18"></i>
                                </button>
                                <button onclick="window.print()" class="share-btn" title="پرینت">
                                    <i data-lucide="printer" width="18"></i>
                                </button>
                                <div class="h-6 w-px bg-slate-200 dark:bg-slate-700 mx-1"></div>
                                <a href="#" class="share-btn" title="تلگرام">
                                    <i data-lucide="send" width="18"></i>
                                </a>
                                <a href="#" class="share-btn" title="توییتر">
                                    <i data-lucide="twitter" width="18"></i>
                                </a>
                                <a href="#" class="share-btn" title="واتساپ">
                                    <i data-lucide="phone" width="18"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Lead (Border moved to right) -->
                        <p class="text-base md:text-lg font-medium text-slate-600 dark:text-slate-300 leading-relaxed text-justify border-r-4 border-primary pr-4 mb-8 print:text-black print:border-r-0 print:pr-0">
                            <?php echo get_the_excerpt(); ?>
                        </p>

                        <?php if ($content_type === 'video'): ?>
                            <!-- Video Player -->
                            <div class="mb-10">
                                <?php if (!empty($video_embed)): ?>
                                    <div class="relative w-full aspect-video rounded-2xl overflow-hidden shadow-lg bg-black">
                                        <?php echo $video_embed; ?>
                                    </div>
                                <?php elseif (!empty($video_hq) || !empty($video_lq)): ?>
                                    <video controls poster="<?php echo esc_url($thumb_url); ?>" class="w-full rounded-2xl shadow-lg bg-black aspect-video">
                                        <?php if (!empty($video_hq)): ?>
                                            <source src="<?php echo esc_url($video_hq); ?>" type="video/mp4">
                                        <?php endif; ?>
                                        <?php if (!empty($video_lq)): ?>
                                            <source src="<?php echo esc_url($video_lq); ?>" type="video/mp4">
                                        <?php endif; ?>
                                        مرورگر شما از پخش ویدئو پشتیبانی نمی‌کند.
                                    </video>
                                <?php endif; ?>

                                <!-- Download Buttons -->
                                <?php if (!empty($video_hq) || !empty($video_lq)): ?>
                                    <div class="flex items-center gap-4 mt-6 p-4 bg-slate-50 rounded-xl border border-slate-200">
                                        <span class="text-sm font-bold text-slate-700 flex items-center gap-2">
                                            <i data-lucide="download" width="16"></i>
                                            دانلود ویدئو:
                                        </span>
                                        <div class="flex gap-2">
                                            <?php if (!empty($video_hq)): ?>
                                                <a href="<?php echo esc_url($video_hq); ?>" download class="px-4 py-2 bg-primary text-white text-xs font-bold rounded-lg hover:bg-rose-700 transition-colors">
                                                    کیفیت بالا
                                                </a>
                                            <?php endif; ?>
                                            <?php if (!empty($video_lq)): ?>
                                                <a href="<?php echo esc_url($video_lq); ?>" download class="px-4 py-2 bg-slate-200 text-slate-700 text-xs font-bold rounded-lg hover:bg-slate-300 transition-colors">
                                                    کیفیت پایین
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php elseif ($content_type === 'photo_report' && !empty($gallery_images)): ?>
                            <!-- Photo Gallery -->
                            <div class="mb-10">
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4" id="gallery-grid">
                                    <?php 
                                    $gallery_ids = explode(',', $gallery_images);
                                    foreach ($gallery_ids as $index => $img_id):
                                        $img_full = wp_get_attachment_image_src($img_id, 'full');
                                        $img_thumb = wp_get_attachment_image_src($img_id, 'hasht-medium');
                                        if ($img_full):
                                    ?>
                                        <a href="<?php echo esc_url($img_full[0]); ?>" class="gallery-item block rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow relative group aspect-[4/3] bg-slate-100" data-index="<?php echo $index; ?>">
                                            <img src="<?php echo esc_url($img_thumb[0] ?? $img_full[0]); ?>" alt="Gallery Image" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                            <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                                <i data-lucide="zoom-in" class="text-white" width="24"></i>
                                            </div>
                                        </a>
                                    <?php 
                                        endif;
                                    endforeach; 
                                    ?>
                                </div>
                            </div>
                        <?php elseif ($content_type === 'publication' && !empty($pub_file_url)): ?>
                            <!-- Publication -->
                            <div class="mb-12 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 md:p-8 shadow-sm mt-8">
                                <div class="flex flex-col md:flex-row gap-8 lg:gap-12 items-center md:items-start">
                                    
                                    <!-- Cover Image -->
                                    <div class="w-48 md:w-56 lg:w-64 shrink-0 shadow-2xl rounded-lg overflow-hidden border border-slate-100 dark:border-slate-700 md:-mt-4 md:-ml-4 rotate-0 md:rotate-2 hover:rotate-0 transition-transform duration-500 bg-slate-200">
                                        <div class="aspect-[3/4] relative">
                                             <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover">
                                        </div>
                                    </div>

                                    <!-- Info & Actions -->
                                    <div class="flex-1 w-full text-center md:text-right pt-4">
                                        <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 mb-4">
                                            <span class="px-3 py-1 rounded-full bg-rose-50 dark:bg-rose-900/30 text-primary dark:text-rose-400 text-xs font-bold">
                                                <?php 
                                                    $pub_labels = [
                                                        'weekly' => 'هفته‌نامه',
                                                        'monthly' => 'ماهنامه',
                                                        'quarterly' => 'فصلنامه',
                                                        'yearbook' => 'سالنامه'
                                                    ];
                                                    echo $pub_labels[$pub_type] ?? 'نشریه';
                                                ?>
                                            </span>
                                            <span class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 text-xs font-bold">PDF</span>
                                        </div>

                                        <h2 class="text-xl md:text-2xl font-black text-slate-800 dark:text-slate-100 mb-4 leading-tight">
                                            دانلود نسخه دیجیتال <?php the_title(); ?>
                                        </h2>
                                        
                                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-7 mb-8 text-justify">
                                            برای مشاهده متن کامل این شماره، می‌توانید نسخه الکترونیکی (PDF) را دریافت کنید. این فایل شامل تمام صفحات، تصاویر و گزارش‌های اختصاصی می‌باشد.
                                        </p>

                                        <div class="flex flex-col sm:flex-row items-center gap-4">
                                            <a href="<?php echo esc_url($pub_file_url); ?>" target="_blank" class="w-full sm:w-auto px-8 py-3.5 bg-primary text-white text-sm font-bold rounded-xl hover:bg-rose-700 transition-all flex items-center justify-center gap-2 shadow-lg shadow-rose-200 dark:shadow-none hover:-translate-y-1">
                                                <i data-lucide="download" width="20"></i>
                                                دانلود فایل کامل
                                            </a>
                                            <div class="text-xs text-slate-400 font-medium flex items-center gap-1">
                                                <i data-lucide="file-check" width="14"></i>
                                                <span>نسخه نهایی و تایید شده</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php elseif (has_post_thumbnail()): ?>
                            <figure class="rounded-2xl overflow-hidden mb-10 print:shadow-none">
                                <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-auto object-cover">
                            </figure>
                        <?php endif; ?>
                    </header>

                    <!-- Article Body -->
                    <div class="single-content print:text-black">
                        <?php the_content(); ?>
                        
                        <?php if (!empty($source_name)): ?>
                            <div class="mt-8 pt-4 border-t border-slate-100 dark:border-slate-800 text-sm text-slate-500 dark:text-slate-400">
                                <strong>منبع:</strong> 
                                <?php if (!empty($source_link)): ?>
                                    <a href="<?php echo esc_url($source_link); ?>" target="_blank" rel="nofollow noopener" class="text-primary hover:underline">
                                        <?php echo esc_html($source_name); ?>
                                    </a>
                                <?php else: ?>
                                    <?php echo esc_html($source_name); ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Tags -->
                    <?php 
                        $tags = get_the_tags(); 
                        if ($tags): 
                    ?>
                    <div class="flex flex-wrap items-center gap-2 mt-10 pt-6 border-t border-slate-100 dark:border-slate-800 print:hidden">
                        <span class="text-sm font-bold text-slate-500 ml-2">برچسب‌ها:</span>
                        <?php foreach($tags as $tag): ?>
                            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800 rounded-lg text-xs text-slate-600 dark:text-slate-300 hover:bg-primary hover:text-white transition-colors">
                                <?php echo esc_html($tag->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Author & Short Link Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10 print:hidden">
                        <!-- Author Box -->
                        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 flex items-center gap-4 shadow-sm h-full">
                            <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-slate-100 dark:border-slate-700 shrink-0">
                                <?php echo $box_avatar; ?>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-base font-black text-slate-800 dark:text-slate-100 mb-1"><?php echo esc_html($box_display_name); ?></h4>
                                <?php if (!empty($box_description)): ?>
                                    <p class="text-xs text-slate-500 dark:text-text-light leading-relaxed mb-2 line-clamp-2">
                                        <?php echo esc_html($box_description); ?>
                                    </p>
                                <?php endif; ?>
                                <a href="<?php echo esc_url($box_link); ?>" class="text-primary text-xs font-bold hover:underline">مشاهده دیگر مطالب</a>
                            </div>
                        </div>

                        <!-- Short Link Box -->
                        <div class="bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-5 flex flex-col justify-center items-start gap-3 h-full">
                            <div class="flex items-center gap-2 text-slate-500 dark:text-text-light">
                                <i data-lucide="link" width="16"></i>
                                <span class="text-sm font-bold">لینک کوتاه مطلب:</span>
                            </div>
                            <div class="flex items-center gap-2 w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-3 py-2">
                                <span id="short-link-text" class="text-xs font-mono text-slate-600 dark:text-slate-300 dir-ltr select-all truncate"><?php echo wp_get_shortlink(); ?></span>
                                <button id="copy-link-btn" class="text-text-light hover:text-primary transition-colors shrink-0" title="کپی لینک">
                                    <i data-lucide="copy" width="16"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Toast Notification -->
                    <div id="toast-notification" class="fixed bottom-6 right-6 bg-slate-800 text-white px-4 py-3 rounded-lg shadow-xl transform translate-y-20 opacity-0 transition-all duration-300 z-50 flex items-center gap-2">
                        <i data-lucide="check-circle" class="text-green-400" width="20"></i>
                        <span class="text-sm font-medium">لینک با موفقیت کپی شد!</span>
                    </div>

                    <!-- Related News -->
                    <?php 
                    $show_related = get_theme_mod('hasht_single_related_enable', true);
                    if ($show_related):
                        $related_title = get_theme_mod('hasht_single_related_title', 'اخبار مرتبط');
                        $related_count = get_theme_mod('hasht_single_related_count', 4);
                        $related_query_type = get_theme_mod('hasht_single_related_query', 'category');
                        $related_layout = get_theme_mod('hasht_single_related_layout', 'grid-2');

                        $args = [
                            'post_type' => 'post',
                            'posts_per_page' => $related_count,
                            'post_status' => 'publish',
                            'post__not_in' => [$post_id],
                            'ignore_sticky_posts' => 1,
                        ];

                        if ($related_query_type === 'category') {
                            $categories = get_the_category();
                            if ($categories) {
                                $cat_ids = array_column($categories, 'term_id');
                                $args['category__in'] = $cat_ids;
                            }
                        } elseif ($related_query_type === 'tag') {
                            $tags = get_the_tags();
                            if ($tags) {
                                $tag_ids = array_column($tags, 'term_id');
                                $args['tag__in'] = $tag_ids;
                            }
                        } elseif ($related_query_type === 'author') {
                            $args['author'] = get_the_author_meta('ID');
                        } elseif ($related_query_type === 'random') {
                            $args['orderby'] = 'rand';
                        }

                        $related_query = new WP_Query($args);

                        if ($related_query->have_posts()):
                            // Layout Classes
                            $grid_class = 'grid-cols-1 md:grid-cols-2';
                            if ($related_layout === 'grid-3') {
                                $grid_class = 'grid-cols-1 md:grid-cols-3';
                            } elseif ($related_layout === 'list') {
                                $grid_class = 'grid-cols-1';
                            }
                    ?>
                    <section class="mt-12 print:hidden">
                        <!-- Separator -->
                        <div class="w-full h-px bg-slate-200 dark:bg-slate-700 mb-12"></div>

                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-1.5 h-8 flex flex-col  rounded-full overflow-hidden shrink-0">
                                <div class="h-1/3 bg-slate-400"></div>
                                <div class="h-2/3 bg-primary"></div>
                            </div>
                            <h3 class="text-xl font-black text-slate-800 dark:text-white"><?php echo esc_html($related_title); ?></h3>
                        </div>
                        <div class="grid <?php echo esc_attr($grid_class); ?> gap-6">
                            <?php while ($related_query->have_posts()): $related_query->the_post(); ?>
                                <a href="<?php the_permalink(); ?>" class="group flex items-start gap-4 bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 hover:border-rose-200 dark:hover:border-rose-900/50 transition-all">
                                    <div class="w-24 h-24 rounded-lg overflow-hidden shrink-0">
                                        <?php if (has_post_thumbnail()): ?>
                                            <img src="<?php the_post_thumbnail_url('hasht-small-rect'); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        <?php else: ?>
                                            <div class="w-full h-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center">
                                                <i data-lucide="image" class="text-slate-400" width="24"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-sm font-bold text-slate-800 dark:text-slate-200 leading-relaxed group-hover:text-primary transition-colors mb-2 line-clamp-2">
                                            <?php the_title(); ?>
                                        </h4>
                                        <div class="flex items-center gap-2 text-xs text-text-light">
                                            <i data-lucide="clock" width="12"></i>
                                            <span><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' پیش'; ?></span>
                                        </div>
                                    </div>
                                </a>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                    </section>
                    <?php endif; endif; ?>

                    <!-- Comments Section -->
                    <?php 
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                    ?>

                </article>

                <!-- Sidebar Area (Columns 10-12) -->
                <aside class="lg:col-span-3 print:hidden sticky top-4 h-fit">
                    <?php core_view('partials/sidebar'); ?>
                </aside>

            </div>
        </div>
    

    <!-- Footer Container -->
    

    <!-- Scripts -->
<?php core_end_section(); ?>

<?php core_start_section('scripts'); ?>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js" defer></script>
<?php core_end_section(); ?>

<?php core_view('layout/base'); ?>
