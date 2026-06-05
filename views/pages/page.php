<?php
/**
 * page.php view
 */
?>

<?php core_start_section('content'); ?>
<!-- Header Container -->
    

    
        <div class="container mx-auto px-4 mt-8 lg:mt-12">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">

                <!-- Main Content (Columns 1-9) -->
                <div class="lg:col-span-9">
                    
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <!-- Breadcrumb -->
                    <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6">
                        <a href="<?php echo home_url('/'); ?>" class="hover:text-primary transition-colors">خانه</a>
                        <i data-lucide="chevron-left" width="14"></i>
                        <span class="font-bold text-slate-800 dark:text-slate-200"><?php the_title(); ?></span>
                    </nav>

                    <!-- Page Content -->
                    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-8 shadow-sm">
                        <h1 class="text-2xl md:text-3xl font-medium text-slate-900 dark:text-white mb-6 leading-tight">
                            <?php the_title(); ?>
                        </h1>
                        
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="mb-8 rounded-xl overflow-hidden">
                                <?php the_post_thumbnail('full', ['class' => 'w-full h-auto object-cover']); ?>
                            </div>
                        <?php endif; ?>

                        <div class="prose dark:prose-invert max-w-none prose-img:rounded-xl prose-a:text-primary hover:prose-a:text-primary">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <?php endwhile; endif; ?>

                </div>

                <!-- Sticky Sidebar (Columns 10-12) -->
                <aside class="lg:col-span-3 sticky top-4 h-fit space-y-8">
                    <?php core_view('partials/sidebar'); ?>
                </aside>

            </div>
        </div>
<?php core_end_section(); ?>

<?php core_start_section('scripts'); ?>

<?php core_end_section(); ?>

<?php core_view('layout/base'); ?>
