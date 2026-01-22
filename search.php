<?php
/**
 * Search Template
 */
if (function_exists('core_view')) {
    core_view('pages/search');
} else {
    echo "Core system is not active.";
}
