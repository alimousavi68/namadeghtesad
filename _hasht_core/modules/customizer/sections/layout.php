<?php
/**
 * Section: Layout & Spacing
 */

return [
    'core_layout_section' => [
        'title'    => 'چیدمان و فضاها',
        'priority' => 35,
        'fields'   => [
            'container_width' => [
                'label'       => 'عرض کانتینر اصلی',
                'description' => 'مثال: 1200px یا 90%',
                'type'        => 'text',
                'default'     => '1200px',
            ],
            'global_radius' => [
                'label'       => 'گردی گوشه‌ها (Border Radius)',
                'type'        => 'select',
                'default'     => '0.5rem',
                'choices'     => [
                    '0'       => 'بدون گردی',
                    '0.25rem' => 'کم (4px)',
                    '0.5rem'  => 'متوسط (8px)',
                    '1rem'    => 'زیاد (16px)',
                    '9999px'  => 'کپسولی',
                ]
            ]
        ]
    ]
];