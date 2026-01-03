<?php
/**
 * Template Name: Standard Post
 * Post Type: post
 * 
 * Two-column layout with sidebar and full content.
 */

core_start_section('content');
?>
<div class="bg-gray-50 text-gray-800 min-h-screen">

    <?php core_view('partials/mobile-menu'); ?>
    <?php core_view('partials/header'); ?>

    <main class="max-w-[1300px] mx-auto px-4 sm:px-6 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- Right Column: Main Content (8 cols) -->
            <div class="lg:col-span-8 bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8">

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <!-- Breadcrumb -->
                    <div class="flex items-center gap-2 text-xs text-gray-500 mb-4">
                        <a href="<?php echo home_url(); ?>" class="hover:text-blue-600">خانه</a>
                        <span>/</span>
                        <?php
                        $categories = get_the_category();
                        if (!empty($categories)) {
                            echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="hover:text-blue-600">' . esc_html($categories[0]->name) . '</a>';
                        }
                        ?>
                    </div>

                    <!-- Title -->
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 leading-tight">
                        <?php the_title(); ?>
                    </h1>

                    <!-- Date & Meta -->
                    <div class="flex items-center gap-4 text-xs text-gray-400 mb-6 border-b border-gray-100 pb-4">
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <time datetime="<?php echo get_the_date('c'); ?>">
                                <?php echo get_the_date('d F Y - H:i'); ?>
                            </time>
                        </div>
                    </div>

                    <!-- Intro: Featured Image & Lead -->
                    <div class="mb-8">
                        <?php if (has_post_thumbnail()) : ?>
                            <figure class="w-full mb-6">
                                <?php echo hasht_get_thumbnail('large', ['class' => 'w-full h-64 md:h-80 object-cover rounded-lg']); ?>
                            </figure>
                        <?php endif; ?>

                        <?php if (has_excerpt()) : ?>
                            <div class="text-lg font-medium text-gray-700 leading-8 mb-6 border-r-4 border-blue-500 pr-4 bg-gray-50 py-3 rounded-r-sm">
                                <?php the_excerpt(); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Main Content -->
                    <div class="prose prose-lg max-w-none prose-headings:font-bold prose-headings:text-gray-900 prose-p:text-gray-800 prose-p:leading-8 prose-img:rounded-lg prose-a:text-blue-600">
                        <?php the_content(); ?>
                    </div>

                    <!-- Footer: Tags & Share -->
                    <div class="mt-10 pt-6 border-t border-gray-100">
                        
                        

                        <!-- Tags -->
                        <?php
                        $tags = get_the_tags();
                        if ($tags) : ?>
                            <div class="flex flex-wrap gap-2 mb-6">
                                <?php foreach ($tags as $tag) : ?>
                                    <a href="<?php echo get_tag_link($tag->term_id); ?>" class="px-3 py-1 bg-gray-100 text-gray-600 text-xs rounded-md hover:bg-gray-200 transition-colors">
                                        # <?php echo $tag->name; ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Share Buttons -->
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-bold text-gray-700">اشتراک‌گذاری:</span>
                            <div class="flex gap-2">
                                <a href="https://t.me/share/url?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank" class="w-8 h-8 flex items-center justify-center bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-colors" title="تلگرام">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>" target="_blank" class="w-8 h-8 flex items-center justify-center bg-sky-500 text-white rounded-full hover:bg-sky-600 transition-colors" title="توئیتر">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path></svg>
                                </a>
                                <a href="https://wa.me/?text=<?php the_permalink(); ?>" target="_blank" class="w-8 h-8 flex items-center justify-center bg-green-500 text-white rounded-full hover:bg-green-600 transition-colors" title="واتس‌اپ">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21l1.65-3.8a9 9 0 113.4 2.9L3 21"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>

                </article>

                <!-- Related News -->
                <div class="mt-12">
                    <div class="flex items-center gap-2 mb-6 border-b border-gray-100 pb-3">
                        <span class="w-1 h-6 bg-blue-600 rounded-full"></span>
                        <h3 class="text-xl font-bold text-gray-900">اخبار مرتبط</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php
                        $related_query = new WP_Query([
                            'category__in' => wp_get_post_categories(get_the_ID()),
                            'post__not_in' => [get_the_ID()],
                            'posts_per_page' => 4,
                            'ignore_sticky_posts' => 1
                        ]);
                        if ($related_query->have_posts()) :
                            while ($related_query->have_posts()) : $related_query->the_post();
                        ?>
                            <a href="<?php the_permalink(); ?>" class="flex gap-4 group">
                                <div class="w-24 h-24 flex-shrink-0 rounded-lg overflow-hidden">
                                    <?php echo hasht_get_thumbnail('thumbnail', ['class' => 'w-full h-full object-cover transition-transform duration-300 group-hover:scale-110']); ?>
                                </div>
                                <div class="flex flex-col justify-between py-1">
                                    <h4 class="text-sm font-bold text-gray-800 group-hover:text-blue-600 transition-colors line-clamp-3 leading-6"><?php the_title(); ?></h4>
                                    <span class="text-xs text-gray-400"><?php echo get_the_date(); ?></span>
                                </div>
                            </a>
                        <?php 
                            endwhile; 
                            wp_reset_postdata();
                        else:
                            echo '<p class="text-gray-500 text-sm col-span-2">خبری یافت نشد.</p>';
                        endif;
                        ?>
                    </div>
                </div>

            </div>

            <?php core_view('partials/sidebar'); ?>

        </div>
    </main>

    <?php core_view('partials/footer'); ?>
</div>
<?php core_end_section(); ?>
<?php core_view('layout/base'); ?>
