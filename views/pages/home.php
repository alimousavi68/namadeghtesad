<?php
/**
 * Home page view
 */
?>

<?php core_start_section('head'); ?>
<!-- Custom styles for Home Page -->
<?php core_end_section(); ?>

<?php core_start_section('content'); ?>
    <!-- Hero Section -->
    <?php core_view('partials/hero-section'); ?>

    <!-- Content Body -->
    <div class="container mx-auto px-4 mt-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            <!-- Main Content (Columns 1-9) -->
            <div class="lg:col-span-9 space-y-8">

                <!-- Macro Econ Category -->
                <?php core_view('partials/section-macro-economics'); ?>

                <!-- Company Stories -->
                <?php core_view('partials/section-company-stories'); ?>

                <!-- Society + Sidebar -->
                <div class="grid grid-cols-1 xl:grid-cols-12 gap-12">
                    <div class="xl:col-span-8">
                        <?php core_view('partials/section-society-economics'); ?>
                    </div>
                    <aside class="xl:col-span-4">
                        <?php core_view('partials/section-notes-interviews'); ?>
                    </aside>
                </div>

                <!-- Industry & Energy (Feature Section) -->
                <?php core_view('partials/section-industry-energy'); ?>

                <!-- Visual Multimedia Showcase -->
                <?php core_view('partials/section-multimedia'); ?>

            </div>

            <!-- Sidebar Area (Columns 10-12) -->
            <aside class="lg:col-span-3">
                <?php core_view('partials/sidebar-home'); ?>
            </aside>

        </div>

        <!-- Bottom Categories -->
        <?php core_view('partials/section-bottom-categories'); ?>

        <!-- Publications -->
        <?php core_view('partials/section-publications'); ?>

    </div>
<?php core_end_section(); ?>

<?php core_start_section('scripts'); ?>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js" defer></script>
<?php core_end_section(); ?>

<?php core_view('layout/base'); ?>
