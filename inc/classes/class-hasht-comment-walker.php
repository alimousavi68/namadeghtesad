<?php
/**
 * Custom Comment Walker
 *
 * @package NamadEghtesad
 */

class Hasht_Comment_Walker extends Walker_Comment {

    /**
     * Starts the list before the elements are added.
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param int    $depth  Depth of the current comment.
     * @param array  $args   An array of arguments.
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1;

        // Add Tailwind classes for indentation and border
        // Darkened border-slate-100 -> border-slate-300 was too harsh.
        // Using border-slate-200 for a softer, pastel-like look.
        $output .= '<div class="children pr-4 md:pr-12 border-r-2 border-slate-200 dark:border-slate-700 mt-6 space-y-6">' . "\n";
    }

    /**
     * Ends the list of items after the elements are added.
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param int    $depth  Depth of the current comment.
     * @param array  $args   An array of arguments.
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1;

        $output .= "</div><!-- .children -->\n";
    }

    /**
     * Output a comment in the XHTML format.
     *
     * @param WP_Comment $comment Comment to display.
     * @param int        $depth   Depth of the current comment.
     * @param array      $args    An array of arguments.
     */
    protected function comment( $comment, $depth, $args ) {
        $this->html5_comment( $comment, $depth, $args );
    }

    /**
     * Output a comment in the HTML5 format.
     *
     * @param WP_Comment $comment Comment to display.
     * @param int        $depth   Depth of the current comment.
     * @param array      $args    An array of arguments.
     */
    protected function html5_comment( $comment, $depth, $args ) {
        $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
        
        $commenter = wp_get_current_commenter();
        if ( $commenter['comment_author_email'] ) {
            $moderation_note = __( 'دیدگاه شما در انتظار بررسی است.', 'namad-eghtesad' );
        } else {
            $moderation_note = __( 'دیدگاه شما در انتظار بررسی است.', 'namad-eghtesad' );
        }

        ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
            
            <article id="div-comment-<?php comment_ID(); ?>" class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-5 mb-4 relative transition-all hover:shadow-sm">
                
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-3">
                        <!-- Avatar -->
                        <div class="w-9 h-9 rounded-full overflow-hidden shrink-0 bg-slate-100 dark:bg-slate-800">
                            <?php 
                            if ( 0 != $args['avatar_size'] ) {
                                echo get_avatar( $comment, $args['avatar_size'], '', '', ['class' => 'w-full h-full object-cover'] );
                            }
                            ?>
                        </div>
                        
                        <!-- Author & Meta -->
                        <div>
                            <h5 class="text-sm font-bold text-slate-800 dark:text-slate-200">
                                <?php echo get_comment_author_link( $comment ); ?>
                            </h5>
                            <span class="text-[10px] text-slate-400">
                                <?php 
                                    printf(
                                        /* translators: 1: date, 2: time */
                                        esc_html__( '%1$s در %2$s', 'namad-eghtesad' ),
                                        get_comment_date(),
                                        get_comment_time()
                                    ); 
                                ?>
                            </span>
                        </div>
                    </div>

                    <!-- Reply Button -->
                    <?php
                    // Customized Reply Link
                    comment_reply_link(
                        array_merge(
                            $args,
                            array(
                                'add_below' => 'div-comment',
                                'depth'     => $depth,
                                'max_depth' => $args['max_depth'],
                                'before'    => '',
                                'after'     => '',
                                // Use a specific structure for the text and icon
                                'reply_text' => '<span class="text-[11px] font-medium pt-0.5">پاسخ</span> <i data-lucide="corner-down-left" width="14" class="stroke-[1.5] transition-transform group-hover:-translate-x-0.5"></i>',
                                // Apply specific classes for styling
                                'class'      => 'group flex items-center gap-1.5 text-slate-400 hover:text-primary transition-all duration-200 comment-reply-link ml-1 opacity-80 hover:opacity-100',
                            )
                        )
                    );
                    ?>
                </div>

                <!-- Comment Content -->
                <div class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed text-justify pl-0 md:pl-4">
                    <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="text-amber-500 text-xs mb-2 italic"><?php echo $moderation_note; ?></p>
                    <?php endif; ?>

                    <?php comment_text(); ?>
                </div>

            </article>
        <?php
    }
}
