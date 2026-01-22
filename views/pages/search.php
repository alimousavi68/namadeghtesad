<?php
/**
 * search.php view
 */
core_start_section('title'); ?>جستجو - نماد اقتصاد<?php core_end_section(); ?>

<?php core_start_section('content'); ?>
<!-- Header Container -->
    

    
        <div class="container mx-auto px-4 mt-8 lg:mt-12">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">

                <!-- Main Content (Columns 1-9) -->
                <div class="lg:col-span-9">
                    
                    <!-- Breadcrumb -->
                    <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6">
                        <a href="<?php echo home_url('/'); ?>" class="hover:text-rose-600 transition-colors">خانه</a>
                        <i data-lucide="chevron-left" width="14"></i>
                        <span class="font-bold text-slate-800 dark:text-slate-200">جستجو</span>
                    </nav>

                    <!-- Search Box Area -->
                    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-8 shadow-sm mb-8">
                        <h1 class="text-xl font-black text-slate-900 dark:text-white mb-6">جستجو در اخبار</h1>
                        <form action="search.php" method="GET" class="relative">
                            <input type="text" name="q" placeholder="عبارت مورد نظر را جستجو کنید..." 
                                class="w-full h-14 pr-12 pl-4 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl focus:outline-none focus:border-rose-500 dark:focus:border-rose-500 focus:ring-1 focus:ring-rose-500 transition-all text-slate-800 dark:text-slate-200 placeholder:text-slate-400">
                            <button type="submit" class="absolute top-1/2 -translate-y-1/2 right-4 text-slate-400 hover:text-rose-600 transition-colors">
                                <i data-lucide="search" width="24"></i>
                            </button>
                        </form>
                        <div class="mt-4 flex flex-wrap items-center gap-2 text-sm text-slate-500">
                            <span>پیشنهادها:</span>
                            <a href="#" class="px-3 py-1 bg-gray-100 dark:bg-slate-800 rounded-lg hover:bg-rose-50 hover:text-rose-600 transition-colors">بورس</a>
                            <a href="#" class="px-3 py-1 bg-gray-100 dark:bg-slate-800 rounded-lg hover:bg-rose-50 hover:text-rose-600 transition-colors">قیمت دلار</a>
                            <a href="#" class="px-3 py-1 bg-gray-100 dark:bg-slate-800 rounded-lg hover:bg-rose-50 hover:text-rose-600 transition-colors">خودرو</a>
                        </div>
                    </div>

                    <!-- Search Results Title -->
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-bold text-slate-800 dark:text-slate-200">
                            نتایج جستجو برای: <span class="text-rose-600">"بورس"</span>
                        </h2>
                        <span class="text-sm text-slate-500">۱۲ نتیجه یافت شد</span>
                    </div>

                    <!-- News List -->
                    <div class="flex flex-col space-y-6">
                        
                        <!-- Result Item 1 -->
                        <article class="news-card-archive bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 md:p-5 flex flex-col md:flex-row gap-6 shadow-sm hover:shadow-md hover:border-rose-200 dark:hover:border-rose-900/30">
                            <figure class="w-full md:w-64 aspect-[16/10] md:aspect-[4/3] rounded-xl overflow-hidden shrink-0 relative">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bours-18.jpg" alt="News Image" class="w-full h-full object-cover transition-transform duration-700">
                            </figure>
                            <div class="flex-1 flex flex-col">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-[10px] font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded-md">بورس</span>
                                    <span class="text-[10px] text-slate-400 flex items-center gap-1">
                                        <i data-lucide="clock" width="10"></i>
                                        ۵ ساعت پیش
                                    </span>
                                </div>
                                <h2 class="news-title text-lg md:text-xl font-black text-slate-800 dark:text-slate-100 leading-snug mb-3 transition-colors">
                                    <a href="#">رشد ۵۰ هزار واحدی شاخص کل؛ ورود پول حقیقی به بازار سهام</a>
                                </h2>
                                <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed text-justify mb-4 line-clamp-2 md:line-clamp-3">
                                    بازار بورس تهران امروز شاهد یکی از بهترین روزهای خود در سال جاری بود. ورود نقدینگی جدید و گزارش‌های مثبت شرکت‌ها باعث سبزپوشی اکثر نمادهای شاخص‌ساز شد.
                                </p>
                                <div class="mt-auto flex items-center justify-between border-t border-slate-100 dark:border-slate-800 pt-4">
                                    <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                                        <i data-lucide="user" width="14"></i>
                                        <span>تحریریه نماد</span>
                                    </div>
                                    <a href="#" class="text-xs font-bold text-rose-600 flex items-center gap-1 hover:gap-2 transition-all">
                                        ادامه مطلب <i data-lucide="arrow-left" width="14"></i>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Result Item 2 -->
                        <article class="news-card-archive bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 md:p-5 flex flex-col md:flex-row gap-6 shadow-sm hover:shadow-md hover:border-rose-200 dark:hover:border-rose-900/30">
                            <figure class="w-full md:w-64 aspect-[16/10] md:aspect-[4/3] rounded-xl overflow-hidden shrink-0 relative">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bank-168.jpg" alt="News Image" class="w-full h-full object-cover transition-transform duration-700">
                            </figure>
                            <div class="flex-1 flex flex-col">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-[10px] font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded-md">بانک و بیمه</span>
                                    <span class="text-[10px] text-slate-400 flex items-center gap-1">
                                        <i data-lucide="clock" width="10"></i>
                                        ۲ روز پیش
                                    </span>
                                </div>
                                <h2 class="news-title text-lg md:text-xl font-black text-slate-800 dark:text-slate-100 leading-snug mb-3 transition-colors">
                                    <a href="#">تاثیر نوسانات ارزی بر شرکت‌های بورسی؛ گزارش ویژه</a>
                                </h2>
                                <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed text-justify mb-4 line-clamp-2 md:line-clamp-3">
                                    بررسی صورت‌های مالی شرکت‌های صادرات‌محور نشان می‌دهد که افزایش نرخ ارز می‌تواند سودآوری این شرکت‌ها را در نیمه دوم سال به طرز چشمگیری افزایش دهد.
                                </p>
                                <div class="mt-auto flex items-center justify-between border-t border-slate-100 dark:border-slate-800 pt-4">
                                    <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                                        <i data-lucide="user" width="14"></i>
                                        <span>دکتر افشار</span>
                                    </div>
                                    <a href="#" class="text-xs font-bold text-rose-600 flex items-center gap-1 hover:gap-2 transition-all">
                                        ادامه مطلب <i data-lucide="arrow-left" width="14"></i>
                                    </a>
                                </div>
                            </div>
                        </article>

                    </div>

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
