<?php
/**
 * Home Settings Section
 * 
 * Defines the Customizer settings for the Home Page.
 */

// Fetch Categories for the dropdown
$categories = get_categories(['hide_empty' => false]);
$cats_options = ['' => '-- همه دسته‌ها --'];
if (!is_wp_error($categories)) {
    foreach ($categories as $category) {
        $cats_options[$category->slug] = $category->name;
    }
}

$settings = [
    'hasht_home_panel' => [
        'title'    => 'تنظیمات صفحه اصلی',
        'type'     => 'panel',
        'priority' => 30,
        'sections' => [
            
            // News Ticker Settings
            'hasht_home_ticker_sec' => [
                'title' => 'خبرخوان متحرک (News Ticker)',
                'fields' => [
                    'hasht_home_ticker_enable' => [
                        'label'   => 'فعال‌سازی خبرخوان',
                        'type'    => 'checkbox',
                        'default' => true,
                    ],
                    'hasht_home_ticker_title' => [
                        'label'   => 'عنوان خبرخوان',
                        'type'    => 'text',
                        'default' => 'اخبار فوری',
                    ],
                    'hasht_home_ticker_cat' => [
                        'label'   => 'دسته‌بندی مطالب',
                        'type'    => 'select',
                        'choices' => $cats_options,
                        'default' => '',
                    ],
                    'hasht_home_ticker_count' => [
                        'label'   => 'تعداد خبرها',
                        'type'    => 'number',
                        'default' => 5,
                    ],
                    'hasht_home_ticker_speed' => [
                        'label'   => 'سرعت حرکت (ثانیه)',
                        'description' => 'هرچه عدد بیشتر باشد، حرکت آهسته‌تر خواهد بود.',
                        'type'    => 'number',
                        'default' => 20,
                    ],
                ]
            ],

            // Hero Section Settings
            'hasht_home_hero_sec' => [
                'title' => 'بخش هیرو (Hero)',
                'fields' => [
                    'hasht_home_hero_cat' => [
                        'label'   => 'دسته‌بندی مطالب هیرو',
                        'description' => 'اگر خالی باشد، آخرین مطالب سایت نمایش داده می‌شود.',
                        'type'    => 'select',
                        'choices' => $cats_options,
                        'default' => '',
                    ],
                    'hasht_home_hero_count' => [
                        'label'   => 'تعداد پست',
                        'description' => 'تعداد پست‌های نمایش داده شده در بخش هیرو (پیش‌فرض: ۴)',
                        'type'    => 'number',
                        'default' => 4,
                    ],
                ]
            ],

            // Section 1: Dynamic Grid (ex: Macro Economics)
            'hasht_home_grid_sec' => [
                'title' => 'بخش شبکه‌ای ۱',
                'fields' => [
                    'hasht_home_grid_title' => [
                        'label'   => 'عنوان بخش',
                        'type'    => 'text',
                        'default' => 'اقتصاد کلان',
                    ],
                    'hasht_home_grid_cat' => [
                        'label'   => 'دسته‌بندی',
                        'type'    => 'select',
                        'choices' => $cats_options,
                        'default' => '',
                    ],
                    'hasht_home_grid_count' => [
                        'label'   => 'تعداد پست',
                        'type'    => 'number',
                        'default' => 3,
                    ],
                ]
            ],

            // Section 2: Society & Economy (Grid 2x2)
            'hasht_home_society_sec' => [
                'title' => 'بخش شبکه‌ای ۲',
                'fields' => [
                    'hasht_home_society_title' => [
                        'label'   => 'عنوان بخش',
                        'type'    => 'text',
                        'default' => 'جامعه و اقتصاد',
                    ],
                    'hasht_home_society_cat' => [
                        'label'   => 'دسته‌بندی',
                        'type'    => 'select',
                        'choices' => $cats_options,
                        'default' => '',
                    ],
                    'hasht_home_society_count' => [
                        'label'   => 'تعداد پست',
                        'type'    => 'number',
                        'default' => 4,
                    ],
                ]
            ],

            // Section 3: Industry (Feature + List)
            'hasht_home_industry_sec' => [
                'title' => 'بخش ترکیبی ۱',
                'fields' => [
                    'hasht_home_industry_title' => [
                        'label'   => 'عنوان بخش',
                        'type'    => 'text',
                        'default' => 'صنعت و معدن',
                    ],
                    'hasht_home_industry_cat' => [
                        'label'   => 'دسته‌بندی',
                        'type'    => 'select',
                        'choices' => $cats_options,
                        'default' => '',
                    ],
                    'hasht_home_industry_count' => [
                        'label'   => 'تعداد پست (شامل ۱ ویژه + لیست)',
                        'type'    => 'number',
                        'default' => 5,
                    ],
                ]
            ],

            // Section 4: Energy (Feature)
            'hasht_home_energy_sec' => [
                'title' => 'بخش ترکیبی ۲',
                'fields' => [
                    'hasht_home_energy_title' => [
                        'label'   => 'عنوان بخش',
                        'type'    => 'text',
                        'default' => 'انرژی',
                    ],
                    'hasht_home_energy_cat' => [
                        'label'   => 'دسته‌بندی',
                        'type'    => 'select',
                        'choices' => $cats_options,
                        'default' => '',
                    ],
                    'hasht_home_energy_count' => [
                        'label'   => 'تعداد پست (شامل ۱ ویژه + لیست)',
                        'type'    => 'number',
                        'default' => 5,
                    ],
                ]
            ],

            // Section 5: Multimedia
            'hasht_home_multimedia_sec' => [
                'title' => 'بخش چندرسانه‌ای',
                'fields' => [
                    'hasht_home_multimedia_title' => [
                        'label'   => 'عنوان بخش',
                        'type'    => 'text',
                        'default' => 'چندرسانه‌ای',
                    ],
                    'hasht_home_multimedia_subtitle' => [
                        'label'   => 'زیرعنوان بخش',
                        'type'    => 'text',
                        'default' => 'تازه‌ترین گفتگوهای اختصاصی',
                    ],
                    'hasht_home_multimedia_cat' => [
                        'label'   => 'دسته‌بندی',
                        'type'    => 'select',
                        'choices' => $cats_options,
                        'default' => '',
                    ],
                    'hasht_home_multimedia_count' => [
                        'label'   => 'تعداد پست',
                        'type'    => 'number',
                        'default' => 3,
                    ],
                ]
            ],

            // Section 6: Publications
            'hasht_home_publications_sec' => [
                'title' => 'بخش نشریات',
                'fields' => [
                    'hasht_home_publications_title' => [
                        'label'   => 'عنوان بخش',
                        'type'    => 'text',
                        'default' => 'نشریات تخصصی نماد اقتصاد',
                    ],
                    'hasht_home_publications_subtitle' => [
                        'label'   => 'زیرعنوان',
                        'type'    => 'text',
                        'default' => 'آرشیو جامع مجلات، هفته‌نامه‌ها، فصلنامه‌ها و سالنامه‌های آماری',
                    ],
                    'hasht_home_publications_cat' => [
                        'label'   => 'دسته‌بندی',
                        'type'    => 'select',
                        'choices' => $cats_options,
                        'default' => '',
                    ],
                    'hasht_home_publications_count' => [
                        'label'   => 'تعداد نمایش',
                        'type'    => 'number',
                        'default' => 10,
                        'input_attrs' => [
                            'min' => 5,
                            'max' => 50,
                            'step' => 1,
                        ],
                    ],
                ]
            ],

            // Section 7: Bottom Categories (Bank & Bourse)
            'hasht_home_bottom_sec' => [
                'title' => 'بخش دسته‌های پایانی (بانک و بورس)',
                'fields' => [
                    // Column 1
                    'hasht_home_bottom_cat1_title' => [
                        'label'   => 'عنوان ستون اول',
                        'type'    => 'text',
                        'default' => 'بانک و بیمه',
                    ],
                    'hasht_home_bottom_cat1_slug' => [
                        'label'   => 'دسته‌بندی ستون اول',
                        'type'    => 'select',
                        'choices' => $cats_options,
                        'default' => '',
                    ],
                    'hasht_home_bottom_cat1_count' => [
                        'label'   => 'تعداد پست ستون اول',
                        'type'    => 'number',
                        'default' => 10,
                        'input_attrs' => [
                            'min' => 5,
                            'max' => 50,
                            'step' => 1,
                        ],
                    ],
                    // Column 2
                    'hasht_home_bottom_cat2_title' => [
                        'label'   => 'عنوان ستون دوم',
                        'type'    => 'text',
                        'default' => 'بورس',
                    ],
                    'hasht_home_bottom_cat2_slug' => [
                        'label'   => 'دسته‌بندی ستون دوم',
                        'type'    => 'select',
                        'choices' => $cats_options,
                        'default' => '',
                    ],
                    'hasht_home_bottom_cat2_count' => [
                        'label'   => 'تعداد پست ستون دوم',
                        'type'    => 'number',
                        'default' => 10,
                        'input_attrs' => [
                            'min' => 5,
                            'max' => 50,
                            'step' => 1,
                        ],
                    ],
                    // Column 3
                    'hasht_home_bottom_cat3_title' => [
                        'label'   => 'عنوان ستون سوم',
                        'type'    => 'text',
                        'default' => 'طلا و ارز',
                    ],
                    'hasht_home_bottom_cat3_slug' => [
                        'label'   => 'دسته‌بندی ستون سوم',
                        'type'    => 'select',
                        'choices' => $cats_options,
                        'default' => '',
                    ],
                    'hasht_home_bottom_cat3_count' => [
                        'label'   => 'تعداد پست ستون سوم',
                        'type'    => 'number',
                        'default' => 10,
                        'input_attrs' => [
                            'min' => 5,
                            'max' => 50,
                            'step' => 1,
                        ],
                    ],
                    // Column 4
                    'hasht_home_bottom_cat4_title' => [
                        'label'   => 'عنوان ستون چهارم',
                        'type'    => 'text',
                        'default' => 'خودرو',
                    ],
                    'hasht_home_bottom_cat4_slug' => [
                        'label'   => 'دسته‌بندی ستون چهارم',
                        'type'    => 'select',
                        'choices' => $cats_options,
                        'default' => '',
                    ],
                    'hasht_home_bottom_cat4_count' => [
                        'label'   => 'تعداد پست ستون چهارم',
                        'type'    => 'number',
                        'default' => 10,
                        'input_attrs' => [
                            'min' => 5,
                            'max' => 50,
                            'step' => 1,
                        ],
                    ],
                ]
            ],
        ]
    ],

    // Social Media Settings (Independent Section)
    'hasht_social_sec' => [
        'title'    => 'شبکه‌های اجتماعی',
        'priority' => 35,
        'fields'   => [
            // International
            'hasht_social_instagram_enable' => [ 'label' => 'فعال‌سازی اینستاگرام', 'type' => 'checkbox', 'default' => false ],
            'hasht_social_instagram_url'    => [ 'label' => 'لینک اینستاگرام', 'type' => 'text', 'default' => '' ],
            
            'hasht_social_twitter_enable'   => [ 'label' => 'فعال‌سازی توییتر (X)', 'type' => 'checkbox', 'default' => false ],
            'hasht_social_twitter_url'      => [ 'label' => 'لینک توییتر', 'type' => 'text', 'default' => '' ],

            'hasht_social_linkedin_enable'  => [ 'label' => 'فعال‌سازی لینکدین', 'type' => 'checkbox', 'default' => false ],
            'hasht_social_linkedin_url'     => [ 'label' => 'لینک لینکدین', 'type' => 'text', 'default' => '' ],

            'hasht_social_facebook_enable'  => [ 'label' => 'فعال‌سازی فیسبوک', 'type' => 'checkbox', 'default' => false ],
            'hasht_social_facebook_url'     => [ 'label' => 'لینک فیسبوک', 'type' => 'text', 'default' => '' ],

            'hasht_social_telegram_enable'  => [ 'label' => 'فعال‌سازی تلگرام', 'type' => 'checkbox', 'default' => false ],
            'hasht_social_telegram_url'     => [ 'label' => 'لینک تلگرام', 'type' => 'text', 'default' => '' ],

            // Iranian
            'hasht_social_bale_enable'      => [ 'label' => 'فعال‌سازی بله', 'type' => 'checkbox', 'default' => false ],
            'hasht_social_bale_url'         => [ 'label' => 'لینک بله', 'type' => 'text', 'default' => '' ],

            'hasht_social_eitaa_enable'     => [ 'label' => 'فعال‌سازی ایتا', 'type' => 'checkbox', 'default' => false ],
            'hasht_social_eitaa_url'        => [ 'label' => 'لینک ایتا', 'type' => 'text', 'default' => '' ],

            'hasht_social_rubika_enable'    => [ 'label' => 'فعال‌سازی روبیکا', 'type' => 'checkbox', 'default' => false ],
            'hasht_social_rubika_url'       => [ 'label' => 'لینک روبیکا', 'type' => 'text', 'default' => '' ],

            'hasht_social_igap_enable'      => [ 'label' => 'فعال‌سازی آی‌گپ', 'type' => 'checkbox', 'default' => false ],
            'hasht_social_igap_url'         => [ 'label' => 'لینک آی‌گپ', 'type' => 'text', 'default' => '' ],
        ]
    ]
];

return $settings;
