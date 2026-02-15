<?php
/**
 * Pagination Partial
 * 
 * Replaces static HTML with dynamic WordPress pagination
 */
global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) return;

$big = 999999999; // need an unlikely integer

$pages = paginate_links( array(
    'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format'    => '?paged=%#%',
    'current'   => max( 1, get_query_var('paged') ),
    'total'     => $wp_query->max_num_pages,
    'type'      => 'array',
    'prev_text' => '<i data-lucide="chevron-right" width="20"></i>',
    'next_text' => '<i data-lucide="chevron-left" width="20"></i>',
    'mid_size'  => 1,
    'end_size'  => 1,
) );

if ( is_array( $pages ) ) {
    echo '<div class="flex items-center justify-center gap-2 mt-12">';
    foreach ( $pages as $page ) {
        if ( strpos( $page, 'current' ) !== false ) {
             $class = 'w-10 h-10 flex items-center justify-center rounded-xl bg-primary text-white font-bold shadow-md shadow-rose-200 dark:shadow-none';
        } elseif ( strpos( $page, 'dots' ) !== false ) {
             $class = 'w-10 h-10 flex items-center justify-center text-slate-400';
        } else {
             $class = 'w-10 h-10 flex items-center justify-center rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-300 hover:border-primary hover:text-primary transition-all font-bold';
        }
        
        $page = preg_replace( '/class="[^"]*"/', 'class="' . $class . '"', $page );
        echo $page;
    }
    echo '</div>';
}
?>
