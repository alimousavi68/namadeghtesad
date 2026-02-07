<?php

function hasht_run_seeder() {
    // Security check
    if (!isset($_GET['seed']) || $_GET['seed'] !== 'true' || !current_user_can('manage_options')) {
        return;
    }

    // Required for image upload
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/image.php');

    echo '<div style="background:#fff; padding:20px; border:2px solid #000; position:relative; z-index:9999; direction:rtl; text-align:right; font-family:tahoma; line-height:1.6;">';
    echo '<h2>شروع عملیات تزریق محتوا...</h2>';

    $data = [
        'macro-economics' => [
            'name' => 'اقتصاد کلان',
            'posts' => [
                [
                    'title' => 'تحلیل جامع بودجه ۱۴۰۴: سناریوهای تورمی و رشد اقتصادی در سایه تحریم‌ها',
                    'img' => '1906636_306.jpg', 
                    'excerpt' => 'لایحه بودجه سال آینده در حالی به مجلس ارائه شده است که کارشناسان اقتصادی نظرات متفاوتی درباره میزان تحقق درآمدهای نفتی و مالیاتی آن دارند.',
                    'content' => 'این یک متن نمونه برای پست است.',
                    'meta' => [
                        '_featured' => 'yes' 
                    ]
                ],
                [
                    'title' => 'نوسانات جدید در بازار ارز؛ واکنش بازار به اخبار سیاسی اخیر چه بود؟',
                    'img' => '1906636_306.jpg',
                    'excerpt' => 'بازار ارز در هفته گذشته نوسانات زیادی را تجربه کرد.',
                ],
                [
                    'title' => 'تحول در صنعت خودرو؛ ورود برندهای جدید و کاهش قیمت‌های درب کارخانه',
                    'img' => 'saipa-5.jpg', 
                ],
                [
                    'title' => 'برداشت گندم در مزارع جنوبی کشور رکورد زد',
                    'img' => 'e8b41645-22c4-4888-a71f-08ee61bf44fc.jpeg',
                ],
                [
                    'title' => 'بهره‌برداری از فاز جدید پالایشگاه آبادان',
                    'img' => 'gold-05.jpg', 
                ],
                [
                    'title' => 'تسهیلات جدید دولت برای بافت فرسوده شهری',
                    'img' => 'apartoman.jpg', 
                ],
                [
                    'title' => 'رایزنی‌های اقتصادی ایران و کشورهای منطقه در تهران',
                    'img' => 'hoseini-hi.jpg', 
                ],
                [
                    'title' => 'برگزاری نمایشگاه بین‌المللی خودرو در اواخر بهمن',
                    'img' => 'samand.jpg', 
                ],
                 [
                    'title' => 'رشد اقتصادی ۸ درصدی در برنامه هفتم توسعه؛ رویا یا واقعیت؟',
                    'img' => 'bank-168.jpg',
                    'excerpt' => 'برنامه هفتم توسعه با هدف دستیابی به رشد اقتصادی ۸ درصدی تدوین شده است. اما کارشناسان نسبت به تحقق این هدف ابراز تردید می‌کنند.',
                ]
            ]
        ],
        'industry-mining' => [
            'name' => 'صنعت و معدن',
            'posts' => [
                [
                    'title' => 'شکست رکورد تولید فولاد در مجتمع‌های صنعتی کشور',
                    'img' => 'Steel-production-1.webp',
                ],
                [
                    'title' => 'اکتشاف پهنه‌های جدید معدنی در استان یزد',
                    'img' => 'servatmand-15.jpg',
                ],
                [
                    'title' => 'نوسازی ناوگان ماشین‌آلات سنگین معادن آغاز شد',
                    'img' => 'seif-4.jpg',
                ],
            ]
        ],
        'energy' => [
            'name' => 'انرژی',
            'posts' => [
                [
                    'title' => 'توافق جدید گازی ایران با همسایگان شمالی',
                    'img' => 'bit-usa.jpg',
                ],
                [
                    'title' => 'بهره‌برداری از بزرگترین مزرعه خورشیدی کشور',
                    'img' => 'bit-usa.jpg', 
                ],
                [
                    'title' => 'مدیریت مصرف برق صنایع در تابستان پیش‌رو',
                    'img' => 'trid-11.jpg', 
                ],
                 [
                    'title' => 'سرمایه‌گذاری خارجی در صنعت نفت و گاز افزایش یافت',
                    'img' => 'bours-18.jpg',
                    'excerpt' => 'وزیر نفت از امضای قراردادهای جدید با شرکت‌های خارجی خبر داد. این سرمایه‌گذاری‌ها می‌تواند ظرفیت تولید نفت ایران را افزایش دهد.',
                ]
            ]
        ],
        'society-economy' => [
            'name' => 'جامعه و اقتصاد',
            'posts' => [
                [
                    'title' => 'افزایش تولید نفت در حوزه‌های مشترک خلیج فارس',
                    'img' => 'gold-05.jpg',
                ],
                [
                    'title' => 'گزارش بانک مرکزی از وضعیت نقدینگی در پایان فصل',
                    'img' => 'trid-11.jpg',
                ],
                [
                    'title' => 'صادرات محصولات پتروشیمی ۱۵ درصد رشد داشت',
                    'img' => 'N82862417-72240196.jpg',
                ],
                 [
                    'title' => 'تاثیر نوسانات ارزی بر بازار مسکن؛ آیا زمان خرید فرا رسیده است؟',
                    'img' => 'apartoman.jpg',
                ],
                 [
                    'title' => 'جزئیات جدید از طرح مالیات بر عایدی سرمایه و طلا',
                    'img' => 'gold-05.jpg',
                ],
            ]
        ],
        'bank-insurance' => [
            'name' => 'بانک و بیمه',
            'posts' => [
                [
                    'title' => 'تحلیل جامع بودجه ۱۴۰۴: سناریوهای تورمی',
                    'img' => 'seifi-2-672x378.jpg',
                ],
                [
                    'title' => 'افزایش سرمایه بانک‌های دولتی در دستور کار',
                    'img' => '_DSC4590-03.jpg',
                ],
                [
                    'title' => 'نرخ سود بین بانکی کاهش یافت',
                    'img' => 'bank-168.jpg',
                ],
                [
                    'title' => 'تحلیل جامع سیاست‌های جدید بانک مرکزی؛ آیا نرخ سود تغییر می‌کند؟',
                    'img' => 'bank-168.jpg',
                    'excerpt' => 'رئیس کل بانک مرکزی در آخرین نشست خبری خود اشاراتی به تغییرات احتمالی در نرخ سود سپرده‌ها داشت.',
                ],
                [
                     'title' => 'افزایش نرخ سود سپرده‌های بانکی؛ موافقان و مخالفان چه می‌گویند؟',
                     'img' => 'bank-168.jpg',
                     'excerpt' => 'شورای پول و اعتبار در جلسه اخیر خود با افزایش نرخ سود سپرده‌ها موافقت کرد.',
                ],
                [
                    'title' => 'تاثیر نوسانات ارزی بر شرکت‌های بورسی؛ گزارش ویژه',
                    'img' => 'bank-168.jpg',
                    'excerpt' => 'بررسی صورت‌های مالی شرکت‌های صادرات‌محور نشان می‌دهد که افزایش نرخ ارز می‌تواند سودآوری این شرکت‌ها را در نیمه دوم سال به طرز چشمگیری افزایش دهد.',
                ]
            ]
        ],
        'bourse' => [
            'name' => 'بورس',
            'posts' => [
                [
                    'title' => 'بورس تهران دوباره سبز شد؛ گروه‌های بانکی پیشتاز',
                    'img' => 'bours-18.jpg',
                ],
                [
                    'title' => 'ثبت بیشترین حجم معاملات خرد در بورس تهران',
                    'img' => 'bours-26.jpg',
                ],
                [
                    'title' => 'عرضه اولیه جدید در راه است؛ سهامداران آماده باشند',
                    'img' => 'bours-11.jpg',
                    'excerpt' => 'شرکت سرمایه‌گذاری تامین اجتماعی از عرضه اولیه زیرمجموعه‌های خود خبر داد.',
                ],
                [
                    'title' => 'شاخص کل از مرز ۲ میلیون واحد گذشت',
                    'img' => 'bours-18.jpg',
                ],
                [
                    'title' => 'رشد ۵۰ هزار واحدی شاخص کل؛ ورود پول حقیقی به بازار سهام',
                    'img' => 'bours-18.jpg',
                    'excerpt' => 'بازار بورس تهران امروز شاهد یکی از بهترین روزهای خود در سال جاری بود.',
                ],
                 [
                    'title' => 'آینده بورس تهران در نیمه دوم سال چگونه خواهد بود؟',
                    'img' => 'bours-26.jpg',
                ],
                 [
                    'title' => 'سقوط آزاد بیت‌کوین؛ تحلیل تکنیکال روند بازار کریپتو',
                    'img' => 'bit-usa.jpg',
                ]
            ]
        ],
        'gold-currency' => [
            'name' => 'طلا و ارز',
            'posts' => [
                [
                    'title' => 'نوسانات جدید در بازار ارز',
                    'img' => 'gold-05.jpg',
                ],
                [
                    'title' => 'قیمت سکه به کانال جدید وارد شد',
                    'img' => 'trid-11.jpg',
                ],
                [
                    'title' => 'پیش‌بینی قیمت طلا در هفته آینده؛ آیا روند صعودی ادامه خواهد داشت؟',
                    'img' => 'bitcoin-gold20.jpg',
                    'excerpt' => 'انس جهانی طلا با کاهش ۲۰ دلاری مواجه شد.',
                ],
                 [
                    'title' => 'تحلیل تکنیکال دلار؛ مقاومت ۵۰ هزار تومانی شکسته می‌شود؟',
                    'img' => 'gold-05.jpg',
                    'excerpt' => 'بازار ارز در هفته گذشته نوسانات زیادی را تجربه کرد.',
                ]
            ]
        ],
        'automotive' => [
            'name' => 'خودرو',
            'posts' => [
                [
                    'title' => 'تحول در صنعت خودرو',
                    'img' => 'sahand-411x231.jpg',
                ],
                [
                    'title' => 'واردات خودروهای برقی سرعت گرفت',
                    'img' => 'samand.jpg',
                ],
                [
                    'title' => 'طرح جدید فروش ایران خودرو',
                    'img' => 'saipa-5.jpg',
                ],
                 [
                    'title' => 'جزئیات عرضه جدید خودرو در سامانه یکپارچه اعلام شد',
                    'img' => 'saipa-5.jpg',
                    'excerpt' => 'وزارت صمت در اطلاعیه‌ای شرایط جدید ثبت‌نام خودروهای داخلی و وارداتی را اعلام کرد.',
                ],
                 [
                    'title' => 'واردات خودروهای کارکرده؛ چالش‌ها و فرصت‌ها',
                    'img' => 'saipa-5.jpg',
                    'excerpt' => 'مجلس شورای اسلامی لایحه واردات خودروهای کارکرده را تصویب کرد.',
                ]
            ]
        ],
        'multimedia' => [
            'name' => 'چندرسانه‌ای',
            'posts' => [
                [
                    'title' => 'تحلیل جامع: نبض بازارهای سرمایه‌گذاری در نیمه دوم سال (قسمت ۱)',
                    'img' => '8424781_828.jpg',
                    'excerpt' => 'ویدیو تحلیل بازار',
                ],
                [
                    'title' => 'تحلیل جامع: نبض بازارهای سرمایه‌گذاری در نیمه دوم سال (قسمت ۲)',
                    'img' => '8418285_305.jpg',
                     'excerpt' => 'ویدیو تحلیل بازار',
                ],
                [
                    'title' => 'تحلیل جامع: نبض بازارهای سرمایه‌گذاری در نیمه دوم سال (قسمت ۳)',
                    'img' => 'IMG_0546-ak7532-ak7003-1200x800-1024x683.webp',
                     'excerpt' => 'ویدیو تحلیل بازار',
                ],
            ]
        ],
        'publications' => [
            'name' => 'نشریات',
            'posts' => [
                [
                    'title' => 'ویژه نامه صنعت خودروسازی',
                    'img' => '391-FelezatOnline-Final-scaled.jpg',
                    'excerpt' => 'بررسی آینده برقی‌سازی ناوگان حمل و نقل عمومی در ایران.',
                ],
                [
                    'title' => 'ماهنامه نماد اقتصاد - شماره ۴۲',
                    'img' => '392-FelezatOnline-Cover-scaled.jpg',
                    'excerpt' => 'پرونده ویژه: عبور از رکود تورمی.',
                ],
                [
                    'title' => 'فصلنامه بررسی‌های اقتصادی',
                    'img' => '393-Felezatonline-cover-V01-scaled.jpg',
                    'excerpt' => 'تحلیل دقیق شاخص‌های کلان اقتصادی.',
                ],
                [
                    'title' => 'سالنامه آماری اقتصاد ایران',
                    'img' => '394-FelezatOnline-Final-Cover-scaled.jpg',
                    'excerpt' => 'جامع‌ترین مرجع داده‌های اقتصادی ایران.',
                ],
            ]
        ],

         'companies' => [
            'name' => 'شرکت‌ها',
            'posts' => [
                 ['title' => 'ایران خودرو', 'img' => 'saipa-5.jpg'], 
                 ['title' => 'سایپا', 'img' => 'saipa-5.jpg'],
                 ['title' => 'بانک مرکزی', 'img' => 'bank-168.jpg'],
                 ['title' => 'نفت و گاز پارس', 'img' => 'gold-05.jpg'],
                 ['title' => 'فولاد مبارکه', 'img' => 'Steel-production-1.webp'],
                 ['title' => 'ذوب آهن', 'img' => 'Steel-production-1.webp'],
                 ['title' => 'مس کرمان', 'img' => 'servatmand-15.jpg'],
            ]
         ]
    ];

    foreach ($data as $slug => $info) {
        // 1. Create/Get Category
        $term = term_exists($slug, 'category');
        if (!$term) {
            $term = wp_insert_term($info['name'], 'category', ['slug' => $slug]);
            if (!is_wp_error($term)) {
                 $cat_id = $term['term_id'];
                 echo "<p>دسته ایجاد شد: <strong>{$info['name']}</strong></p>";
            } else {
                 echo "<p style='color:red'>خطا در ایجاد دسته {$info['name']}</p>";
                 continue;
            }
        } else {
            $cat_id = is_array($term) ? $term['term_id'] : $term;
            echo "<p>دسته موجود است: <strong>{$info['name']}</strong></p>";
        }

        // 2. Create Posts
        foreach ($info['posts'] as $post_info) {
            // Check existence
            $exist = get_page_by_title($post_info['title'], OBJECT, 'post');
            
            $post_id = 0;
            
            if ($exist) {
                echo "<p style='color:orange'>پست موجود است: {$post_info['title']}</p>";
                $post_id = $exist->ID;
                // Ensure category
                wp_set_post_categories($post_id, [$cat_id], true);
            } else {
                $post_data = [
                    'post_title'    => $post_info['title'],
                    'post_content'  => isset($post_info['content']) ? $post_info['content'] : 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.',
                    'post_status'   => 'publish',
                    'post_author'   => get_current_user_id(),
                    'post_category' => [$cat_id],
                    'post_excerpt'  => isset($post_info['excerpt']) ? $post_info['excerpt'] : 'خلاصه خبر: لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.',
                ];

                $post_id = wp_insert_post($post_data);

                if (!is_wp_error($post_id)) {
                    echo "<p style='color:green'>پست ایجاد شد: {$post_info['title']}</p>";
                } else {
                     echo "<p style='color:red'>خطا در ایجاد پست</p>";
                     continue;
                }
            }

            // 3. Handle Meta
            if (isset($post_info['meta']) && $post_id) {
                foreach ($post_info['meta'] as $key => $value) {
                    update_post_meta($post_id, $key, $value);
                }
            }

            // 4. Upload and Attach Image (Local)
            if (!empty($post_info['img']) && $post_id) {
                if (!has_post_thumbnail($post_id)) {
                    echo "<span> ... در حال اتصال تصویر ... </span>";
                    $attach_id = hasht_import_local_image($post_info['img'], $post_id);
                    if ($attach_id) {
                        set_post_thumbnail($post_id, $attach_id);
                        echo "<span style='font-size:12px; color:blue; font-weight:bold;'> + تصویر شاخص ست شد</span>";
                    } else {
                         echo "<span style='font-size:12px; color:red; font-weight:bold;'> - تصویر یافت نشد یا خطا</span>";
                    }
                }
            }
        }
    }

    echo '<h3>عملیات پایان یافت! <a href="' . remove_query_arg('seed') . '">بازگشت به سایت</a></h3>';
    echo '</div>';
    exit;
}

// Helper to handle local image upload
function hasht_import_local_image($filename, $post_id) {
    if (empty($filename)) return false;

    // Possible locations in assets
    $assets_path = get_template_directory() . '/assets/images/';
    $file_path = $assets_path . $filename;

    if (!file_exists($file_path)) {
        return false;
    }

    // Check if already attached to avoid duplicates
    $args = array(
        'post_type' => 'attachment',
        'name' => sanitize_title(pathinfo($filename, PATHINFO_FILENAME)),
        'posts_per_page' => 1,
        'post_status' => 'inherit',
    );
    $_attachments = get_posts( $args );
    if ( $_attachments ) {
         return $_attachments[0]->ID;
    }

    // Copy to temp dir for media_handle_sideload
    $tmp = sys_get_temp_dir() . '/' . $filename;
    copy($file_path, $tmp);

    $file_array = array(
        'name'     => $filename,
        'tmp_name' => $tmp,
    );

    $id = media_handle_sideload($file_array, $post_id);

    if (is_wp_error($id)) {
        @unlink($file_array['tmp_name']);
        return false;
    }
    
    return $id;
}

add_action('init', 'hasht_run_seeder');
