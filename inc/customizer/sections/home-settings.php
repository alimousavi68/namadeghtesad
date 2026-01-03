<?php
$categories = get_categories(['hide_empty' => false]);
$cats_options = ['' => '-- همه دسته‌ها --'];
if (!is_wp_error($categories)) {
    foreach ($categories as $category) {
        $cats_options[$category->slug] = $category->name;
    }
}

$query_types = [
    'latest'   => 'آخرین مطالب (بدون محدودیت دسته)',
    'category' => 'بر اساس دسته‌بندی'
];

$post_type_choices = [
    'all'             => 'همه پست‌تایپ‌ها',
    'post'            => 'نوشته استاندارد',
    'aggregated_news' => 'خبر تجمیعی',
];

$settings = [
    'hasht_home_panel' => [
        'title'    => 'تنظیمات صفحه اصلی',
        'type'     => 'panel',
        'priority' => 30,
        'sections' => [
            
            // 1. Hero Section
            'hasht_home_hero_sec' => [
                'title' => 'بخش هیرو (Hero)',
                'fields' => [
                    'hasht_home_hero_post_type' => [
                        'label'   => 'نوع پست‌تایپ',
                        'type'    => 'select',
                        'choices' => $post_type_choices,
                        'default' => 'all',
                    ],
                    'hasht_home_hero_query_type' => [
                        'label'   => 'نوع کوئری',
                        'type'    => 'select',
                        'choices' => $query_types,
                        'default' => 'latest',
                    ],
                    'hasht_home_hero_cat' => [
                        'label'   => 'دسته‌بندی (اگر نوع روی دسته باشد)',
                        'type'    => 'select',
                        'choices' => $cats_options,
                        'default' => '',
                    ],
                    'hasht_home_hero_count' => [
                        'label'   => 'تعداد پست',
                        'type'    => 'number',
                        'default' => 5,
                    ],
                ]
            ],

            // 2. Latest News
            'hasht_home_latest_sec' => [
                'title' => 'بخش آخرین اخبار',
                'fields' => [
                    'hasht_home_latest_title' => [
                        'label'   => 'عنوان بخش',
                        'type'    => 'text',
                        'default' => 'جدیدترین اخبار',
                    ],
                    'hasht_home_latest_post_type' => [
                        'label'   => 'نوع پست‌تایپ',
                        'type'    => 'select',
                        'choices' => $post_type_choices,
                        'default' => 'all',
                    ],
                    'hasht_home_latest_query_type' => [
                        'label'   => 'نوع کوئری',
                        'type'    => 'select',
                        'choices' => $query_types,
                        'default' => 'latest',
                    ],
                    'hasht_home_latest_cat' => [
                        'label'   => 'دسته‌بندی (اگر نوع روی دسته باشد)',
                        'type'    => 'select',
                        'choices' => $cats_options,
                        'default' => '',
                    ],
                    'hasht_home_latest_count' => [
                        'label'   => 'تعداد پست',
                        'type'    => 'number',
                        'default' => 6,
                    ],
                    'hasht_home_latest_offset' => [
                        'label'       => 'تعداد نادیده گرفتن (Offset)',
                        'description' => 'برای جلوگیری از تکرار مطالب هیرو',
                        'type'        => 'number',
                        'default'     => 5,
                    ],
                ]
            ],

            // 3. Most Visited (اخبار داغ/پربازدید بر اساس تاریخ)
            'hasht_home_visited_sec' => [
                'title' => 'بخش پربازدیدترین',
                'fields' => [
                    'hasht_home_visited_title' => [
                        'label'   => 'عنوان بخش',
                        'type'    => 'text',
                        'default' => 'پربازدیدترین اخبار',
                    ],
                    'hasht_home_visited_post_type' => [
                        'label'   => 'نوع پست‌تایپ',
                        'type'    => 'select',
                        'choices' => $post_type_choices,
                        'default' => 'all',
                    ],
                    'hasht_home_visited_query_type' => [
                        'label'   => 'نوع کوئری',
                        'type'    => 'select',
                        'choices' => $query_types,
                        'default' => 'latest',
                    ],
                    'hasht_home_visited_cat' => [
                        'label'   => 'دسته‌بندی (اگر نوع روی دسته باشد)',
                        'type'    => 'select',
                        'choices' => $cats_options,
                        'default' => '',
                    ],
                    'hasht_home_visited_count' => [
                        'label'   => 'تعداد پست',
                        'type'    => 'number',
                        'default' => 6,
                    ],
                    'hasht_home_visited_offset' => [
                        'label'       => 'تعداد نادیده گرفتن (Offset)',
                        'description' => 'برای جلوگیری از تکرار مطالب هیرو',
                        'type'        => 'number',
                        'default'     => 5,
                    ],
                ]
            ],

            // 4. Topic Section (موضوعات ۶‌گانه)
            'hasht_home_topic_sec' => [
                'title' => 'بخش موضوعات (Tabs)',
                'fields' => []
            ],
        ]
    ]
];

// ایجاد فیلدها برای ۶ تاپیک به صورت داینامیک
for ($i = 1; $i <= 6; $i++) {
    $settings['hasht_home_panel']['sections']['hasht_home_topic_sec']['fields']["hasht_home_topic_{$i}_title"] = [
        'label'   => "عنوان تاپیک $i",
        'type'    => 'text',
        'default' => "موضوع $i",
    ];
    $settings['hasht_home_panel']['sections']['hasht_home_topic_sec']['fields']["hasht_home_topic_{$i}_post_type"] = [
        'label'   => "نوع پست‌تایپ تاپیک $i",
        'type'    => 'select',
        'choices' => $post_type_choices,
        'default' => 'all',
    ];
    $settings['hasht_home_panel']['sections']['hasht_home_topic_sec']['fields']["hasht_home_topic_{$i}_cat"] = [
        'label'   => "دسته‌بندی تاپیک $i",
        'type'    => 'select',
        'choices' => $cats_options,
        'default' => '',
    ];
}

return $settings;
