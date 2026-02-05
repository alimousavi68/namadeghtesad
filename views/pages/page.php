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
                    
                    <!-- Breadcrumb -->
                    <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6">
                        <a href="<?php echo home_url('/'); ?>" class="hover:text-primary transition-colors">خانه</a>
                        <i data-lucide="chevron-left" width="14"></i>
                        <span class="font-bold text-slate-800 dark:text-slate-200">عنوان صفحه</span>
                    </nav>

                    <!-- Page Content -->
                    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-8 shadow-sm">
                        <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white mb-6 leading-tight">
                            عنوان صفحه نمونه
                        </h1>
                        
                        <div class="prose dark:prose-invert max-w-none prose-img:rounded-xl prose-a:text-primary hover:prose-a:text-primary">
                            <p class="leading-relaxed text-justify mb-4">
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                            </p>
                            <h2 class="text-xl font-bold mt-8 mb-4">زیر تیتر نمونه</h2>
                            <p class="leading-relaxed text-justify mb-4">
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                            </p>
                            <ul class="list-disc list-inside space-y-2 mb-6 marker:text-primary">
                                <li>مورد لیست نمونه اول</li>
                                <li>مورد لیست نمونه دوم با توضیحات بیشتر</li>
                                <li>مورد لیست نمونه سوم</li>
                            </ul>
                            <p class="leading-relaxed text-justify">
                                در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                            </p>
                        </div>
                    </div>

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
