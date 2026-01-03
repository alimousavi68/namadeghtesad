<footer class="bg-gray-50 border-t border-gray-200 py-10 mt-16">
    <div class="max-w-[1200px] mx-auto px-4 flex flex-col items-center">
        <div class="flex flex-wrap justify-center gap-8 mb-6 text-sm font-medium text-gray-600">
            <?php
            if (has_nav_menu('footer')) {
                wp_nav_menu([
                    'theme_location' => 'footer',
                    'container'      => false,
                    'menu_class'     => 'flex flex-wrap justify-center gap-8',  
                    'depth'          => 1,
                ]);
            } 
            ?>
        </div>
        <div class="w-full grid grid-cols-1 sm:grid-cols-2 gap-2 items-center text-xs text-gray-400">
            <div class="sm:order-1 sm:text-right text-center">
                <p>&copy; 2024 اندیشه مدیا. تمامی حقوق محفوظ است.</p>
            </div>

            <div class="sm:order-2 sm:text-left text-center">
                <span class="f13">طراحی و توسعه: <a href="https://ihasht.ir/" class=" i8-blink" title="هشت بهشت" alt="Website designer: Hasht Behesht professional website design site" target="_blank">هشت بهشت</a>
            </span>
            </div>
            
        </div>
    </div>
</footer>
