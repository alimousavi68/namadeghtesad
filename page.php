<?php
/**
 * Page Template
 */
if (function_exists('core_view')) {
    core_view('pages/page');
} else {
    echo "Core system is not active.";
}
