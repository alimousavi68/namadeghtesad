<!-- Sidebar Content (Home) -->
<div class="space-y-5 sticky top-4">
    <!-- Selected News (Previously Market Widget) -->
    <div class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
        <div class="flex items-center gap-3 mb-4">
            <h3 class="section-title flex items-center gap-4">
                <div class="w-1.5 h-8 flex flex-col rounded-full overflow-hidden shrink-0">
                    <div class="h-1/3 bg-slate-400"></div>
                    <div class="h-2/3 bg-rose-600"></div>
                </div>
                اخبار برگزیده
            </h3>
        </div>
        <div class="flex flex-col space-y-4">
            <!-- Static Content for now -->
            <div class="group cursor-pointer flex gap-5 border-b border-slate-50 dark:border-slate-800/50 py-4 last:border-none">
                <span class="text-4xl font-black text-rose-600 group-hover:text-slate-200 dark:group-hover:text-slate-800 transition-colors min-w-[2.5rem] mt-0">۱</span>
                <h4 class="text-[14px] font-bold text-slate-700 dark:text-slate-300 group-hover:text-rose-600 transition-colors line-clamp-2 leading-snug">
                    بهره‌برداری از فاز جدید پالایشگاه آبادان
                </h4>
            </div>
            <div class="group cursor-pointer flex gap-5 border-b border-slate-50 dark:border-slate-800/50 py-4 last:border-none">
                <span class="text-4xl font-black text-rose-600 group-hover:text-slate-200 dark:group-hover:text-slate-800 transition-colors min-w-[2.5rem] mt-0">۲</span>
                <h4 class="text-[14px] font-bold text-slate-700 dark:text-slate-300 group-hover:text-rose-600 transition-colors line-clamp-2 leading-snug">
                    تسهیلات جدید دولت برای بافت فرسوده شهری
                </h4>
            </div>
            <div class="group cursor-pointer flex gap-5 border-b border-slate-50 dark:border-slate-800/50 py-4 last:border-none">
                <span class="text-4xl font-black text-rose-600 group-hover:text-slate-200 dark:group-hover:text-slate-800 transition-colors min-w-[2.5rem] mt-0">۳</span>
                <h4 class="text-[14px] font-bold text-slate-700 dark:text-slate-300 group-hover:text-rose-600 transition-colors line-clamp-2 leading-snug">
                    رایزنی‌های اقتصادی ایران و کشورهای منطقه در تهران
                </h4>
            </div>
            <div class="group cursor-pointer flex gap-5 border-b border-slate-50 dark:border-slate-800/50 py-4 last:border-none">
                <span class="text-4xl font-black text-rose-600 group-hover:text-slate-200 dark:group-hover:text-slate-800 transition-colors min-w-[2.5rem] mt-0">۴</span>
                <h4 class="text-[14px] font-bold text-slate-700 dark:text-slate-300 group-hover:text-rose-600 transition-colors line-clamp-2 leading-snug">
                    برگزاری نمایشگاه بین‌المللی خودرو در اواخر بهمن
                </h4>
            </div>
            <div class="group cursor-pointer flex gap-5 border-b border-slate-50 dark:border-slate-800/50 py-4 last:border-none">
                <span class="text-4xl font-black text-rose-600 group-hover:text-slate-200 dark:group-hover:text-slate-800 transition-colors min-w-[2.5rem] mt-0">۵</span>
                <h4 class="text-[14px] font-bold text-slate-700 dark:text-slate-300 group-hover:text-rose-600 transition-colors line-clamp-2 leading-snug">
                    صادرات محصولات پتروشیمی ۱۵ درصد رشد داشت
                </h4>
            </div>
        </div>
    </div>

    <!-- Latest News Widget -->
    <?php core_view('partials/widget-latest-news'); ?>

    <!-- Ad Box -->
    <?php core_view('partials/widget-advertisement'); ?>
</div>