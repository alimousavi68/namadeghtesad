<?php
/**
 * Template Name: Single Aggregated News
 * Post Type: aggregated_news
 */

core_start_section('content');
?>
<div class="bg-gray-50 text-gray-800 min-h-screen">
    <?php core_view('partials/mobile-menu'); ?>
    <?php core_view('partials/header'); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php
    $meta_source_name = trim((string) get_post_meta(get_the_ID(), 'i8_hrm_source_name', true));
    $source_name = $meta_source_name !== '' ? $meta_source_name : 'خبر';
    $sources = get_the_terms(get_the_ID(), 'news_source');
    $source_term = ($sources && !is_wp_error($sources)) ? $sources[0] : null;
    $source_term_link = $source_term ? get_term_link($source_term) : '';
    if (is_wp_error($source_term_link)) {
        $source_term_link = '';
    }
    $source_archive_url = '';
    if ($meta_source_name !== '') {
        $source_archive_url = add_query_arg(['source_name' => rawurlencode($meta_source_name)], get_post_type_archive_link('aggregated_news'));
    }
    $source_url = trim((string) get_post_meta(get_the_ID(), 'i8_hrm_source_link', true));
    $lead_text = has_excerpt()
        ? get_the_excerpt()
        : wp_trim_words(wp_strip_all_tags(get_the_content(null, false)), 90, '…');
    $lead_text = trim((string) $lead_text);
    if ($lead_text === '') {
        $lead_text = 'خلاصه‌ای برای این خبر ثبت نشده است.';
    }
    ?>
    <main class="max-w-[1300px] mx-auto px-4 sm:px-6 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <article id="post-<?php the_ID(); ?>" <?php post_class('lg:col-span-8 bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8'); ?>>
                <div class="flex flex-wrap items-center gap-x-2 gap-y-1 text-xs text-gray-500 mb-4">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-primary transition-colors">خانه</a>
                    <span>/</span>
                    <a href="<?php echo esc_url(get_post_type_archive_link('aggregated_news')); ?>" class="text-gray-500 hover:text-primary transition-colors">اخبار</a>
                    <span>/</span>
                    <?php if ($source_archive_url !== '') : ?>
                        <a href="<?php echo esc_url($source_archive_url); ?>" class="font-bold text-gray-800 hover:text-primary transition-colors"><?php echo esc_html($source_name); ?></a>
                    <?php elseif ($source_term_link !== '') : ?>
                        <a href="<?php echo esc_url($source_term_link); ?>" class="font-bold text-gray-800 hover:text-primary transition-colors"><?php echo esc_html($source_name); ?></a>
                    <?php else : ?>
                        <span class="font-bold text-gray-800"><?php echo esc_html($source_name); ?></span>
                    <?php endif; ?>
                </div>

                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 leading-tight"><?php the_title(); ?></h1>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start mb-2">
                    <div class="md:col-span-5">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="rounded-xl overflow-hidden shadow-sm border border-gray-100">
                                <?php echo hasht_get_thumbnail('large', ['class' => 'w-full h-56 md:h-64 object-cover']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="md:col-span-7">
                        <div class="text-base md:text-lg text-gray-700 leading-8">
                            <?php echo esc_html($lead_text); ?>
                        </div>
                    </div>
                </div>

                <?php $tags = get_the_tags(); ?>
                <?php if ($tags) : ?>
                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <div class="flex flex-wrap gap-2">
                            <?php foreach ($tags as $tag) : ?>
                                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="px-3 py-1 bg-gray-100 text-gray-600 text-xs rounded-md hover:bg-gray-200 transition-colors">
                                    # <?php echo esc_html($tag->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </article>

            <aside class="lg:col-span-4 space-y-6">
                <div class="lg:sticky top-8 space-y-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                        <div class="text-sm text-gray-600 leading-7">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-gray-500">منبع:</span>
                                <?php if ($source_archive_url !== '') : ?>
                                    <a class="font-bold text-gray-900 hover:text-primary transition-colors" href="<?php echo esc_url($source_archive_url); ?>"><?php echo esc_html($source_name); ?></a>
                                <?php elseif ($source_term_link !== '') : ?>
                                    <a class="font-bold text-gray-900 hover:text-primary transition-colors" href="<?php echo esc_url($source_term_link); ?>"><?php echo esc_html($source_name); ?></a>
                                <?php else : ?>
                                    <span class="font-bold text-gray-900"><?php echo esc_html($source_name); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="flex items-center justify-between mb-5">
                                <span class="text-gray-500">تاریخ:</span>
                                <span class="font-medium text-gray-700"><?php echo esc_html(get_the_date('Y/m/d H:i')); ?></span>
                            </div>

                            <?php if ($source_url !== '') : ?>
                                <a href="<?php echo esc_url($source_url); ?>" target="_blank" rel="noopener" class="w-full inline-flex items-center justify-center gap-2 bg-primary text-white px-5 py-3 rounded-lg font-bold text-sm shadow-sm hover:opacity-90 active:opacity-90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    <span>انتقال به متن خبر</span>
                                    <span class="inline-flex w-4 h-4 border-2 border-white/60 border-t-white rounded-full animate-spin" aria-hidden="true"></span>
                                </a>
                            <?php else : ?>
                                <div class="w-full text-center bg-gray-50 border border-gray-100 rounded-lg px-4 py-3 text-sm text-gray-500">
                                    لینک منبع ثبت نشده است.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                        <div class="w-full aspect-[4/3] bg-gray-50 rounded-lg border border-dashed border-gray-200 flex items-center justify-center text-sm text-gray-400">
                            تبلیغات
                        </div>
                    </div>
                </div>
            </aside>
        </div>

        <div class="mt-10 mb-12">
            <div class="flex items-center gap-2 mb-6 border-b border-gray-200 pb-3">
                <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                <h3 class="text-xl font-bold text-gray-900">سایر اخبار</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php
                $related_query = new WP_Query([
                    'post_type'           => ['post', 'aggregated_news'],
                    'posts_per_page'      => 8,
                    'post__not_in'        => [get_the_ID()],
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                ]);

                if ($related_query->have_posts()) :
                    while ($related_query->have_posts()) : $related_query->the_post();
                ?>
                        <a href="<?php the_permalink(); ?>" class="group flex flex-col h-full bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                            <div class="w-full aspect-video overflow-hidden bg-gray-100">
                                <?php echo hasht_get_thumbnail('medium', ['class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110']); ?>
                            </div>
                            <div class="p-4 flex flex-col flex-grow">
                                <h4 class="text-sm font-bold text-gray-800 leading-6 group-hover:text-primary transition-colors mb-2 line-clamp-3">
                                    <?php the_title(); ?>
                                </h4>
                                <div class="mt-auto pt-2 flex items-center justify-between text-[10px] text-gray-400">
                                    <span><?php echo esc_html(get_the_time('H:i')); ?></span>
                                    <?php
                                    $grid_source = 'اندیشه مدیا';
                                    if (get_post_type() === 'aggregated_news') {
                                        $meta_name = trim((string) get_post_meta(get_the_ID(), 'i8_hrm_source_name', true));
                                        if ($meta_name !== '') {
                                            $grid_source = $meta_name;
                                        } else {
                                            $g_terms = get_the_terms(get_the_ID(), 'news_source');
                                            if ($g_terms && !is_wp_error($g_terms)) {
                                                $grid_source = $g_terms[0]->name;
                                            }
                                        }
                                    }
                                    echo '<span class="text-primary">' . esc_html($grid_source) . '</span>';
                                    ?>
                                </div>
                            </div>
                        </a>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>

    </main>
    <?php endwhile; endif; ?>

    <?php core_view('partials/footer'); ?>
</div>

<?php core_end_section(); ?>
<?php core_view('layout/base'); ?>
