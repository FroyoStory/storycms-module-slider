<?php

return [
    [
        'key' => 'content',
        'title' => 'Content',
        'font'  => 'chrome_reader_mode',
        'link' => false,
        'items' => [
            [ 'name' => 'Category', 'link' => '/backend/category' ],
            [ 'name' => 'Pages', 'link' => '/backend/post?type=page' ],
            [ 'name' => 'Post', 'link' => '/backend/post'],
        ]
    ],
    [
        'key' => 'user',
        'title' => 'Member',
        'font'  => 'people',
        'link' => false,
        'items' => [
            [ 'name' => 'User', 'link' => '/backend/user' ],
            [ 'name' => 'Roles', 'link' => '/backend/role' ]
        ]
    ],
    [
        'key' => 'plugins',
        'title' => 'Plugins',
        'font' => 'widgets',
        'link' => '/backend/plugins',
        'items' => []
    ],
    [
        'key' => 'settings',
        'title' => 'Settings',
        'font'  => 'settings',
        'link' => false,
        'items' => [
            [ 'name' => 'General', 'link' => '/backend/setting/general' ],
            [ 'name' => 'Media', 'link' => '/backend/setting/media' ],
            [ 'name' => 'Social', 'link' => '/backend/setting/social' ],
            [ 'name' => 'Navigation', 'link' => '/backend/setting/navigation' ],
            [ 'name' => 'Permalink', 'link' => '/backend/setting/permalink' ],
            [ 'name' => 'Theme', 'link' => '/backend/setting/theme' ]
        ]
    ]
];
