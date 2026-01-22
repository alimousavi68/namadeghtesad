<?php
/**
 * Archive Template
 */
if (function_exists('core_view')) {
    core_view('pages/archive');
} else {
    echo "Core system is not active.";
}
