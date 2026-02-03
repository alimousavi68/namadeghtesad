<!-- Footer -->
<footer class="bg-footer-bg text-slate-300 pt-16 pb-8 border-t border-slate-800">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            <!-- Brand Info -->
            <section class="col-span-1 flex flex-col items-center text-center md:items-start md:text-right">
                <h2 class="text-3xl font-black text-white mb-6">
                    نماد <span class="text-primary">اقتصاد</span>
                </h2>
                <p class="text-sm leading-7 mb-6 font-medium">
                    پایگاه خبری نماد اقتصاد، به عنوان رسانه تخصصی حوزه اقتصاد ایران، تلاش می‌کند با ارائه تحلیل‌های
                    دقیق و اخبار موثق، همراه فعالان اقتصادی باشد.
                </p>
                <div class="flex gap-4 flex-wrap">
                    <?php
                    $socials = [
                        'instagram' => 'instagram',
                        'twitter'   => 'twitter',
                        'linkedin'  => 'linkedin',
                        'facebook'  => 'facebook',
                        'telegram'  => 'send',
                        'bale'      => 'message-circle',
                        'eitaa'     => 'message-square',
                        'rubika'    => 'box',
                        'igap'      => 'message-circle',
                    ];

                    foreach ($socials as $key => $icon) {
                        $enable = get_theme_mod("hasht_social_{$key}_enable", false);
                        $url    = get_theme_mod("hasht_social_{$key}_url", '#');

                        if ($enable && !empty($url)) {
                            echo '<a href="' . esc_url($url) . '" target="_blank" class="w-12 h-12 rounded-xl bg-slate-800 flex items-center justify-center hover:bg-primary transition-colors">';
                            echo '<i data-lucide="' . esc_attr($icon) . '" width="24"></i>';
                            echo '</a>';
                        }
                    }
                    ?>
                </div>
            </section>

            <!-- Quick Links -->
            <nav class="col-span-1 footer-accordion" aria-label="Quick Links">
                <button class="w-full flex items-center justify-between text-white font-black mb-4 md:mb-6 border-r-2 border-primary pr-3 md:cursor-default">
                    <span>دسترسی سریع</span>
                    <i data-lucide="chevron-down" class="w-5 h-5 md:hidden transition-transform duration-300"></i>
                </button>
                <ul class="space-y-4 text-sm font-medium hidden md:block overflow-hidden transition-all duration-300">
                    <li><a href="#" class="hover:text-primary transition-colors">اقتصاد کلان</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">صنعت و معدن</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">بانک و بیمه</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">بورس و فرابورس</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">انرژی و پتروشیمی</a></li>
                </ul>
            </nav>

            <!-- Help Links -->
            <nav class="col-span-1 footer-accordion" aria-label="Help Links">
                <button class="w-full flex items-center justify-between text-white font-black mb-4 md:mb-6 border-r-2 border-primary pr-3 md:cursor-default">
                    <span>خدمات مخاطبان</span>
                    <i data-lucide="chevron-down" class="w-5 h-5 md:hidden transition-transform duration-300"></i>
                </button>
                <ul class="space-y-4 text-sm font-medium hidden md:block overflow-hidden transition-all duration-300">
                    <li><a href="#" class="hover:text-primary transition-colors">اشتراک نشریات</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">تبلیغات در سایت</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">فرصت‌های شغلی</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">قوانین و مقررات</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">ارسال سوژه خبری</a></li>
                </ul>
            </nav>

            <!-- Contact -->
            <section class="col-span-1 footer-accordion">
                <button class="w-full flex items-center justify-between text-white font-black mb-4 md:mb-6 border-r-2 border-primary pr-3 md:cursor-default">
                    <span>تماس با ما</span>
                    <i data-lucide="chevron-down" class="w-5 h-5 md:hidden transition-transform duration-300"></i>
                </button>
                <ul class="space-y-4 text-sm font-medium hidden md:block overflow-hidden transition-all duration-300">
                    <li class="flex items-start gap-3">
                        <i data-lucide="map-pin" width="18" class="text-primary shrink-0"></i>
                        <span>تهران، خیابان ولیعصر، نرسیده به میدان ونک، بن‌بست شادمان، پلاک ۴</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i data-lucide="phone" width="18" class="text-primary shrink-0"></i>
                        <span>۰۲۱ - ۸۸۸۹۹۹۰۰</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i data-lucide="mail" width="18" class="text-primary shrink-0"></i>
                        <span>info@namadeghtesad.ir</span>
                    </li>
                </ul>
            </section>
        </div>

        <div
            class="border-t border-slate-800 pt-8 mt-8 flex flex-col md:flex-row justify-between items-center text-[10px] md:text-xs text-slate-500 font-bold">
            <p>© ۱۴۰۳ تمامی حقوق مادی و معنوی متعلق به پایگاه خبری نماد اقتصاد می‌باشد.</p>
            <div class="flex gap-6 mt-4 md:mt-0">
                <a href="#" class="hover:text-white">طراحی و توسعه: هشت بهشت</a>
                <a href="#" class="hover:text-white">نقشه سایت</a>
            </div>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<button id="back-to-top" type="button" class="fixed bottom-6 left-6 md:left-auto md:right-6 z-50 opacity-0 invisible transition-all duration-300 cursor-pointer group">
    <div class="relative w-12 h-12 flex items-center justify-center bg-white dark:bg-slate-800 rounded-full shadow-lg border border-slate-100 dark:border-slate-700 group-hover:-translate-y-1 transition-transform">
        <svg class="absolute top-0 left-0 w-full h-full -rotate-90" width="48" height="48" viewBox="0 0 48 48">
            <circle cx="24" cy="24" r="23" stroke="currentColor" stroke-width="2" fill="none" class="text-slate-100 dark:text-slate-700" />
            <circle id="progress-circle" cx="24" cy="24" r="23" stroke="currentColor" stroke-width="2" fill="none" class="text-primary transition-all duration-100" stroke-dasharray="144.5" stroke-dashoffset="144.5" stroke-linecap="round" />
        </svg>
        <i data-lucide="arrow-up" class="w-5 h-5 text-primary dark:text-primary relative z-10"></i>
    </div>
</button>
