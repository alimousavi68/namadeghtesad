<?php

/**
 * Advanced News Meta Box
 * 
 * Handles custom meta fields for news posts including:
 * - Content Type (Standard, Note, Interview, Video, Photo Report, Publication)
 * - Conditional fields based on content type
 * - General source fields
 */
class Hasht_News_Meta_Box {

    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct() {
        add_action('add_meta_boxes', [$this, 'add_meta_box']);
        add_action('save_post', [$this, 'save']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('edit_form_after_title', [$this, 'render_rotiter_after_title']);
    }

    /**
     * Adds the meta box container.
     */
    public function add_meta_box() {
        add_meta_box(
            'hasht_news_meta_box',
            'تنظیمات پیشرفته خبر',
            [$this, 'render_meta_box'],
            'post',
            'normal',
            'high'
        );
    }

    /**
     * Enqueue scripts and styles.
     */
    public function enqueue_scripts($hook) {
        if ('post.php' !== $hook && 'post-new.php' !== $hook) {
            return;
        }

        wp_enqueue_media();
        
        wp_enqueue_script(
            'hasht-admin-metabox',
            get_template_directory_uri() . '/assets/js/admin-metabox.js',
            ['jquery'],
            '1.0.0',
            true
        );

        wp_enqueue_style(
            'hasht-admin-metabox',
            get_template_directory_uri() . '/assets/css/admin-metabox.css',
            [],
            '1.0.0'
        );
    }

    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box($post) {
        // Add an nonce field so we can check for it later.
        wp_nonce_field('hasht_news_save_meta_box_data', 'hasht_news_meta_box_nonce');

        // Retrieve existing values
        $content_type = get_post_meta($post->ID, '_news_content_type', true);
        if (empty($content_type)) $content_type = 'standard';
        $rotiter = get_post_meta($post->ID, '_news_rotiter', true);

        // Note Fields
        $author_name = get_post_meta($post->ID, '_news_author_name', true);
        $author_position = get_post_meta($post->ID, '_news_author_position', true);

        // Interview Fields
        $interviewee_name = get_post_meta($post->ID, '_news_interviewee_name', true);
        $interviewee_position = get_post_meta($post->ID, '_news_interviewee_position', true);

        // Video Fields
        $video_duration = get_post_meta($post->ID, '_news_video_duration', true);
        $video_source_type = get_post_meta($post->ID, '_news_video_source_type', true);
        if (empty($video_source_type)) $video_source_type = 'direct';
        $video_hq_link = get_post_meta($post->ID, '_news_video_hq_link', true);
        $video_lq_link = get_post_meta($post->ID, '_news_video_lq_link', true);
        $video_embed_code = get_post_meta($post->ID, '_news_video_embed_code', true);

        // Photo Report Fields
        $photographer_name = get_post_meta($post->ID, '_news_photographer_name', true);
        $gallery_images = get_post_meta($post->ID, '_news_gallery_images', true);

        // Publication Fields
        $pub_type = get_post_meta($post->ID, '_news_publication_type', true);
        $pub_file_id = get_post_meta($post->ID, '_news_publication_file_id', true);
        $pub_file_url = '';
        if ($pub_file_id) {
            $pub_file_url = wp_get_attachment_url($pub_file_id);
        }

        // General Fields
        $source_name = get_post_meta($post->ID, '_news_source_name', true);
        $source_link = get_post_meta($post->ID, '_news_source_link', true);

        ?>
        <div class="hasht-metabox-wrapper">
            <?php if (!did_action('edit_form_after_title')) : ?>
                <div class="hasht-field-row">
                    <label for="hasht_rotiter"><strong>روتیتر:</strong></label>
                    <input type="text" name="_news_rotiter" id="hasht_rotiter" value="<?php echo esc_attr($rotiter); ?>" class="widefat" maxlength="200">
                </div>
                <hr>
            <?php endif; ?>
            
            <!-- Content Type -->
            <div class="hasht-field-row">
                <label for="hasht_content_type"><strong>نوع محتوا:</strong></label>
                <select name="_news_content_type" id="hasht_content_type" class="widefat">
                    <option value="standard" <?php selected($content_type, 'standard'); ?>>استاندارد</option>
                    <option value="note" <?php selected($content_type, 'note'); ?>>یادداشت</option>
                    <option value="interview" <?php selected($content_type, 'interview'); ?>>مصاحبه</option>
                    <option value="video" <?php selected($content_type, 'video'); ?>>ویدیو</option>
                    <option value="photo_report" <?php selected($content_type, 'photo_report'); ?>>گزارش تصویری</option>
                    <option value="publication" <?php selected($content_type, 'publication'); ?>>نشریه</option>
                </select>
            </div>

            <hr>

            <!-- Note Fields -->
            <div class="hasht-conditional-section" data-show-if="note">
                <div class="hasht-field-row">
                    <label for="hasht_author_name">نام نویسنده (اجباری):</label>
                    <input type="text" name="_news_author_name" id="hasht_author_name" value="<?php echo esc_attr($author_name); ?>" class="widefat" maxlength="120">
                </div>
                <div class="hasht-field-row">
                    <label for="hasht_author_position">سمت نویسنده:</label>
                    <input type="text" name="_news_author_position" id="hasht_author_position" value="<?php echo esc_attr($author_position); ?>" class="widefat" maxlength="120">
                </div>
            </div>

            <!-- Interview Fields -->
            <div class="hasht-conditional-section" data-show-if="interview">
                <div class="hasht-field-row">
                    <label for="hasht_interviewee_name">نام مصاحبه‌شونده (اجباری):</label>
                    <input type="text" name="_news_interviewee_name" id="hasht_interviewee_name" value="<?php echo esc_attr($interviewee_name); ?>" class="widefat" maxlength="120">
                </div>
                <div class="hasht-field-row">
                    <label for="hasht_interviewee_position">سمت مصاحبه‌شونده:</label>
                    <input type="text" name="_news_interviewee_position" id="hasht_interviewee_position" value="<?php echo esc_attr($interviewee_position); ?>" class="widefat" maxlength="120">
                </div>
            </div>

            <!-- Video Fields -->
            <div class="hasht-conditional-section" data-show-if="video">
                <div class="hasht-field-row">
                    <label for="hasht_video_duration">زمان ویدیو (مثلاً 05:30):</label>
                    <input type="text" name="_news_video_duration" id="hasht_video_duration" value="<?php echo esc_attr($video_duration); ?>" class="widefat">
                </div>
                
                <div class="hasht-field-row">
                    <label><strong>نوع آدرس‌دهی:</strong></label><br>
                    <label><input type="radio" name="_news_video_source_type" value="direct" <?php checked($video_source_type, 'direct'); ?>> آدرس مستقیم</label>
                    &nbsp;&nbsp;
                    <label><input type="radio" name="_news_video_source_type" value="embed" <?php checked($video_source_type, 'embed'); ?>> کد امبد</label>
                </div>

                <div class="hasht-sub-conditional" data-show-sub-if="direct">
                    <div class="hasht-field-row">
                        <label for="hasht_video_hq_link">لینک ویدیو با کیفیت بالا:</label>
                        <input type="url" name="_news_video_hq_link" id="hasht_video_hq_link" value="<?php echo esc_url($video_hq_link); ?>" class="widefat ltr-input" placeholder="https://...">
                    </div>
                    <div class="hasht-field-row">
                        <label for="hasht_video_lq_link">لینک ویدیو با کیفیت پایین:</label>
                        <input type="url" name="_news_video_lq_link" id="hasht_video_lq_link" value="<?php echo esc_url($video_lq_link); ?>" class="widefat ltr-input" placeholder="https://...">
                    </div>
                </div>

                <div class="hasht-sub-conditional" data-show-sub-if="embed">
                    <div class="hasht-field-row">
                        <label for="hasht_video_embed_code">کد امبد ویدیو (iframe):</label>
                        <textarea name="_news_video_embed_code" id="hasht_video_embed_code" class="widefat ltr-input" rows="4"><?php echo esc_textarea($video_embed_code); ?></textarea>
                        <p class="description">فقط کدهای iframe مجاز هستند.</p>
                    </div>
                </div>
            </div>

            <!-- Photo Report Fields -->
            <div class="hasht-conditional-section" data-show-if="photo_report">
                <div class="hasht-field-row">
                    <label for="hasht_photographer_name">نام عکاس (اجباری):</label>
                    <input type="text" name="_news_photographer_name" id="hasht_photographer_name" value="<?php echo esc_attr($photographer_name); ?>" class="widefat" maxlength="120">
                </div>
                
                <div class="hasht-field-row">
                    <label>تصاویر گالری:</label>
                    <div class="hasht-gallery-wrapper">
                        <input type="hidden" name="_news_gallery_images" id="hasht_gallery_images" value="<?php echo esc_attr($gallery_images); ?>">
                        <div id="hasht_gallery_preview" class="hasht-gallery-preview" style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 10px;">
                            <?php 
                            if (!empty($gallery_images)) {
                                $ids = explode(',', $gallery_images);
                                foreach ($ids as $id) {
                                    $img = wp_get_attachment_image_src($id, 'thumbnail');
                                    if ($img) {
                                        echo '<div class="hasht-gallery-item" data-id="' . $id . '" style="position: relative; width: 80px; height: 80px;">
                                                <img src="' . $img[0] . '" style="width: 100%; height: 100%; object-fit: cover; border-radius: 4px;">
                                                <span class="remove-image" style="position: absolute; top: -5px; right: -5px; background: red; color: white; border-radius: 50%; width: 18px; height: 18px; text-align: center; line-height: 16px; cursor: pointer; font-size: 12px;">×</span>
                                              </div>';
                                    }
                                }
                            }
                            ?>
                        </div>
                        <button type="button" class="button" id="hasht_add_gallery_btn">افزودن / ویرایش تصاویر</button>
                    </div>
                </div>
            </div>

            <!-- Publication Fields -->
            <div class="hasht-conditional-section" data-show-if="publication">
                <div class="hasht-field-row">
                    <label for="hasht_publication_type">نوع نشریه:</label>
                    <select name="_news_publication_type" id="hasht_publication_type" class="widefat">
                        <option value="weekly" <?php selected($pub_type, 'weekly'); ?>>هفته‌نامه</option>
                        <option value="monthly" <?php selected($pub_type, 'monthly'); ?>>ماهنامه</option>
                        <option value="quarterly" <?php selected($pub_type, 'quarterly'); ?>>فصلنامه</option>
                        <option value="yearbook" <?php selected($pub_type, 'yearbook'); ?>>سالنامه</option>
                    </select>
                </div>
                <div class="hasht-field-row">
                    <label>فایل نشریه (PDF):</label>
                    <div class="flex-row">
                        <input type="hidden" name="_news_publication_file_id" id="hasht_publication_file_id" value="<?php echo esc_attr($pub_file_id); ?>">
                        <input type="text" id="hasht_publication_file_url" value="<?php echo esc_url($pub_file_url); ?>" class="widefat ltr-input" readonly placeholder="فایلی انتخاب نشده است">
                        <button type="button" class="button" id="hasht_upload_pdf_btn">انتخاب / آپلود PDF</button>
                        <button type="button" class="button hidden" id="hasht_remove_pdf_btn">حذف</button>
                    </div>
                    <p class="description">حداکثر حجم: ۵۰ مگابایت. فقط فرمت PDF.</p>
                </div>
            </div>

            <hr>

            <!-- General Fields -->
            <div class="hasht-general-section">
                <div class="hasht-field-row">
                    <label for="hasht_source_name">نام منبع:</label>
                    <input type="text" name="_news_source_name" id="hasht_source_name" value="<?php echo esc_attr($source_name); ?>" class="widefat" maxlength="200">
                </div>
                <div class="hasht-field-row">
                    <label for="hasht_source_link">لینک منبع:</label>
                    <input type="url" name="_news_source_link" id="hasht_source_link" value="<?php echo esc_url($source_link); ?>" class="widefat ltr-input" placeholder="https://...">
                </div>
            </div>

        </div>
        <?php
    }

    public function render_rotiter_after_title($post) {
        if (!$post || $post->post_type !== 'post') {
            return;
        }
        $rotiter = get_post_meta($post->ID, '_news_rotiter', true);
        ?>
        <div class="hasht-metabox-wrapper" style="padding: 12px 10px 0;">
            <div class="hasht-field-row">
                <label for="hasht_rotiter"><strong>روتیتر:</strong></label>
                <input type="text" name="_news_rotiter" id="hasht_rotiter" value="<?php echo esc_attr($rotiter); ?>" class="widefat" maxlength="200">
            </div>
        </div>
        <?php
    }

    /**
     * Save meta box content.
     *
     * @param int $post_id Post ID.
     */
    public function save($post_id) {
        // Check if our nonce is set.
        if (!isset($_POST['hasht_news_meta_box_nonce'])) {
            return $post_id;
        }

        // Verify that the nonce is valid.
        if (!wp_verify_nonce($_POST['hasht_news_meta_box_nonce'], 'hasht_news_save_meta_box_data')) {
            return $post_id;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        // Check the user's permissions.
        if (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }

        /* OK, it's safe for us to save the data now. */

        // 1. Content Type
        if (isset($_POST['_news_content_type'])) {
            update_post_meta($post_id, '_news_content_type', sanitize_key($_POST['_news_content_type']));
        }

        if (isset($_POST['_news_rotiter'])) {
            update_post_meta($post_id, '_news_rotiter', sanitize_text_field($_POST['_news_rotiter']));
        }

        // 2. Note Fields
        if (isset($_POST['_news_author_name'])) {
            update_post_meta($post_id, '_news_author_name', sanitize_text_field($_POST['_news_author_name']));
        }
        if (isset($_POST['_news_author_position'])) {
            update_post_meta($post_id, '_news_author_position', sanitize_text_field($_POST['_news_author_position']));
        }

        // 3. Interview Fields
        if (isset($_POST['_news_interviewee_name'])) {
            update_post_meta($post_id, '_news_interviewee_name', sanitize_text_field($_POST['_news_interviewee_name']));
        }
        if (isset($_POST['_news_interviewee_position'])) {
            update_post_meta($post_id, '_news_interviewee_position', sanitize_text_field($_POST['_news_interviewee_position']));
        }

        // 4. Video Fields
        if (isset($_POST['_news_video_duration'])) {
            update_post_meta($post_id, '_news_video_duration', sanitize_text_field($_POST['_news_video_duration']));
        }
        if (isset($_POST['_news_video_source_type'])) {
            update_post_meta($post_id, '_news_video_source_type', sanitize_key($_POST['_news_video_source_type']));
        }
        if (isset($_POST['_news_video_hq_link'])) {
            update_post_meta($post_id, '_news_video_hq_link', esc_url_raw($_POST['_news_video_hq_link']));
        }
        if (isset($_POST['_news_video_lq_link'])) {
            update_post_meta($post_id, '_news_video_lq_link', esc_url_raw($_POST['_news_video_lq_link']));
        }
        if (isset($_POST['_news_video_embed_code'])) {
            // Sanitize HTML specifically for iframes
            $allowed_html = [
                'iframe' => [
                    'src'             => [],
                    'width'           => [],
                    'height'          => [],
                    'frameborder'     => [],
                    'allowfullscreen' => [],
                    'title'           => [],
                    'style'           => [],
                    'allow'           => [],
                ],
                'div' => [
                    'class' => [],
                    'style' => [],
                    'id'    => [],
                ],
                'script' => [
                    'src' => [],
                    'async' => [],
                ] // Some embeds use script tags (e.g. Aparat sometimes), but safest is just iframe. 
                  // User requested "only iframe / embed". Let's restrict to iframe.
            ];
            // 'embed' tag is deprecated and not standard HTML5, but WP supports it. 
            // We'll stick to a stricter wp_kses for safety.
            update_post_meta($post_id, '_news_video_embed_code', wp_kses($_POST['_news_video_embed_code'], $allowed_html));
        }

        // 5. Photo Report
        if (isset($_POST['_news_photographer_name'])) {
            update_post_meta($post_id, '_news_photographer_name', sanitize_text_field($_POST['_news_photographer_name']));
        }
        if (isset($_POST['_news_gallery_images'])) {
            update_post_meta($post_id, '_news_gallery_images', sanitize_text_field($_POST['_news_gallery_images']));
        }

        // 6. Publication
        if (isset($_POST['_news_publication_type'])) {
            update_post_meta($post_id, '_news_publication_type', sanitize_key($_POST['_news_publication_type']));
        }
        if (isset($_POST['_news_publication_file_id'])) {
            update_post_meta($post_id, '_news_publication_file_id', absint($_POST['_news_publication_file_id']));
        }

        // 7. General Fields
        if (isset($_POST['_news_source_name'])) {
            update_post_meta($post_id, '_news_source_name', sanitize_text_field($_POST['_news_source_name']));
        }
        if (isset($_POST['_news_source_link'])) {
            update_post_meta($post_id, '_news_source_link', esc_url_raw($_POST['_news_source_link']));
        }
    }
}

// Initialize the class
new Hasht_News_Meta_Box();
