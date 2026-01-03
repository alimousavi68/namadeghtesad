<!-- Sidebar Overlay & Menu -->
<div id="hasht-mobile-sidebar-overlay" onclick="closeSidebar()"
    class="fixed inset-0 bg-black/50 z-50 transition-opacity duration-300 opacity-0 invisible"></div>

<div id="hasht-mobile-sidebar"
    class="fixed inset-y-0 right-0 w-64 bg-white shadow-2xl z-50 transform transition-transform duration-300 ease-in-out translate-x-full">
    <div class="flex items-center justify-between p-4 border-b border-gray-100">
        <span class="font-bold text-lg text-gray-800">منو</span>
        <button onclick="closeSidebar()" class="p-1 hover:bg-gray-100 rounded-full">
            <i data-lucide="x" class="w-6 h-6 text-gray-600"></i>
        </button>
    </div>
    <nav class="p-4">
        <?php
        if (has_nav_menu('mobile')) {
            wp_nav_menu([
                'theme_location' => 'mobile',
                'container'      => false,
                'menu_class'     => 'flex flex-col gap-2',
                'fallback_cb'    => false,
                'depth'          => 3,
                'walker'         => class_exists('Hasht_Mobile_Walker') ? new Hasht_Mobile_Walker() : ''
            ]);
        }
        ?>
    </nav>
</div>
