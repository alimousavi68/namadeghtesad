<?php
/**
 * archive.php view
 */
?>

<?php core_start_section('content'); ?>
<!-- Header Container -->
    

    
        <div class="container mx-auto px-4 mt-8 lg:mt-12">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">

                <!-- Main Content (Columns 1-9) -->
                <div class="lg:col-span-9">
                    
                    <!-- Archive Header Component -->
                    <!-- 
                        Variables to set before including:
                        $is_author_archive (bool) - Set true for author profile
                        $archive_title (string)
                        $archive_description (string)
                        $author_name, $author_role, $author_bio, $author_image (for author mode)
                    -->
                    <?php 
                    //  Example Configuration (Uncomment to test Author Mode)
                     $is_author_archive = true;
                     $author_name = 'دکتر علیرضا افشار';
                    
                    // Default Category Mode
                    // $is_author_archive = false;
                    // $archive_title = 'اقتصاد کلان';
                    // $archive_description = 'تازه‌ترین اخبار، تحلیل‌ها و گزارش‌های مرتبط با شاخص‌های اقتصاد کلان، تورم، نقدینگی و سیاست‌های پولی';
                    
                    core_view('partials/archive-header'); 
                    ?>

                    <!-- News List -->
                    <div class="flex flex-col space-y-6">
                        
                        <!-- Archive Item 1 -->
                        <article class="news-card-archive bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 md:p-5 flex flex-col md:flex-row gap-6 shadow-sm hover:shadow-md hover:border-rose-200 dark:hover:border-rose-900/30">
                            <figure class="w-full md:w-64 aspect-[16/10] md:aspect-[4/3] rounded-xl overflow-hidden shrink-0 relative">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bank-168.jpg" alt="News Image" class="w-full h-full object-cover transition-transform duration-700">
                                <div class="absolute top-2 right-2 bg-primary text-white text-[10px] font-bold px-2 py-1 rounded-lg shadow-sm">
                                    اختصاصی
                                </div>
                            </figure>
                            <div class="flex-1 flex flex-col">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-[10px] font-bold text-primary bg-rose-50 dark:bg-rose-900/20 px-2 py-0.5 rounded-md">بانک و بیمه</span>
                                    <span class="text-[10px] text-text-light flex items-center gap-1">
                                        <i data-lucide="clock" width="10"></i>
                                        ۲ ساعت پیش
                                    </span>
                                </div>
                                <h2 class="news-title text-lg md:text-xl font-black text-slate-800 dark:text-slate-100 leading-snug mb-3 transition-colors">
                                    <a href="#">تحلیل جامع سیاست‌های جدید بانک مرکزی؛ آیا نرخ سود تغییر می‌کند؟</a>
                                </h2>
                                <p class="text-sm text-slate-500 dark:text-text-light leading-relaxed text-justify mb-4 line-clamp-2 md:line-clamp-3">
                                    رئیس کل بانک مرکزی در آخرین نشست خبری خود اشاراتی به تغییرات احتمالی در نرخ سود سپرده‌ها داشت. کارشناسان معتقدند این تصمیم می‌تواند تأثیر مستقیمی بر بازار سرمایه و تورم داشته باشد...
                                </p>
                                <div class="mt-auto flex items-center justify-between border-t border-slate-100 dark:border-slate-800 pt-4">
                                    <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-text-light">
                                        <i data-lucide="user" width="14"></i>
                                        <span>دکتر علیرضا افشار</span>
                                    </div>
                                    <a href="#" class="text-xs font-bold text-primary flex items-center gap-1 hover:gap-2 transition-all">
                                        ادامه مطلب <i data-lucide="arrow-left" width="14"></i>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Archive Item 2 -->
                        <article class="news-card-archive bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 md:p-5 flex flex-col md:flex-row gap-6 shadow-sm hover:shadow-md hover:border-rose-200 dark:hover:border-rose-900/30">
                            <figure class="w-full md:w-64 aspect-[16/10] md:aspect-[4/3] rounded-xl overflow-hidden shrink-0 relative">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bours-18.jpg" alt="News Image" class="w-full h-full object-cover transition-transform duration-700">
                            </figure>
                            <div class="flex-1 flex flex-col">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-[10px] font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded-md">بورس</span>
                                    <span class="text-[10px] text-text-light flex items-center gap-1">
                                        <i data-lucide="clock" width="10"></i>
                                        ۵ ساعت پیش
                                    </span>
                                </div>
                                <h2 class="news-title text-lg md:text-xl font-black text-slate-800 dark:text-slate-100 leading-snug mb-3 transition-colors">
                                    <a href="#">رشد ۵۰ هزار واحدی شاخص کل؛ ورود پول حقیقی به بازار سهام</a>
                                </h2>
                                <p class="text-sm text-slate-500 dark:text-text-light leading-relaxed text-justify mb-4 line-clamp-2 md:line-clamp-3">
                                    بازار بورس تهران امروز شاهد یکی از بهترین روزهای خود در سال جاری بود. ورود نقدینگی جدید و گزارش‌های مثبت شرکت‌ها باعث سبزپوشی اکثر نمادهای شاخص‌ساز شد.
                                </p>
                                <div class="mt-auto flex items-center justify-between border-t border-slate-100 dark:border-slate-800 pt-4">
                                    <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-text-light">
                                        <i data-lucide="user" width="14"></i>
                                        <span>تحریریه نماد</span>
                                    </div>
                                    <a href="#" class="text-xs font-bold text-primary flex items-center gap-1 hover:gap-2 transition-all">
                                        ادامه مطلب <i data-lucide="arrow-left" width="14"></i>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Archive Item 3 -->
                        <article class="news-card-archive bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 md:p-5 flex flex-col md:flex-row gap-6 shadow-sm hover:shadow-md hover:border-rose-200 dark:hover:border-rose-900/30">
                            <figure class="w-full md:w-64 aspect-[16/10] md:aspect-[4/3] rounded-xl overflow-hidden shrink-0 relative">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/saipa-5.jpg" alt="News Image" class="w-full h-full object-cover transition-transform duration-700">
                            </figure>
                            <div class="flex-1 flex flex-col">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-[10px] font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded-md">صنعت خودرو</span>
                                    <span class="text-[10px] text-text-light flex items-center gap-1">
                                        <i data-lucide="clock" width="10"></i>
                                        دیروز
                                    </span>
                                </div>
                                <h2 class="news-title text-lg md:text-xl font-black text-slate-800 dark:text-slate-100 leading-snug mb-3 transition-colors">
                                    <a href="#">جزئیات عرضه جدید خودرو در سامانه یکپارچه اعلام شد</a>
                                </h2>
                                <p class="text-sm text-slate-500 dark:text-text-light leading-relaxed text-justify mb-4 line-clamp-2 md:line-clamp-3">
                                    وزارت صمت در اطلاعیه‌ای شرایط جدید ثبت‌نام خودروهای داخلی و وارداتی را اعلام کرد. متقاضیان می‌توانند از هفته آینده نسبت به وکالتی کردن حساب‌های خود اقدام کنند.
                                </p>
                                <div class="mt-auto flex items-center justify-between border-t border-slate-100 dark:border-slate-800 pt-4">
                                    <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-text-light">
                                        <i data-lucide="user" width="14"></i>
                                        <span>مهدی حسینی</span>
                                    </div>
                                    <a href="#" class="text-xs font-bold text-primary flex items-center gap-1 hover:gap-2 transition-all">
                                        ادامه مطلب <i data-lucide="arrow-left" width="14"></i>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Archive Item 4 -->
                        <article class="news-card-archive bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 md:p-5 flex flex-col md:flex-row gap-6 shadow-sm hover:shadow-md hover:border-rose-200 dark:hover:border-rose-900/30">
                            <figure class="w-full md:w-64 aspect-[16/10] md:aspect-[4/3] rounded-xl overflow-hidden shrink-0 relative">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gold-05.jpg" alt="News Image" class="w-full h-full object-cover transition-transform duration-700">
                            </figure>
                            <div class="flex-1 flex flex-col">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-[10px] font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded-md">طلا و ارز</span>
                                    <span class="text-[10px] text-text-light flex items-center gap-1">
                                        <i data-lucide="clock" width="10"></i>
                                        ۲ روز پیش
                                    </span>
                                </div>
                                <h2 class="news-title text-lg md:text-xl font-black text-slate-800 dark:text-slate-100 leading-snug mb-3 transition-colors">
                                    <a href="#">پیش‌بینی قیمت طلا در هفته آینده؛ آیا روند نزولی ادامه دارد؟</a>
                                </h2>
                                <p class="text-sm text-slate-500 dark:text-text-light leading-relaxed text-justify mb-4 line-clamp-2 md:line-clamp-3">
                                    انس جهانی طلا با کاهش ۲۰ دلاری مواجه شد. در بازار داخلی نیز قیمت سکه امامی با افت ۵۰۰ هزار تومانی به کانال پایین‌تر سقوط کرد.
                                </p>
                                <div class="mt-auto flex items-center justify-between border-t border-slate-100 dark:border-slate-800 pt-4">
                                    <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-text-light">
                                        <i data-lucide="user" width="14"></i>
                                        <span>دکتر افشار</span>
                                    </div>
                                    <a href="#" class="text-xs font-bold text-primary flex items-center gap-1 hover:gap-2 transition-all">
                                        ادامه مطلب <i data-lucide="arrow-left" width="14"></i>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Archive Item 5 -->
                        <article class="news-card-archive bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 md:p-5 flex flex-col md:flex-row gap-6 shadow-sm hover:shadow-md hover:border-rose-200 dark:hover:border-rose-900/30">
                            <figure class="w-full md:w-64 aspect-[16/10] md:aspect-[4/3] rounded-xl overflow-hidden shrink-0 relative">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bank-168.jpg" alt="News Image" class="w-full h-full object-cover transition-transform duration-700">
                            </figure>
                            <div class="flex-1 flex flex-col">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-[10px] font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded-md">بانک و بیمه</span>
                                    <span class="text-[10px] text-text-light flex items-center gap-1">
                                        <i data-lucide="clock" width="10"></i>
                                        ۳ روز پیش
                                    </span>
                                </div>
                                <h2 class="news-title text-lg md:text-xl font-black text-slate-800 dark:text-slate-100 leading-snug mb-3 transition-colors">
                                    <a href="#">افزایش نرخ سود سپرده‌های بانکی؛ موافقان و مخالفان چه می‌گویند؟</a>
                                </h2>
                                <p class="text-sm text-slate-500 dark:text-text-light leading-relaxed text-justify mb-4 line-clamp-2 md:line-clamp-3">
                                    شورای پول و اعتبار در جلسه اخیر خود با افزایش نرخ سود سپرده‌ها موافقت کرد. این تصمیم با هدف کنترل نقدینگی و کاهش تورم اتخاذ شده است.
                                </p>
                                <div class="mt-auto flex items-center justify-between border-t border-slate-100 dark:border-slate-800 pt-4">
                                    <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-text-light">
                                        <i data-lucide="user" width="14"></i>
                                        <span>گروه اقتصادی</span>
                                    </div>
                                    <a href="#" class="text-xs font-bold text-primary flex items-center gap-1 hover:gap-2 transition-all">
                                        ادامه مطلب <i data-lucide="arrow-left" width="14"></i>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Archive Item 6 -->
                        <article class="news-card-archive bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 md:p-5 flex flex-col md:flex-row gap-6 shadow-sm hover:shadow-md hover:border-rose-200 dark:hover:border-rose-900/30">
                            <figure class="w-full md:w-64 aspect-[16/10] md:aspect-[4/3] rounded-xl overflow-hidden shrink-0 relative">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bours-18.jpg" alt="News Image" class="w-full h-full object-cover transition-transform duration-700">
                            </figure>
                            <div class="flex-1 flex flex-col">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-[10px] font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded-md">بورس</span>
                                    <span class="text-[10px] text-text-light flex items-center gap-1">
                                        <i data-lucide="clock" width="10"></i>
                                        ۳ روز پیش
                                    </span>
                                </div>
                                <h2 class="news-title text-lg md:text-xl font-black text-slate-800 dark:text-slate-100 leading-snug mb-3 transition-colors">
                                    <a href="#">عرضه اولیه جدید در راه است؛ سهامداران آماده باشند</a>
                                </h2>
                                <p class="text-sm text-slate-500 dark:text-text-light leading-relaxed text-justify mb-4 line-clamp-2 md:line-clamp-3">
                                    شرکت سرمایه‌گذاری تامین اجتماعی از عرضه اولیه زیرمجموعه‌های خود خبر داد. این عرضه می‌تواند نقدینگی جدیدی را به بازار جذب کند.
                                </p>
                                <div class="mt-auto flex items-center justify-between border-t border-slate-100 dark:border-slate-800 pt-4">
                                    <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-text-light">
                                        <i data-lucide="user" width="14"></i>
                                        <span>رضا علوی</span>
                                    </div>
                                    <a href="#" class="text-xs font-bold text-primary flex items-center gap-1 hover:gap-2 transition-all">
                                        ادامه مطلب <i data-lucide="arrow-left" width="14"></i>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Archive Item 7 -->
                        <article class="news-card-archive bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 md:p-5 flex flex-col md:flex-row gap-6 shadow-sm hover:shadow-md hover:border-rose-200 dark:hover:border-rose-900/30">
                            <figure class="w-full md:w-64 aspect-[16/10] md:aspect-[4/3] rounded-xl overflow-hidden shrink-0 relative">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/saipa-5.jpg" alt="News Image" class="w-full h-full object-cover transition-transform duration-700">
                            </figure>
                            <div class="flex-1 flex flex-col">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-[10px] font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded-md">صنعت خودرو</span>
                                    <span class="text-[10px] text-text-light flex items-center gap-1">
                                        <i data-lucide="clock" width="10"></i>
                                        ۴ روز پیش
                                    </span>
                                </div>
                                <h2 class="news-title text-lg md:text-xl font-black text-slate-800 dark:text-slate-100 leading-snug mb-3 transition-colors">
                                    <a href="#">واردات خودروهای کارکرده؛ چالش‌ها و فرصت‌ها</a>
                                </h2>
                                <p class="text-sm text-slate-500 dark:text-text-light leading-relaxed text-justify mb-4 line-clamp-2 md:line-clamp-3">
                                    مجلس شورای اسلامی لایحه واردات خودروهای کارکرده را تصویب کرد. این قانون می‌تواند قیمت خودروهای داخلی را به شدت کاهش دهد.
                                </p>
                                <div class="mt-auto flex items-center justify-between border-t border-slate-100 dark:border-slate-800 pt-4">
                                    <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-text-light">
                                        <i data-lucide="user" width="14"></i>
                                        <span>تحریریه نماد</span>
                                    </div>
                                    <a href="#" class="text-xs font-bold text-primary flex items-center gap-1 hover:gap-2 transition-all">
                                        ادامه مطلب <i data-lucide="arrow-left" width="14"></i>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Archive Item 8 -->
                        <article class="news-card-archive bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 md:p-5 flex flex-col md:flex-row gap-6 shadow-sm hover:shadow-md hover:border-rose-200 dark:hover:border-rose-900/30">
                            <figure class="w-full md:w-64 aspect-[16/10] md:aspect-[4/3] rounded-xl overflow-hidden shrink-0 relative">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gold-05.jpg" alt="News Image" class="w-full h-full object-cover transition-transform duration-700">
                            </figure>
                            <div class="flex-1 flex flex-col">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-[10px] font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded-md">طلا و ارز</span>
                                    <span class="text-[10px] text-text-light flex items-center gap-1">
                                        <i data-lucide="clock" width="10"></i>
                                        ۴ روز پیش
                                    </span>
                                </div>
                                <h2 class="news-title text-lg md:text-xl font-black text-slate-800 dark:text-slate-100 leading-snug mb-3 transition-colors">
                                    <a href="#">تحلیل تکنیکال دلار؛ مقاومت ۵۰ هزار تومانی شکسته می‌شود؟</a>
                                </h2>
                                <p class="text-sm text-slate-500 dark:text-text-light leading-relaxed text-justify mb-4 line-clamp-2 md:line-clamp-3">
                                    بازار ارز در هفته گذشته نوسانات زیادی را تجربه کرد. تحلیلگران معتقدند نرخ ارز در روزهای آینده به ثبات نسبی خواهد رسید.
                                </p>
                                <div class="mt-auto flex items-center justify-between border-t border-slate-100 dark:border-slate-800 pt-4">
                                    <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-text-light">
                                        <i data-lucide="user" width="14"></i>
                                        <span>دکتر محمدی</span>
                                    </div>
                                    <a href="#" class="text-xs font-bold text-primary flex items-center gap-1 hover:gap-2 transition-all">
                                        ادامه مطلب <i data-lucide="arrow-left" width="14"></i>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Archive Item 9 -->
                        <article class="news-card-archive bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 md:p-5 flex flex-col md:flex-row gap-6 shadow-sm hover:shadow-md hover:border-rose-200 dark:hover:border-rose-900/30">
                            <figure class="w-full md:w-64 aspect-[16/10] md:aspect-[4/3] rounded-xl overflow-hidden shrink-0 relative">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bank-168.jpg" alt="News Image" class="w-full h-full object-cover transition-transform duration-700">
                            </figure>
                            <div class="flex-1 flex flex-col">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-[10px] font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded-md">اقتصاد کلان</span>
                                    <span class="text-[10px] text-text-light flex items-center gap-1">
                                        <i data-lucide="clock" width="10"></i>
                                        ۵ روز پیش
                                    </span>
                                </div>
                                <h2 class="news-title text-lg md:text-xl font-black text-slate-800 dark:text-slate-100 leading-snug mb-3 transition-colors">
                                    <a href="#">رشد اقتصادی ۸ درصدی در برنامه هفتم توسعه؛ رویا یا واقعیت؟</a>
                                </h2>
                                <p class="text-sm text-slate-500 dark:text-text-light leading-relaxed text-justify mb-4 line-clamp-2 md:line-clamp-3">
                                    برنامه هفتم توسعه با هدف دستیابی به رشد اقتصادی ۸ درصدی تدوین شده است. اما کارشناسان نسبت به تحقق این هدف ابراز تردید می‌کنند.
                                </p>
                                <div class="mt-auto flex items-center justify-between border-t border-slate-100 dark:border-slate-800 pt-4">
                                    <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-text-light">
                                        <i data-lucide="user" width="14"></i>
                                        <span>دکتر افشار</span>
                                    </div>
                                    <a href="#" class="text-xs font-bold text-primary flex items-center gap-1 hover:gap-2 transition-all">
                                        ادامه مطلب <i data-lucide="arrow-left" width="14"></i>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Archive Item 10 -->
                        <article class="news-card-archive bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 md:p-5 flex flex-col md:flex-row gap-6 shadow-sm hover:shadow-md hover:border-rose-200 dark:hover:border-rose-900/30">
                            <figure class="w-full md:w-64 aspect-[16/10] md:aspect-[4/3] rounded-xl overflow-hidden shrink-0 relative">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bours-18.jpg" alt="News Image" class="w-full h-full object-cover transition-transform duration-700">
                            </figure>
                            <div class="flex-1 flex flex-col">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-[10px] font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded-md">انرژی</span>
                                    <span class="text-[10px] text-text-light flex items-center gap-1">
                                        <i data-lucide="clock" width="10"></i>
                                        ۵ روز پیش
                                    </span>
                                </div>
                                <h2 class="news-title text-lg md:text-xl font-black text-slate-800 dark:text-slate-100 leading-snug mb-3 transition-colors">
                                    <a href="#">سرمایه‌گذاری خارجی در صنعت نفت و گاز افزایش یافت</a>
                                </h2>
                                <p class="text-sm text-slate-500 dark:text-text-light leading-relaxed text-justify mb-4 line-clamp-2 md:line-clamp-3">
                                    وزیر نفت از امضای قراردادهای جدید با شرکت‌های خارجی خبر داد. این سرمایه‌گذاری‌ها می‌تواند ظرفیت تولید نفت ایران را افزایش دهد.
                                </p>
                                <div class="mt-auto flex items-center justify-between border-t border-slate-100 dark:border-slate-800 pt-4">
                                    <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-text-light">
                                        <i data-lucide="user" width="14"></i>
                                        <span>تحریریه نماد</span>
                                    </div>
                                    <a href="#" class="text-xs font-bold text-primary flex items-center gap-1 hover:gap-2 transition-all">
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
