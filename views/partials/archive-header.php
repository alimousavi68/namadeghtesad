<?php
// Default values
$is_author_archive = $is_author_archive ?? false;
$archive_title = $archive_title ?? 'اخبار اقتصادی';
$archive_description = $archive_description ?? 'تازه‌ترین اخبار و تحلیل‌های اقتصادی ایران و جهان';
$author_name = $author_name ?? 'دکتر علیرضا افشار';
$author_role = $author_role ?? 'تحلیل‌گر ارشد اقتصادی';
$author_bio = $author_bio ?? 'دکترای اقتصاد بین‌الملل از دانشگاه تهران. با بیش از ۱۵ سال سابقه فعالیت در بازارهای مالی و تحلیل اقتصاد کلان. تمرکز اصلی ایشان بر سیاست‌های پولی و ارزی است.';
$author_image = $author_image ?? 'images/janansefat-3.jpg';
?>

<!-- Archive Header -->
<header class="mb-10">
    
    <?php if ($is_author_archive): ?>
        <!-- Author Profile Box -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-8 flex flex-col md:flex-row items-center md:items-start gap-6 shadow-sm">
            
            <!-- Author Image -->
            <div class="w-24 h-24 md:w-32 md:h-32 rounded-full overflow-hidden border-4 border-slate-100 dark:border-slate-800 shrink-0 shadow-md">
                <img src="<?php echo $author_image; ?>" alt="<?php echo $author_name; ?>" class="w-full h-full object-cover">
            </div>

            <!-- Author Info -->
            <div class="flex-1 text-center md:text-right">
                <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-4 mb-2">
                    <h1 class="text-2xl font-medium text-slate-900 dark:text-white"><?php echo $author_name; ?></h1>
                    <span class="hidden md:inline-block w-1.5 h-1.5 bg-slate-300 rounded-full"></span>
                    <span class="text-primary font-bold text-sm"><?php echo $author_role; ?></span>
                </div>
                
                <p class="text-slate-600 dark:text-text-light leading-relaxed mb-6 text-sm md:text-base max-w-2xl">
                    <?php echo $author_bio; ?>
                </p>

                <!-- Social Links -->
                <div class="flex items-center justify-center md:justify-start gap-3">
                    <a href="#" class="w-9 h-9 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 hover:bg-primary hover:text-white flex items-center justify-center transition-all">
                        <i data-lucide="twitter" width="16"></i>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-all">
                        <i data-lucide="linkedin" width="16"></i>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 hover:bg-sky-500 hover:text-white flex items-center justify-center transition-all">
                        <i data-lucide="send" width="16"></i>
                    </a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- Simple Category/Tag Header -->
        <div class="flex flex-col gap-4">
            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-sm text-slate-500 dark:text-text-light mb-2">
                <a href="<?php echo home_url('/'); ?> " class="hover:text-primary transition-colors">خانه</a>
                <i data-lucide="chevron-left" width="14"></i>
                <span class="text-slate-800 dark:text-slate-200 font-bold"><?php echo $archive_title; ?></span>
            </nav>

            <div class="flex items-center gap-4">
                <div class="w-1.5 h-12 bg-primary rounded-full"></div>
                <div>
                    <h1 class="text-3xl font-medium text-slate-900 dark:text-white mb-1">
                        <?php echo $archive_title; ?>
                    </h1>
                    <?php if (!empty($archive_description)): ?>
                        <p class="text-sm text-slate-500 dark:text-text-light">
                            <?php echo $archive_description; ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

</header>