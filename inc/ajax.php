<?php
/**
 * AJAX Comment Handling
 *
 * @package NamadEghtesad
 */

add_action( 'wp_ajax_hasht_submit_comment', 'hasht_ajax_submit_comment' );
add_action( 'wp_ajax_nopriv_hasht_submit_comment', 'hasht_ajax_submit_comment' );

function hasht_ajax_submit_comment() {
    $comment = wp_handle_comment_submission( wp_unslash( $_POST ) );

    if ( is_wp_error( $comment ) ) {
        $data = intval( $comment->get_error_data() );
        if ( ! empty( $data ) ) {
            wp_send_json_error( $comment->get_error_message(), $data );
        } else {
            wp_send_json_error( $comment->get_error_message() );
        }
    }

    $user = wp_get_current_user();
    
    // Set cookies for non-logged-in users if they agreed
    do_action( 'set_comment_cookies', $comment, $user );

    // Render the comment to return it
    $walker = new Hasht_Comment_Walker();
    ob_start();
    $walker->paged_walk( [ $comment ], 1, 1, 1, [
        'style'       => 'div',
        'short_ping'  => true,
        'avatar_size' => 36,
        'max_depth'   => 5,
    ] );
    $comment_html = ob_get_clean();

    wp_send_json_success( [
        'html' => $comment_html,
        'message' => __( 'دیدگاه شما با موفقیت ثبت شد.', 'namad-eghtesad' ),
        'parent' => $comment->comment_parent
    ] );
}
