    <?php
return [
    'hasht_single_settings' => [
        'title'    => 'تنظیمات صفحه خبر',
        'priority' => 30,
        'fields'   => [
            'hasht_single_related_enable' => [
                'label'   => 'نمایش اخبار مرتبط',
                'type'    => 'checkbox',
                'default' => true,
            ],
            'hasht_single_related_title' => [
                'label'   => 'عنوان بخش اخبار مرتبط',
                'type'    => 'text',
                'default' => 'اخبار مرتبط',
            ],
            'hasht_single_related_count' => [
                'label'   => 'تعداد مطالب مرتبط',
                'type'    => 'number',
                'default' => 4,
            ],
            'hasht_single_related_query' => [
                'label'   => 'ملاک انتخاب مطالب',
                'type'    => 'select',
                'default' => 'category',
                'choices' => [
                    'category' => 'هم‌دسته',
                    'tag'      => 'هم‌برچسب',
                    'author'   => 'از همین نویسنده',
                    'random'   => 'تصادفی',
                ],
            ],
            'hasht_single_related_layout' => [
                'label'   => 'چیدمان',
                'type'    => 'select',
                'default' => 'grid-2',
                'choices' => [
                    'grid-2' => 'شبکه‌ای (۲ ستون)',
                    'grid-3' => 'شبکه‌ای (۳ ستون)',
                    'list'   => 'لیستی',
                ],
            ],
        ]
    ]
];
