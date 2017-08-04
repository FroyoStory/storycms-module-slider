<?php

return [
    'backend' => [
        'cms' => [
            'title' => 'Content',
            'font'  => 'chrome_reader_mode',
            'groups' => [
                'elements' => ['category','pages', 'post'],
                // 'navigations' => ['navigation']
            ]
        ],
        'user' => [
            'title' => 'Member',
            'font'  => 'people',
            'groups' => [
                'groups' => ['member', 'roles']
            ]
        ],
        'system' => [
            'title' => 'System',
            'font'  => 'settings',
            'groups' => [
                'setting' => ['general'],
                'appearance' => ['navigation'] // 'theme',
            ]
        ]
    ]
];
