<?php
core_start_section('content');
?>
<div class="bg-gray-50 text-gray-800 min-h-screen">
    <?php core_view('partials/mobile-menu'); ?>
    <?php core_view('partials/header'); ?>

    <main class="max-w-[1300px] mx-auto px-4 sm:px-6 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8 bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center gap-2 text-xs text-gray-500 mb-4">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-blue-600">خانه</a>
                    <span>/</span>
                    <span class="font-bold text-gray-800"><?php echo esc_html(get_the_archive_title()); ?></span>
                </div>

                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 leading-tight">
                    <?php echo esc_html(get_the_archive_title()); ?>
                </h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="group flex flex-col h-full bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                            <div class="w-full aspect-video overflow-hidden bg-gray-100">
                                <?php echo hasht_get_thumbnail('medium', ['class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110']); ?>
                            </div>
                            <div class="p-4 flex flex-col flex-grow">
                                <h2 class="text-sm font-bold text-gray-800 leading-6 group-hover:text-blue-600 transition-colors mb-2 line-clamp-3">
                                    <?php the_title(); ?>
                                </h2>
                                <div class="mt-auto pt-2 flex items-center justify-between text-[10px] text-gray-400">
                                    <span><?php echo esc_html(get_the_time('H:i')); ?></span>
                                    <?php
                                    $cats = get_the_category();
                                    echo !empty($cats) ? '<span class="text-blue-600">' . esc_html($cats[0]->name) . '</span>' : '';
                                    ?>
                                </div>
                            </div>
                        </a>
                    <?php endwhile; else: ?>
                        <p class="text-gray-500 text-sm">محتوایی یافت نشد.</p>
                    <?php endif; ?>
                </div>

                <div class="mt-8">
                    <?php
                    $links = paginate_links([
                        'type'      => 'list',
                        'prev_text' => 'قبلی',
                        'next_text' => 'بعدی',
                    ]);
                    if ($links) {
                        echo str_replace('page-numbers', 'page-numbers inline-flex items-center justify-center min-w-[36px] h-9 px-3 rounded-md border border-gray-200 text-sm text-gray-600 hover:bg-gray-50', $links);
                    }
                    ?>
                </div>
            </div>

            <?php core_view('partials/sidebar'); ?>
        </div>
    </main>

    <?php core_view('partials/footer'); ?>
</div>
<?php core_end_section(); ?>
<?php core_view('layout/base'); ?>
