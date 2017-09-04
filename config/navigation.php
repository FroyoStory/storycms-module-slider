<?php

return [
    'cms' => [
        'title' => 'Content',
        'font'  => 'chrome_reader_mode',
        'groups' => [
            'elements' => [
                'category',
                'pages',
                'post'
            ],
        ]
    ],
    'user' => [
        'title' => 'Member',
        'font'  => 'people',
        'groups' => [
            'groups' => [
                'member',
                'roles'
            ]
        ]
    ],
    'addons' => [
        'title' => 'Addons',
        'font' => 'widgets'
    ],
    'settings' => [
        'title' => 'Settings',
        'font'  => 'settings',
        'groups' => [
            'setting' => [
                'general'
            ],
            'appearance' => [
                'navigation'
            ]
        ]
    ]
];
