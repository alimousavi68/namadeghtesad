<?php
/**
 * single.php view
 */
core_start_section('title'); ?>تحلیل جامع بودجه ۱۴۰۴: سناریوهای تورمی و رشد اقتصادی - نماد اقتصاد<?php core_end_section(); ?>

<?php core_start_section('content'); ?>
<!-- Print Header (Visible only in print) -->
    <div class="hidden print:flex flex-col items-center mb-8 pt-8">
        <img src="logona (1) copy.webp" alt="نماد اقتصاد" class="h-20 w-auto object-contain mb-4 grayscale" />
        <div class="flex items-center justify-between w-full text-xs text-black font-bold mb-2">
            <span>تاریخ انتشار: ۱۴ بهمن ۱۴۰۳</span>
            <span>نماد اقتصاد - رسانه تخصصی اقتصاد ایران</span>
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
                        <nav class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                            <a href="<?php echo home_url('/'); ?>" class="hover:text-rose-600 transition-colors">خانه</a>
                            <i data-lucide="chevron-left" width="14"></i>
                            <a href="#" class="hover:text-rose-600 transition-colors">اقتصاد کلان</a>
                        </nav>

                        <!-- Author & Date (Moved here) -->
                        <div class="flex items-center gap-6 text-xs text-slate-400 font-bold">
                            <!-- News ID (Moved here) -->
                            <div class="flex items-center gap-2">
                                <span class="">کد خبر:</span>
                                <span class="">۲۵۴۸۹</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <i data-lucide="calendar" width="14"></i>
                                <span>۱۴ بهمن ۱۴۰۳</span>
                            </div>
                        </div>
                    </div>

                    <!-- Article Header -->
                    <header class="mb-8">
                        <!-- Category Badge Removed -->

                        <h1 class="text-2xl md:text-3xl lg:text-4xl font-black text-slate-900 dark:text-white leading-tight mb-6">
                            تحلیل جامع بودجه ۱۴۰۴: سناریوهای تورمی و رشد اقتصادی در سایه تحریم‌ها
                        </h1>

                        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 dark:border-slate-800 pb-6 mb-6 print:border-black">
                            <!-- Author Name (Replaced News ID) -->
                            <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400 print:text-black">
                                <i data-lucide="user" width="16" class="text-rose-600"></i>
                                <span class="font-bold text-slate-700 dark:text-slate-200">دکتر علیرضا افشار</span>
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
                        <p class="text-lg md:text-xl font-bold text-slate-600 dark:text-slate-300 leading-relaxed text-justify border-r-4 border-rose-600 pr-4 mb-8 print:text-black print:border-r-0 print:pr-0">
                            لایحه بودجه سال آینده در حالی به مجلس ارائه شده است که کارشناسان اقتصادی نظرات متفاوتی درباره میزان تحقق درآمدهای نفتی و مالیاتی آن دارند. آیا این بودجه می‌تواند تورم را مهار کند؟
                        </p>

                        <figure class="rounded-2xl overflow-hidden mb-10 print:shadow-none">
                            <img src="https://picsum.photos/seed/hero_lead/1200/600" alt="بودجه 1404" class="w-full h-auto object-cover">
                        </figure>
                    </header>

                    <!-- Article Body -->
                    <div class="single-content print:text-black">
                        <p>
                            به گزارش پایگاه خبری نماد اقتصاد، لایحه بودجه سال ۱۴۰۴ کل کشور که هفته گذشته توسط رئیس‌جمهور به مجلس شورای اسلامی تقدیم شد، واکنش‌های متفاوتی را در محافل اقتصادی و سیاسی برانگیخته است. این لایحه که بر مبنای نرخ رشد اقتصادی ۸ درصدی و تورم هدف‌گذاری شده ۲۰ درصدی تنظیم شده است، با چالش‌های جدی در بخش منابع و مصارف روبروست.
                        </p>

                        <h2>منابع درآمدی؛ خوش‌بینی یا واقع‌گرایی؟</h2>
                        <p>
                            یکی از مهم‌ترین بخش‌های بودجه، پیش‌بینی درآمدهای نفتی است. دولت در این لایحه قیمت نفت را بشکه‌ای ۶۵ دلار در نظر گرفته است که با توجه به نوسانات بازارهای جهانی و تداوم تحریم‌ها، برخی کارشناسان آن را خوش‌بینانه ارزیابی می‌کنند.
                        </p>
                        <blockquote>
                            دکتر محمدی، استاد اقتصاد دانشگاه تهران معتقد است: «وابستگی بودجه به درآمدهای ناپایدار نفتی، پاشنه آشیل اقتصاد ایران است. اگر قیمت نفت کاهش یابد یا صادرات طبق برنامه پیش نرود، کسری بودجه اجتناب‌ناپذیر خواهد بود که نتیجه مستقیم آن، چاپ پول و تورم است.»
                        </blockquote>


                        <p>
                            از سوی دیگر، افزایش ۵۰ درصدی درآمدهای مالیاتی نیز فشار مضاعفی را بر بخش تولید و اصناف وارد خواهد کرد. فعالان بخش خصوصی بر این باورند که در شرایط رکود تورمی، افزایش مالیات می‌تواند منجر به تعطیلی بنگاه‌های کوچک و متوسط شود.
                        </p>

                        <!-- Inline Related News -->
                        <div class="my-8 bg-rose-50 dark:bg-slate-800/50 border-r-4 border-rose-600 p-5 rounded-l-xl print:hidden flex flex-col gap-2">
                            <span class="text-xs font-black text-rose-600 flex items-center gap-2">
                                <i data-lucide="link" width="14"></i>
                                بیشتر بخوانید:
                            </span>
                            <a href="#" class="text-sm md:text-base font-bold text-slate-800 dark:text-slate-200 hover:text-rose-600 transition-colors leading-relaxed">
                                پیش‌بینی قیمت طلا و سکه در هفته آینده؛ آیا روند صعودی ادامه خواهد داشت؟
                            </a>
                        </div>


                        <h2>مصارف و هزینه‌ها؛ انقباضی یا انبساطی؟</h2>
                        <p>
                            در بخش مصارف، دولت تلاش کرده است تا هزینه‌های جاری را کنترل کند، اما افزایش حقوق کارکنان دولت به میزان ۲۰ درصد، همچنان بخش عمده‌ای از بودجه را می‌بلعد. این در حالی است که تورم نقطه به نقطه در حال حاضر بالای ۴۰ درصد است و این افزایش حقوق عملاً قدرت خرید کارمندان را حفظ نمی‌کند.
                        </p>

                        <h3>راهکارهای پیشنهادی</h3>
                        <ul>
                            <li>کاهش هزینه‌های غیرضروری دستگاه‌های اجرایی</li>
                            <li>مولدسازی دارایی‌های دولت با شفافیت کامل</li>
                            <li>اصلاح نظام مالیاتی به نفع تولیدکنندگان و جلوگیری از فرار مالیاتی</li>
                            <li>تقویت دیپلماسی اقتصادی برای افزایش صادرات غیرنفتی</li>
                        </ul>

                        <p>
                            در نهایت، موفقیت این بودجه در گرو انضباط مالی سخت‌گیرانه دولت و همکاری مجلس برای اصلاح ساختار معیوب بودجه‌ریزی است. باید دید در کمیسیون تلفیق چه تغییراتی در ارقام پیشنهادی دولت اعمال خواهد شد.
                        </p>
                    </div>

                    <!-- Tags -->
                    <div class="flex flex-wrap items-center gap-2 mt-10 pt-6 border-t border-slate-100 dark:border-slate-800 print:hidden">
                        <span class="text-sm font-bold text-slate-500 ml-2">برچسب‌ها:</span>
                        <a href="#" class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800 rounded-lg text-xs text-slate-600 dark:text-slate-300 hover:bg-rose-600 hover:text-white transition-colors">بودجه ۱۴۰۴</a>
                        <a href="#" class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800 rounded-lg text-xs text-slate-600 dark:text-slate-300 hover:bg-rose-600 hover:text-white transition-colors">اقتصاد ایران</a>
                        <a href="#" class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800 rounded-lg text-xs text-slate-600 dark:text-slate-300 hover:bg-rose-600 hover:text-white transition-colors">تورم</a>
                        <a href="#" class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800 rounded-lg text-xs text-slate-600 dark:text-slate-300 hover:bg-rose-600 hover:text-white transition-colors">مجلس شورای اسلامی</a>
                    </div>

                    <!-- Author & Short Link Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10 print:hidden">
                        <!-- Author Box -->
                        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 flex items-center gap-4 shadow-sm h-full">
                            <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-slate-100 dark:border-slate-700 shrink-0">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/janansefat-3.jpg" alt="Author" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <h4 class="text-base font-black text-slate-800 dark:text-slate-100 mb-1">دکتر علیرضا افشار</h4>
                                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed mb-2 line-clamp-2">
                                    دکترای اقتصاد بین‌الملل و تحلیل‌گر ارشد بازارهای مالی.
                                </p>
                                <a href="#" class="text-rose-600 text-xs font-bold hover:underline">مشاهده دیگر مطالب</a>
                            </div>
                        </div>

                        <!-- Short Link Box -->
                        <div class="bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-5 flex flex-col justify-center items-start gap-3 h-full">
                            <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400">
                                <i data-lucide="link" width="16"></i>
                                <span class="text-sm font-bold">لینک کوتاه مطلب:</span>
                            </div>
                            <div class="flex items-center gap-2 w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-3 py-2">
                                <span id="short-link-text" class="text-xs font-mono text-slate-600 dark:text-slate-300 dir-ltr select-all truncate">https://namad.ir/n/25489</span>
                                <button id="copy-link-btn" class="text-slate-400 hover:text-rose-600 transition-colors shrink-0" title="کپی لینک">
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
                    <section class="mt-12 print:hidden">
                        <!-- Separator -->
                        <div class="w-full h-px bg-slate-200 dark:bg-slate-700 mb-12"></div>

                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-1.5 h-8 flex flex-col  rounded-full overflow-hidden shrink-0">
                                <div class="h-1/3 bg-slate-400"></div>
                                <div class="h-2/3 bg-rose-600"></div>
                            </div>
                            <h3 class="text-xl font-black text-slate-800 dark:text-white">اخبار مرتبط</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Related Item 1 -->
                            <a href="#" class="group flex items-start gap-4 bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 hover:border-rose-200 dark:hover:border-rose-900/50 transition-all">
                                <div class="w-24 h-24 rounded-lg overflow-hidden shrink-0">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/apartoman.jpg" alt="Related" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-slate-800 dark:text-slate-200 leading-relaxed group-hover:text-rose-600 transition-colors mb-2">
                                        تاثیر نوسانات ارزی بر بازار مسکن؛ آیا زمان خرید فرا رسیده است؟
                                    </h4>
                                    <div class="flex items-center gap-2 text-xs text-slate-400">
                                        <i data-lucide="clock" width="12"></i>
                                        <span>۲ ساعت پیش</span>
                                    </div>
                                </div>
                            </a>
                            <!-- Related Item 2 -->
                            <a href="#" class="group flex items-start gap-4 bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 hover:border-rose-200 dark:hover:border-rose-900/50 transition-all">
                                <div class="w-24 h-24 rounded-lg overflow-hidden shrink-0">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gold-05.jpg" alt="Related" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-slate-800 dark:text-slate-200 leading-relaxed group-hover:text-rose-600 transition-colors mb-2">
                                        جزئیات جدید از طرح مالیات بر عایدی سرمایه و طلا
                                    </h4>
                                    <div class="flex items-center gap-2 text-xs text-slate-400">
                                        <i data-lucide="clock" width="12"></i>
                                        <span>۵ ساعت پیش</span>
                                    </div>
                                </div>
                            </a>
                            <!-- Related Item 3 -->
                            <a href="#" class="group flex items-start gap-4 bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 hover:border-rose-200 dark:hover:border-rose-900/50 transition-all">
                                <div class="w-24 h-24 rounded-lg overflow-hidden shrink-0">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bit-usa.jpg" alt="Related" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-slate-800 dark:text-slate-200 leading-relaxed group-hover:text-rose-600 transition-colors mb-2">
                                        سقوط آزاد بیت‌کوین؛ تحلیل تکنیکال روند بازار کریپتو
                                    </h4>
                                    <div class="flex items-center gap-2 text-xs text-slate-400">
                                        <i data-lucide="clock" width="12"></i>
                                        <span>دیروز</span>
                                    </div>
                                </div>
                            </a>
                            <!-- Related Item 4 -->
                            <a href="#" class="group flex items-start gap-4 bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 hover:border-rose-200 dark:hover:border-rose-900/50 transition-all">
                                <div class="w-24 h-24 rounded-lg overflow-hidden shrink-0">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bours-26.jpg" alt="Related" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-slate-800 dark:text-slate-200 leading-relaxed group-hover:text-rose-600 transition-colors mb-2">
                                        آینده بورس تهران در نیمه دوم سال چگونه خواهد بود؟
                                    </h4>
                                    <div class="flex items-center gap-2 text-xs text-slate-400">
                                        <i data-lucide="clock" width="12"></i>
                                        <span>۲ روز پیش</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </section>

                    <!-- Comments Section -->
                    <section class="mt-12 print:hidden" id="comments">
                        <!-- Separator -->
                        <div class="w-full h-px bg-slate-200 dark:bg-slate-700 mb-12"></div>

                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-1.5 h-8 flex flex-col  rounded-full overflow-hidden shrink-0">
                                <div class="h-1/3 bg-slate-400"></div>
                                <div class="h-2/3 bg-rose-600"></div>
                            </div>
                            <h3 class="text-xl font-black text-slate-800 dark:text-white">دیدگاه‌ها</h3>
                        </div>

                        <!-- Compact Comment Form -->
                        <div class="bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 mb-8">
                            <form action="#" class="relative" id="comment-form">
                                <!-- Top Row: Textarea + Send Button -->
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center shrink-0">
                                        <i data-lucide="user" class="text-slate-400" width="20"></i>
                                    </div>
                                    <div class="flex-1">
                                        <textarea
                                            id="comment-textarea"
                                            rows="1"
                                            placeholder="دیدگاه خود را بنویسید..."
                                            class="w-full px-4 py-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:outline-none focus:border-rose-600 dark:focus:border-rose-500 transition-all text-sm resize-none overflow-hidden min-h-[44px]"
                                            oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>

                                        <!-- Hidden Fields (Toggle on focus) -->
                                        <div id="comment-details" class="hidden mt-3 grid grid-cols-1 md:grid-cols-2 gap-3 animate-fade-in">
                                            <input type="text" placeholder="نام و نام خانوادگی" class="w-full px-4 py-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:outline-none focus:border-rose-600 dark:focus:border-rose-500 transition-colors text-sm">
                                            <input type="email" placeholder="ایمیل (نمایش داده نمی‌شود)" class="w-full px-4 py-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:outline-none focus:border-rose-600 dark:focus:border-rose-500 transition-colors text-sm">
                                        </div>
                                    </div>
                                    <button type="submit" class="shrink-0 bg-rose-600 hover:bg-rose-700 text-white w-11 h-11 rounded-xl flex items-center justify-center transition-colors shadow-md hover:shadow-lg">
                                        <i data-lucide="send" width="18"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Comments List -->
                        <div class="space-y-6">
                            <!-- Comment 1 -->
                            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-5">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-rose-50 dark:bg-rose-900/20 flex items-center justify-center text-rose-600 dark:text-rose-400 font-bold text-sm">
                                            م
                                        </div>
                                        <div>
                                            <h5 class="text-sm font-bold text-slate-800 dark:text-slate-200">محمد رضایی</h5>
                                            <span class="text-[10px] text-slate-400">۱۴ بهمن ۱۴۰۳ - ۱۰:۳۰</span>
                                        </div>
                                    </div>
                                    <button class="text-xs text-slate-400 hover:text-rose-600 font-medium transition-colors flex items-center gap-1">
                                        <i data-lucide="reply" width="14"></i> پاسخ
                                    </button>
                                </div>
                                <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed text-justify pr-12">
                                    تحلیل بسیار دقیقی بود. به نظر من هم اگر دولت نتواند هزینه‌های جاری را کنترل کند، تورم در سال آینده همچنان صعودی خواهد بود. ممنون از مقاله خوبتون.
                                </p>

                                <!-- Nested Comment (Reply) -->
                                <div class="mt-4 mr-8 md:mr-12 bg-slate-50 dark:bg-slate-800/50 rounded-xl p-4 border-r-2 border-rose-200 dark:border-rose-900">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-slate-500 text-xs font-bold">
                                                ادمین
                                            </div>
                                            <div>
                                                <h5 class="text-xs font-bold text-slate-700 dark:text-slate-300">پاسخ ادمین</h5>
                                                <span class="text-[10px] text-slate-400">۱۰ دقیقه پیش</span>
                                            </div>
                                        </div>
                                        <button class="text-[10px] text-slate-400 hover:text-rose-600 font-medium transition-colors flex items-center gap-1">
                                            <i data-lucide="reply" width="12"></i> پاسخ
                                        </button>
                                    </div>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                                        سلام محمد عزیز، ممنون از نظر لطف شما. امیدواریم سیاست‌گذار به این نکات توجه کند.
                                    </p>
                                </div>
                            </div>

                            <!-- Comment 2 -->
                            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-5">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-400 font-bold text-sm">
                                            س
                                        </div>
                                        <div>
                                            <h5 class="text-sm font-bold text-slate-800 dark:text-slate-200">سارا احمدی</h5>
                                            <span class="text-[10px] text-slate-400">۱۴ بهمن ۱۴۰۳ - ۱۱:۱۵</span>
                                        </div>
                                    </div>
                                    <button class="text-xs text-slate-400 hover:text-rose-600 font-medium transition-colors flex items-center gap-1">
                                        <i data-lucide="reply" width="14"></i> پاسخ
                                    </button>
                                </div>
                                <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed text-justify pr-12">
                                    در مورد درآمدهای نفتی کمی بدبینانه نگاه کردید. با توجه به تحولات منطقه احتمال افزایش قیمت نفت وجود دارد که می‌تواند کسری بودجه را جبران کند.
                                </p>
                            </div>
                        </div>
                    </section>

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
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Comment Form Toggle
            const commentTextarea = document.getElementById('comment-textarea');
            const commentDetails = document.getElementById('comment-details');

            if (commentTextarea && commentDetails) {
                commentTextarea.addEventListener('focus', () => {
                    commentDetails.classList.remove('hidden');
                });
            }

            // Smooth Scroll for Buttons
            const scrollToCommentsBtn = document.getElementById('scroll-to-comments');
            const commentsSection = document.getElementById('comments');

            if (scrollToCommentsBtn && commentsSection) {
                scrollToCommentsBtn.addEventListener('click', () => {
                    commentsSection.scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            }

            const scrollToShortLinkBtn = document.getElementById('scroll-to-shortlink');
            const shortLinkSection = document.getElementById('short-link-text'); // Scroll to the text element or its container

            if (scrollToShortLinkBtn && shortLinkSection) {
                scrollToShortLinkBtn.addEventListener('click', () => {
                    // Find the container box for better visibility
                    const container = shortLinkSection.closest('.bg-slate-50') || shortLinkSection;
                    container.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });

                    // Optional: Highlight effect
                    container.classList.add('ring-2', 'ring-rose-600', 'transition-all', 'duration-500');
                    setTimeout(() => {
                        container.classList.remove('ring-2', 'ring-rose-600');
                    }, 1500);
                });
            }

            // Copy Link Functionality
            const copyBtn = document.getElementById('copy-link-btn');
            const linkText = document.getElementById('short-link-text');
            const toast = document.getElementById('toast-notification');

            if (copyBtn && linkText) {
                copyBtn.addEventListener('click', () => {
                    navigator.clipboard.writeText(linkText.textContent).then(() => {
                        // Show Toast
                        toast.classList.remove('translate-y-20', 'opacity-0');

                        // Hide Toast after 3s
                        setTimeout(() => {
                            toast.classList.add('translate-y-20', 'opacity-0');
                        }, 3000);
                    }).catch(err => {
                        console.error('Failed to copy: ', err);
                    });
                });
            }
        });
    </script>

<?php core_end_section(); ?>

<?php core_view('layout/base'); ?>
