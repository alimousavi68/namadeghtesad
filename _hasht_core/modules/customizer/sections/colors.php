<?php

return [
    'colors_panel' => [
        'title'    => 'مدیریت رنگ‌ها',
        'type'     => 'panel', // این کلید جادویی است
        'priority' => 20,
        'sections' => [
            // Section 1: Light Mode (Default)
            'colors_light_section' => [
                'title'  => 'تم پیش‌فرض (روشن)',
                'fields' => [
                    'color_primary' => [
                        'label'   => 'رنگ اصلی (Primary)',
                        'type'    => 'color',
                        'default' => '#3b82f6', // Blue-500
                    ],
                    'color_secondary' => [
                        'label'   => 'رنگ دوم (Secondary)',
                        'type'    => 'color',
                        'default' => '#10b981', // Emerald-500
                    ],
                    'color_background' => [
                        'label'   => 'رنگ پس‌زمینه',
                        'type'    => 'color',
                        'default' => '#ffffff',
                    ],
                    'color_text_main' => [
                        'label'   => 'رنگ متن اصلی',
                        'type'    => 'color',
                        'default' => '#1f2937', // Gray-800
                    ],
                    'color_footer_bg' => [
                        'label'   => 'رنگ پس‌زمینه فوتر',
                        'type'    => 'color',
                        'default' => '#1e293b', // Slate-800
                    ],
                ]
            ],

            // Section 2: Dark Mode
            'colors_dark_section' => [
                'title'       => 'تم تیره (Dark Mode)',
                'description' => 'این رنگ‌ها زمانی اعمال می‌شوند که سیستم کاربر روی حالت تیره باشد.',
                'fields'      => [
                    'color_primary_dark' => [
                        'label'   => 'رنگ اصلی در شب',
                        'type'    => 'color',
                        'default' => '#60a5fa', // Blue-400 (روشن‌تر برای خوانایی در شب)
                    ],
                    'color_background_dark' => [
                        'label'   => 'پس‌زمینه تیره',
                        'type'    => 'color',
                        'default' => '#111827', // Gray-900
                    ],
                    'color_text_main_dark' => [
                        'label'   => 'رنگ متن در شب',
                        'type'    => 'color',
                        'default' => '#f9fafb', // Gray-50
                    ],
                    'color_footer_bg_dark' => [
                        'label'   => 'رنگ پس‌زمینه فوتر (شب)',
                        'type'    => 'color',
                        'default' => '#0f172a', // Slate-900
                    ],
                ]
            ]
        ]
    ]
];