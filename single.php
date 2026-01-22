<?php
/**
 * Single Post Template
 */
if (function_exists('core_view')) {
    core_view('pages/single');
} else {
    echo "Core system is not active.";
}
