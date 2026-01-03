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

    // Data Source: Real news titles and images
    $data = [
        'technology' => [
            'name' => 'فناوری',
            'posts' => [
                [
                    'title' => 'هوش مصنوعی گوگل جمنای پرو ۱.۵ رونمایی شد؛ رقیب سرسخت GPT-4',
                    'img' => 'https://cdn.zoomit.ir/2024/02/google-gemini-1-5-pro-cover.jpg',
                ],
                [
                    'title' => 'سامسونگ گلکسی S24 اولترا بررسی شد: پادشاه جدید اندروید؟',
                    'img' => 'https://cdn.zoomit.ir/2024/01/samsung-galaxy-s24-ultra-review-cover.jpg',
                ],
                [
                    'title' => 'مایکروسافت ویندوز ۱۲ را با تمرکز بر هوش مصنوعی منتشر می‌کند',
                    'img' => 'https://cdn.zoomit.ir/2023/12/windows-12-ai-cover.jpg',
                ],
                [
                    'title' => 'اپل ویژن پرو وارد بازار شد؛ انقلابی در دنیای واقعیت ترکیبی',
                    'img' => 'https://cdn.zoomit.ir/2024/02/apple-vision-pro-review-cover.jpg',
                ],
            ]
        ],
        'sport' => [
            'name' => 'ورزش',
            'posts' => [
                [
                    'title' => 'پرسپولیس قهرمان نیم‌فصل لیگ برتر شد',
                    'img' => 'https://newsmedia.tasnimnews.com/Tasnim/Uploaded/Image/1402/10/14/140210141947573429158374.jpg',
                ],
                [
                    'title' => 'لیست نهایی تیم ملی برای جام ملت‌های آسیا اعلام شد',
                    'img' => 'https://cdn.isna.ir/d/2023/12/31/3/62804576.jpg',
                ],
                [
                    'title' => 'کریستیانو رونالدو بهترین گلزن سال ۲۰۲۳ جهان شد',
                    'img' => 'https://cdn.isna.ir/d/2023/12/27/3/62801234.jpg',
                ],
                [
                    'title' => 'استقلال با نکونام به صدر جدول بازگشت',
                    'img' => 'https://newsmedia.tasnimnews.com/Tasnim/Uploaded/Image/1402/09/23/140209231735431622896584.jpg',
                ],
            ]
        ],
        'cinema' => [
            'name' => 'سینما',
            'posts' => [
                [
                    'title' => 'فیلم "اوپنهایمر" جوایز اسکار را درو کرد',
                    'img' => 'https://cdn.zoomg.ir/2023/7/oppenheimer-movie-review-cover.jpg',
                ],
                [
                    'title' => 'نقد و بررسی فیلم "قاتلان ماه گل"؛ شاهکار جدید اسکورسیزی',
                    'img' => 'https://cdn.zoomg.ir/2023/10/killers-of-the-flower-moon-movie-review-cover.jpg',
                ],
                [
                    'title' => 'فصل دوم سریال "زخم کاری" رکورد بازدید را شکست',
                    'img' => 'https://cinematicket.org/v1/image/6530f0a0d9e5b.jpg',
                ],
                [
                    'title' => 'پوستر رسمی جشنواره فیلم فجر رونمایی شد',
                    'img' => 'https://cdn.isna.ir/d/2024/01/20/3/62820543.jpg',
                ],
            ]
        ],
         'economy' => [
            'name' => 'اقتصاد',
            'posts' => [
                ['title' => 'قیمت دلار و طلا در بازار امروز کاهش یافت', 'img' => 'https://cdn.isna.ir/d/2023/05/01/3/62601234.jpg'],
                ['title' => 'بورس تهران سبزپوش شد؛ شاخص کل بالا رفت', 'img' => 'https://cdn.isna.ir/d/2023/06/10/3/62654321.jpg'],
                ['title' => 'شرایط جدید ثبت‌نام خودروهای وارداتی اعلام شد', 'img' => 'https://cdn.isna.ir/d/2023/08/15/3/62709876.jpg'],
                ['title' => 'افزایش حقوق کارمندان در بودجه سال آینده تصویب شد', 'img' => 'https://cdn.isna.ir/d/2023/11/20/3/62765432.jpg'],
            ]
        ],
        'health' => [
            'name' => 'سلامت',
            'posts' => [
                ['title' => 'تاثیر ورزش روزانه بر کاهش استرس و اضطراب', 'img' => 'https://cdn.isna.ir/d/2023/04/10/3/62554321.jpg'],
                ['title' => 'خواص شگفت‌انگیز چای سبز برای سلامتی', 'img' => 'https://cdn.isna.ir/d/2023/05/20/3/62612345.jpg'],
                ['title' => 'چگونه خواب بهتری داشته باشیم؟ ۱۰ راهکار علمی', 'img' => 'https://cdn.isna.ir/d/2023/06/30/3/62698765.jpg'],
                ['title' => 'علائم کمبود ویتامین D را جدی بگیرید', 'img' => 'https://cdn.isna.ir/d/2023/07/15/3/62745678.jpg'],
            ]
        ],
        'tourism' => [
            'name' => 'گردشگری',
            'posts' => [
                ['title' => 'جاذبه‌های گردشگری ناشناخته ایران را بشناسید', 'img' => 'https://cdn.isna.ir/d/2023/03/10/3/62498765.jpg'],
                ['title' => 'راهنمای سفر ارزان به استانبول', 'img' => 'https://cdn.isna.ir/d/2023/04/05/3/62543210.jpg'],
                ['title' => 'بهترین زمان سفر به جزیره کیش', 'img' => 'https://cdn.isna.ir/d/2023/05/12/3/62609876.jpg'],
                ['title' => 'روستای ماسوله؛ نگین گردشگری گیلان', 'img' => 'https://cdn.isna.ir/d/2023/06/25/3/62687654.jpg'],
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
            if ($exist) {
                echo "<p style='color:orange'>پست موجود است: {$post_info['title']}</p>";
                continue;
            }

            $post_data = [
                'post_title'    => $post_info['title'],
                'post_content'  => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.',
                'post_status'   => 'publish',
                'post_author'   => get_current_user_id(),
                'post_category' => [$cat_id],
                'post_excerpt'  => 'خلاصه خبر: لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.',
            ];

            $post_id = wp_insert_post($post_data);

            if (!is_wp_error($post_id)) {
                echo "<p style='color:green'>پست ایجاد شد: {$post_info['title']}</p>";

                // 3. Upload and Attach Image
                if (!empty($post_info['img'])) {
                    echo "<span> ... در حال دانلود تصویر ... </span>";
                    $attach_id = hasht_sideload_image($post_info['img'], $post_id);
                    if ($attach_id) {
                        set_post_thumbnail($post_id, $attach_id);
                        echo "<span style='font-size:12px; color:blue; font-weight:bold;'> + تصویر شاخص ست شد</span>";
                    } else {
                         echo "<span style='font-size:12px; color:red; font-weight:bold;'> - خطا در دانلود تصویر</span>";
                    }
                }
            } else {
                 echo "<p style='color:red'>خطا در ایجاد پست</p>";
            }
        }
    }

    echo '<h3>عملیات پایان یافت! <a href="' . remove_query_arg('seed') . '">بازگشت به سایت</a></h3>';
    echo '</div>';
    exit;
}

// Helper to sideload image
function hasht_sideload_image($url, $post_id) {
    // Download file to temp
    $tmp = download_url($url);

    if (is_wp_error($tmp)) {
        return false;
    }

    $file_array = [
        'name' => basename($url),
        'tmp_name' => $tmp
    ];

    // Check for file extension, if missing, assume jpg (common with some cdns)
    if (!pathinfo($file_array['name'], PATHINFO_EXTENSION)) {
        $file_array['name'] .= '.jpg';
    }

    // Fix query string in filename if present
    $file_array['name'] = strtok($file_array['name'], '?');

    $id = media_handle_sideload($file_array, $post_id);

    if (is_wp_error($id)) {
        @unlink($file_array['tmp_name']);
        return false;
    }

    return $id;
}

add_action('init', 'hasht_run_seeder');