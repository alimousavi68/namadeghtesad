<?php 
/**
 * 
 * Home page view 
 */
core_start_section('title'); ?>
صفحه اصلی  - وبسایت من 
<?php core_end_section(); ?>


<?php core_start_section('head'); ?>
    <meta name="description" content="این یک صفحه نمونه با سیستم Layout جدید است." >
<?php core_end_section(); ?>

<?php core_start_section('content'); ?>
    <div class="container mx-auto py-10">
        <h1 class="text-3xl font-bold mb-4 text-primary">سلام، این سیستم Layout جدید است!</h1>
        <p class="text-gray-600 mb-4">
            این محتوا از فایل <code>views/pages/home.php</code> خوانده می‌شود و درون <code>_hasht_core/views/layout/base.php</code> قرار می‌گیرد.
        </p>
        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            تست دکمه
        </button>
    </div>
<?php core_end_section(); ?>

<?php core_start_section('scripts'); ?>
    <script>
        console.log('Home Page Loaded Successfully via Core Layout System');
    </script>
<?php core_end_section(); ?>

<?php 
// Extend the base layout 
core_view('layout/base');
