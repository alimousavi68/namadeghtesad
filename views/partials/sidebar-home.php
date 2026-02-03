<!-- Sidebar Content (Home) -->
<div class="space-y-5 sticky top-4">
    <?php if (is_active_sidebar('home-sidebar')) : ?>
        <?php dynamic_sidebar('home-sidebar'); ?>
    <?php else : ?>
        <!-- Default Fallback if no widgets are active (Optional, can be removed) -->
        <div class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
            <p class="text-center text-slate-500">لطفاً از بخش نمایش > ابزارک‌ها، ویجت‌های سایدبار صفحه اصلی را تنظیم کنید.</p>
        </div>
    <?php endif; ?>
</div>
