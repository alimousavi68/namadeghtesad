<?php

/**
 * 
 * Home page view 
 */
core_start_section('title'); ?>
<?php core_end_section(); ?>

<!-- 1. Add Head Section -->
<?php core_start_section('head'); ?>
<!-- Add custom head content here -->
<?php core_end_section(); ?>



<!-- A. Add Content Section -->
<?php core_start_section('content'); ?>

<body class="transition-colors duration-300">

    <!-- Sidebar Overlay & Menu -->
    <?php core_view('partials/mobile-menu'); ?>

    <!-- Header -->
    <?php if (function_exists('core_view_exists') && core_view_exists('partials/header'))  core_view('partials/header'); ?>



    <!-- Main Content -->
    <main class="max-w-[1200px] mx-auto px-4 sm:px-6">

        <!-- Hero Section -->
        <?php
        $hero_query_type = get_theme_mod('hasht_home_hero_query_type', 'latest');
        $hero_cat        = get_theme_mod('hasht_home_hero_cat', '');
        $hero_count      = get_theme_mod('hasht_home_hero_count', 5);
        $hero_pt         = get_theme_mod('hasht_home_hero_post_type', 'all');

        $hero_args = ['posts_per_page' => $hero_count];
        if ($hero_pt === 'all') {
            $hero_args['post_type'] = ['post', 'aggregated_news'];
        } else {
            $hero_args['post_type'] = $hero_pt;
        }
        if ($hero_query_type === 'category' && !empty($hero_cat)) {
            $hero_args['category_name'] = $hero_cat;
        }

        $hero_query = hasht_get_posts($hero_args);
        
        core_view('partials/hero', ['query' => $hero_query]);
        ?>


        <!-- Latest News -->
        <?php 
        $latest_title      = get_theme_mod('hasht_home_latest_title', 'جدیدترین اخبار');
        $latest_query_type = get_theme_mod('hasht_home_latest_query_type', 'latest');
        $latest_cat        = get_theme_mod('hasht_home_latest_cat', '');
        $latest_count      = get_theme_mod('hasht_home_latest_count', 6);
        $latest_offset     = get_theme_mod('hasht_home_latest_offset', 5);
        $latest_pt         = get_theme_mod('hasht_home_latest_post_type', 'all');

        $latest_args = [
            'posts_per_page' => $latest_count,
            'offset'         => $latest_offset
        ];
        if ($latest_pt === 'all') {
            $latest_args['post_type'] = ['post', 'aggregated_news'];
        } else {
            $latest_args['post_type'] = $latest_pt;
        }

        if ($latest_query_type === 'category' && !empty($latest_cat)) {
            $latest_args['category_name'] = $latest_cat;
        }

        $latest_query = hasht_get_posts($latest_args);

        core_view('partials/latest-news', [
            'query' => $latest_query,
            'title' => $latest_title
        ]); 
        ?>


        <!-- Most visited -->
        <?php 
        $visited_title      = get_theme_mod('hasht_home_visited_title', 'اخبار پربازدید');
        $visited_query_type = get_theme_mod('hasht_home_visited_query_type', 'latest');
        $visited_cat        = get_theme_mod('hasht_home_visited_cat', '');
        $visited_count      = get_theme_mod('hasht_home_visited_count', 10);
        $visited_pt         = get_theme_mod('hasht_home_visited_post_type', 'all');

        $visited_args = ['posts_per_page' => $visited_count];
        if ($visited_pt === 'all') {
            $visited_args['post_type'] = ['post', 'aggregated_news'];
        } else {
            $visited_args['post_type'] = $visited_pt;
        }

        if ($visited_query_type === 'category' && !empty($visited_cat)) {
            $visited_args['category_name'] = $visited_cat;
        }

        $visited_query = hasht_get_posts($visited_args);

        core_view('partials/most-visited', [
            'query' => $visited_query,
            'title' => $visited_title
        ]);
        ?>


        <!-- Topic Section -->
        <?php 
        $topics_data = [];
        for ($i = 1; $i <= 6; $i++) {
            $t_title = get_theme_mod("hasht_home_topic_{$i}_title", "موضوع $i");
            $t_cat   = get_theme_mod("hasht_home_topic_{$i}_cat", '');
            $t_pt    = get_theme_mod("hasht_home_topic_{$i}_post_type", 'all');
            
            if (!empty($t_cat)) {
                $t_args = [
                    'category_name'  => $t_cat,
                    'posts_per_page' => 5 
                ];
                if ($t_pt === 'all') {
                    $t_args['post_type'] = ['post', 'aggregated_news'];
                } else {
                    $t_args['post_type'] = $t_pt;
                }
                $t_query = hasht_get_posts($t_args);
                
                if ($t_query->have_posts()) {
                    $topics_data[] = [
                        'title'    => $t_title,
                        'query'    => $t_query,
                        'cat_slug' => $t_cat
                    ];
                }
            }
        }

        if (!empty($topics_data)) {
            core_view('partials/topic-section', ['topics' => $topics_data]);
        }
        ?>

    </main>

    <!-- Footer -->
    <?php core_view('partials/footer'); ?>

    <?php core_end_section(); ?>


    <!-- B. Add Scripts Section -->
    <?php core_start_section('scripts'); ?>

    <!-- JavaScript Logic -->
    <script>
        // Add your custom JavaScript code here
    </script>
    <?php core_end_section(); ?>


    <?php
    // Extend the base layout 
    core_view('layout/base');
