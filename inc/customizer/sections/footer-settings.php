<?php

return [
    'hasht_footer_panel' => [
        'title'       => 'تنظیمات فوتر',
        'description' => 'تنظیمات مربوط به بخش فوتر سایت',
        'priority'    => 160,
        'type'        => 'panel', // Define as panel to contain sections
        'sections'    => [
            'hasht_footer_general' => [
                'title'       => 'تنظیمات عمومی',
                'description' => 'تنظیمات متن و کپی‌رایت',
                'priority'    => 10,
                'fields'      => [
                    'hasht_footer_about' => [
                        'label'       => 'متن درباره ما',
                        'type'        => 'textarea',
                        'description' => 'متنی که زیر لوگو در فوتر نمایش داده می‌شود.',
                    ],
                    'hasht_footer_copyright' => [
                        'label'       => 'متن کپی‌رایت',
                        'type'        => 'text',
                        'default'     => '© ۱۴۰۳ تمامی حقوق مادی و معنوی متعلق به پایگاه خبری نماد اقتصاد می‌باشد.',
                    ],
                ]
            ],
            'hasht_footer_contact' => [
                'title'       => 'اطلاعات تماس',
                'description' => 'تنظیمات آدرس، تلفن و ایمیل',
                'priority'    => 20,
                'fields'      => [
                    'hasht_footer_address' => [
                        'label' => 'آدرس',
                        'type'  => 'textarea',
                    ],
                    'hasht_footer_phone_1' => [
                        'label' => 'شماره تلفن ۱',
                        'type'  => 'text',
                    ],
                    'hasht_footer_phone_2' => [
                        'label' => 'شماره تلفن ۲ (اختیاری)',
                        'type'  => 'text',
                    ],
                    'hasht_footer_fax' => [
                        'label' => 'فکس (اختیاری)',
                        'type'  => 'text',
                    ],
                    'hasht_footer_email' => [
                        'label' => 'ایمیل',
                        'type'  => 'text',
                    ],
                ]
            ]
        ]
    ]
];
