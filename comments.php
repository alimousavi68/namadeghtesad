<?php
/**
 * The template for displaying comments
 *
 * @package NamadEghtesad
 */

if ( post_password_required() ) {
    return;
}
?>

<section id="comments" class="mt-12 print:hidden relative">
    
    <!-- Separator -->
    <div class="w-full h-px bg-slate-200 dark:bg-slate-700 mb-12"></div>

    <div class="flex items-center gap-3 mb-6">
        <div class="w-1.5 h-8 flex flex-col  rounded-full overflow-hidden shrink-0">
            <div class="h-1/3 bg-slate-400"></div>
            <div class="h-2/3 bg-primary"></div>
        </div>
        <h3 class="text-xl font-black text-slate-800 dark:text-white">
            <?php
            $comment_count = get_comments_number();
            if ( '1' === $comment_count ) {
                echo '۱ دیدگاه';
            } else {
                echo number_format_i18n( $comment_count ) . ' دیدگاه';
            }
            ?>
        </h3>
    </div>

    <!-- Comment Form -->
    <?php if ( comments_open() ) : ?>
        <div id="respond" class="bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 mb-8 relative transition-all">
            
            <form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="commentform" class="relative">
                
                <!-- Logged in as... -->
                <?php if ( is_user_logged_in() ) : 
                    $current_user = wp_get_current_user();
                ?>
                    <div class="mb-3 text-xs text-slate-500 dark:text-slate-400 flex items-center justify-between">
                        <span>وارد شده با نام <span class="font-bold text-slate-800 dark:text-slate-200"><?php echo esc_html( $current_user->display_name ); ?></span></span>
                        <a href="<?php echo wp_logout_url( get_permalink() ); ?>" class="text-rose-500 hover:underline">خروج</a>
                    </div>
                <?php endif; ?>

                <!-- Top Row: Textarea + Send Button -->
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center shrink-0 overflow-hidden">
                        <?php 
                        if ( is_user_logged_in() ) {
                            echo get_avatar( get_current_user_id(), 40, '', 'Avatar', ['class' => 'w-full h-full object-cover'] );
                        } else {
                            echo '<i data-lucide="user" class="text-slate-400" width="20"></i>';
                        }
                        ?>
                    </div>
                    
                    <div class="flex-1">
                        
                        <!-- Reply Indicator -->
                        <div id="reply-indicator" class="hidden items-center justify-between mb-2 bg-slate-100 dark:bg-slate-800 px-3 py-1.5 rounded-lg text-xs">
                            <span class="text-slate-600 dark:text-slate-300">
                                در حال پاسخ به: <strong id="reply-to-name" class="text-primary"></strong>
                            </span>
                            <button type="button" id="cancel-reply-btn" class="text-rose-500 hover:text-rose-700 flex items-center gap-1">
                                <i data-lucide="x" width="14"></i>
                                لغو
                            </button>
                        </div>

                        <textarea
                            id="comment"
                            name="comment"
                            rows="1"
                            placeholder="دیدگاه خود را بنویسید..."
                            class="w-full px-4 py-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:outline-none focus:border-primary dark:focus:border-primary transition-all text-sm resize-none overflow-hidden min-h-[44px]"
                            required></textarea>

                        <!-- Hidden Fields (Toggle on focus) -->
                        <?php if ( ! is_user_logged_in() ) : ?>
                            <div id="comment-details" class="hidden mt-3 grid grid-cols-1 md:grid-cols-2 gap-3 animate-fade-in origin-top">
                                <input 
                                    type="text" 
                                    name="author" 
                                    id="author"
                                    placeholder="نام و نام خانوادگی (الزامی)" 
                                    class="w-full px-4 py-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:outline-none focus:border-primary dark:focus:border-primary transition-colors text-sm"
                                    required
                                >
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email"
                                    placeholder="ایمیل (نمایش داده نمی‌شود) (الزامی)" 
                                    class="w-full px-4 py-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:outline-none focus:border-primary dark:focus:border-primary transition-colors text-sm"
                                    required
                                >
                            </div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" id="submit" class="shrink-0 bg-primary hover:bg-rose-700 text-white w-11 h-11 rounded-xl flex items-center justify-center transition-all shadow-md hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed group">
                        <i data-lucide="send" width="18" class="group-hover:-translate-y-0.5 group-hover:translate-x-0.5 transition-transform"></i>
                        <span class="hidden loading-spinner w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
                    </button>
                </div>

                <!-- Messages -->
                <div id="comment-message" class="mt-3 text-xs font-bold hidden"></div>

                <?php 
                comment_id_fields(); 
                do_action( 'comment_form', $post->ID );
                ?>
            </form>
        </div>
    <?php else : ?>
        <p class="text-slate-500 text-sm mb-8">دیدگاه‌ها برای این مطلب بسته شده‌اند.</p>
    <?php endif; ?>

    <!-- Comments List -->
    <?php if ( have_comments() ) : ?>
        <div class="space-y-6 comment-list-container">
            <?php
            wp_list_comments( array(
                'style'       => 'div',
                'short_ping'  => true,
                'avatar_size' => 36,
                'walker'      => new Hasht_Comment_Walker(),
                'max_depth'   => 5, // Nested levels
            ) );
            ?>
        </div>

        <?php
        // Comment Pagination
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
        ?>
        <nav class="navigation comment-navigation mt-8 flex justify-between text-sm font-bold text-primary" role="navigation">
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; دیدگاه‌های قدیمی‌تر', 'namad-eghtesad' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'دیدگاه‌های جدیدتر &rarr;', 'namad-eghtesad' ) ); ?></div>
        </nav>
        <?php endif; ?>

    <?php endif; ?>

</section>
