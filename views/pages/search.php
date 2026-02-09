<?php
/**
 * search.php view
 */
?>

<?php core_start_section('content'); ?>
<!-- Header Container -->
    

    
        <div class="container mx-auto px-4 mt-8 lg:mt-12">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">

                <!-- Main Content (Columns 1-9) -->
                <div class="lg:col-span-9">
                    
                    <!-- Breadcrumb -->
                    <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6">
                        <a href="<?php echo home_url('/'); ?>" class="hover:text-primary transition-colors">خانه</a>
                        <i data-lucide="chevron-left" width="14"></i>
                        <span class="font-bold text-slate-800 dark:text-slate-200">جستجو</span>
                    </nav>

                    <!-- Search Box Area -->
                    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-8 shadow-sm mb-8">
                        <h1 class="text-xl font-medium text-slate-900 dark:text-white mb-6">جستجو در اخبار</h1>
                        <form action="<?php echo home_url('/'); ?>" method="GET" class="relative">
                            <input type="text" name="s" value="<?php echo get_search_query(); ?>" placeholder="عبارت مورد نظر را جستجو کنید..." 
                                class="w-full h-14 pr-12 pl-4 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl focus:outline-none focus:border-primary dark:focus:border-primary focus:ring-1 focus:ring-primary transition-all text-slate-800 dark:text-slate-200 placeholder:text-text-light">
                            <button type="submit" class="absolute top-1/2 -translate-y-1/2 right-4 text-text-light hover:text-primary transition-colors">
                                <i data-lucide="search" width="24"></i>
                            </button>
                        </form>
                        <div class="mt-4 flex flex-wrap items-center gap-2 text-sm text-slate-500">
                            <?php
                            $tags = get_tags(['orderby' => 'count', 'order' => 'DESC', 'number' => 5]);
                            if ($tags) {
                                echo '<span>پیشنهادها:</span>';
                                foreach ($tags as $tag) {
                                    echo '<a href="' . get_tag_link($tag->term_id) . '" class="px-3 py-1 bg-gray-100 dark:bg-slate-800 rounded-lg hover:bg-rose-50 hover:text-primary transition-colors">' . $tag->name . '</a>';
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Search Results Title -->
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-bold text-slate-800 dark:text-slate-200">
                            نتایج جستجو برای: <span class="text-primary">"<?php echo get_search_query(); ?>"</span>
                        </h2>
                        <span class="text-sm text-slate-500"><?php global $wp_query; echo $wp_query->found_posts; ?> نتیجه یافت شد</span>
                    </div>

                    <!-- News List -->
                    <?php if (have_posts()) : ?>
                        <div class="flex flex-col space-y-6">
                            <?php while (have_posts()) : the_post(); ?>
                                <article class="news-card-archive bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 md:p-5 flex flex-col md:flex-row gap-6 shadow-sm hover:shadow-md hover:border-rose-200 dark:hover:border-rose-900/30">
                                    <figure class="w-full md:w-64 aspect-[16/10] md:aspect-[4/3] rounded-xl overflow-hidden shrink-0 relative">
                                        <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <img src="<?php the_post_thumbnail_url('hasht-medium'); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transition-transform duration-700">
                                            <?php else: ?>
                                                <div class="w-full h-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center">
                                                    <i data-lucide="image" class="w-10 h-10 text-slate-400"></i>
                                                </div>
                                            <?php endif; ?>
                                        </a>
                                    </figure>
                                    <div class="flex-1 flex flex-col">
                                        <div class="flex items-center gap-2 mb-3">
                                            <?php
                                            $categories = get_the_category();
                                            if ( ! empty( $categories ) ) {
                                                echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" class="text-[10px] font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded-md">' . esc_html( $categories[0]->name ) . '</a>';
                                            }
                                            ?>
                                            <span class="text-[10px] text-text-light flex items-center gap-1">
                                                <i data-lucide="clock" width="10"></i>
                                                <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' پیش'; ?>
                                            </span>
                                        </div>
                                        <h2 class="news-title text-lg md:text-xl font-medium text-slate-800 dark:text-slate-100 leading-snug mb-3 transition-colors">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                                        <div class="text-sm text-slate-500 dark:text-text-light leading-relaxed text-justify mb-4 line-clamp-2 md:line-clamp-3">
                                            <?php the_excerpt(); ?>
                                        </div>
                                        <div class="mt-auto flex items-center justify-between border-t border-slate-100 dark:border-slate-800 pt-4">
                                            <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-text-light">
                                                <i data-lucide="user" width="14"></i>
                                                <span><?php the_author(); ?></span>
                                            </div>
                                            <a href="<?php the_permalink(); ?>" class="text-xs font-bold text-primary flex items-center gap-1 hover:gap-2 transition-all">
                                                ادامه مطلب <i data-lucide="arrow-left" width="14"></i>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>
                    <?php else : ?>
                        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-12 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 dark:bg-slate-800 mb-4">
                                <i data-lucide="search-x" class="w-8 h-8 text-slate-400"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200 mb-2">نتیجه‌ای یافت نشد</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400">متاسفانه برای عبارت جستجو شده موردی پیدا نشد. لطفاً با کلمات دیگری امتحان کنید.</p>
                        </div>
                    <?php endif; ?>

                    <!-- Pagination -->
                    <?php core_view('partials/pagination'); ?>

                </div>

                <!-- Sidebar Area (Columns 10-12) -->
                <aside class="lg:col-span-3 sticky top-4 h-fit">
                    <div class="space-y-8">
                        <?php core_view('partials/sidebar'); ?>
                    </div>
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
