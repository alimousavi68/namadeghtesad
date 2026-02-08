<?php

return [
    'hasht_social_section' => [
        'title'       => 'شبکه‌های اجتماعی',
        'description' => 'تنظیمات لینک‌های شبکه‌های اجتماعی',
        'priority'    => 170, // After footer
        'type'        => 'section',
        'fields'      => [
            // Instagram
            'hasht_social_instagram_enable' => [
                'label'   => 'نمایش اینستاگرام',
                'type'    => 'checkbox',
            ],
            'hasht_social_instagram_url' => [
                'label'   => 'لینک اینستاگرام',
                'type'    => 'text',
            ],

            // Twitter/X
            'hasht_social_twitter_enable' => [
                'label'   => 'نمایش توییتر (X)',
                'type'    => 'checkbox',
            ],
            'hasht_social_twitter_url' => [
                'label'   => 'لینک توییتر',
                'type'    => 'text',
            ],

            // LinkedIn
            'hasht_social_linkedin_enable' => [
                'label'   => 'نمایش لینکدین',
                'type'    => 'checkbox',
            ],
            'hasht_social_linkedin_url' => [
                'label'   => 'لینک لینکدین',
                'type'    => 'text',
            ],

            // Facebook
            'hasht_social_facebook_enable' => [
                'label'   => 'نمایش فیسبوک',
                'type'    => 'checkbox',
            ],
            'hasht_social_facebook_url' => [
                'label'   => 'لینک فیسبوک',
                'type'    => 'text',
            ],

            // Telegram
            'hasht_social_telegram_enable' => [
                'label'   => 'نمایش تلگرام',
                'type'    => 'checkbox',
            ],
            'hasht_social_telegram_url' => [
                'label'   => 'لینک تلگرام',
                'type'    => 'text',
            ],

            // Bale
            'hasht_social_bale_enable' => [
                'label'   => 'نمایش بله',
                'type'    => 'checkbox',
            ],
            'hasht_social_bale_url' => [
                'label'   => 'لینک بله',
                'type'    => 'text',
            ],

            // Eitaa
            'hasht_social_eitaa_enable' => [
                'label'   => 'نمایش ایتا',
                'type'    => 'checkbox',
            ],
            'hasht_social_eitaa_url' => [
                'label'   => 'لینک ایتا',
                'type'    => 'text',
            ],

            // Rubika
            'hasht_social_rubika_enable' => [
                'label'   => 'نمایش روبیکا',
                'type'    => 'checkbox',
            ],
            'hasht_social_rubika_url' => [
                'label'   => 'لینک روبیکا',
                'type'    => 'text',
            ],

            // iGap
            'hasht_social_igap_enable' => [
                'label'   => 'نمایش آی‌گپ',
                'type'    => 'checkbox',
            ],
            'hasht_social_igap_url' => [
                'label'   => 'لینک آی‌گپ',
                'type'    => 'text',
            ],
        ]
    ]
];
