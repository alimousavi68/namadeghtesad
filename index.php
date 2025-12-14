<?php
/**
 * 
 * Main Template 
 */
if (function_exists('core_view')) {
    // If it's the home page, load 'pages/home'
    // Otherwise, you can add logic to load 'pages/single', 'pages/archive', etc.
    core_view('pages/home');
} else {
    // Fallback if core is not loaded
    echo "core system is not active.";
}
