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
    <?php 
    if (get_theme_mod('hasht_home_hero_enable', true)) {
        core_view('partials/hero-section');
    }
    ?>

    <!-- Content Body -->
    <div class="container mx-auto px-4 mt-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            <!-- Main Content (Columns 1-9) -->
            <div class="lg:col-span-9 space-y-8">

                <!-- Macro Econ Category -->
                <?php 
                if (get_theme_mod('hasht_home_grid_enable', true)) {
                    core_view('partials/section-macro-economics');
                }
                ?>

                <!-- Company Stories -->
                <?php 
                if (get_theme_mod('hasht_home_stories_enable', true)) {
                    core_view('partials/section-company-stories');
                }
                ?>

                <!-- Society + Sidebar -->
                <div class="grid grid-cols-1 xl:grid-cols-12 gap-12">
                    <div class="xl:col-span-8">
                        <?php 
                        if (get_theme_mod('hasht_home_society_enable', true)) {
                            core_view('partials/section-society-economics');
                        }
                        ?>
                    </div>
                    <aside class="xl:col-span-4">
                        <?php 
                        if (get_theme_mod('hasht_home_notes_enable', true)) {
                            // Display the dedicated widget area instead of the hardcoded view
                            if (is_active_sidebar('home-notes-sidebar')) {
                                dynamic_sidebar('home-notes-sidebar');
                            } else {
                                // Fallback or placeholder if needed, though usually empty is fine
                                // echo '<div class="bg-slate-100 p-4 rounded text-center text-slate-500">ابزارک یادداشت و مصاحبه را اینجا قرار دهید</div>';
                            }
                        }
                        ?>
                    </aside>
                </div>

                <!-- Industry & Energy (Feature Section) -->
                <?php 
                if (get_theme_mod('hasht_home_industry_enable', true) || get_theme_mod('hasht_home_energy_enable', true)) {
                    core_view('partials/section-industry-energy');
                }
                ?>

                <!-- Visual Multimedia Showcase -->
                <?php 
                if (get_theme_mod('hasht_home_multimedia_enable', true)) {
                    core_view('partials/section-multimedia');
                }
                ?>

            </div>

            <!-- Sidebar Area (Columns 10-12) -->
            <aside class="lg:col-span-3">
                <?php 
                if (get_theme_mod('hasht_home_sidebar_enable', true)) {
                    core_view('partials/sidebar-home');
                }
                ?>
            </aside>

        </div>

        <!-- Bottom Categories -->
        <?php 
        if (get_theme_mod('hasht_home_bottom_enable', true)) {
            core_view('partials/section-bottom-categories');
        }
        ?>

        <!-- Publications -->
        <?php 
        if (get_theme_mod('hasht_home_publications_enable', true)) {
            core_view('partials/section-publications');
        }
        ?>

    </div>
<?php core_end_section(); ?>

<?php core_start_section('scripts'); ?>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js" defer></script>
<?php core_end_section(); ?>

<?php core_view('layout/base'); ?>
