<?php
/**
 * 
 * Customizer Module Entry Point
 * 
 * This file bootstraps the customizer logic.
 */

//load the main logic class
require_once __DIR__ . '/customizer/logic.php';

// Hook into Wordpress Customizer : 

// 1. Register settings and controls
add_action( 'customize_register'  , ['Core_Customizer_Logic','register'] );

// 2. Save and compile tokens after user hits "Publish"
add_action( 'customize_save_after', ['Core_Customizer_Logic','compile_settings']);