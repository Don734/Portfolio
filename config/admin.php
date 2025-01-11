<?php

return [
    'title' => 'Simple Admin',
    'logo' => [
        'img' => 'ginza_icon.png',
        'text' => '<b>Simple</b> Admin',
        'route' => 'dashboard.'
    ],
    'menu' => [
        [
            'text' => 'dashboard',
            'icon' => 'bi bi-house-door-fill',
            'route'  => 'dashboard.',
        ],
        [
            'header' => 'extra',
        ],
        [
            'text' => 'banners',
            'icon' => 'bi bi-images',
            'route'  => 'dashboard.banners.index',
        ],
        [
            'text' => 'projects',
            'icon' => 'bi bi-list-check',
            'route'  => 'dashboard.projects.index',
        ],
        [
            'text' => 'posts',
            'icon' => 'bi bi-newspaper',
            'route'  => 'dashboard.posts.index',
        ],
        [
            'header' => 'settings',
        ],
        [
            'text' => 'dictionary',
            'icon' => 'bi bi-alphabet',
            'route'  => 'dashboard.dictionary.index',
        ],
        [
            'text' => 'users',
            'icon' => 'bi bi-people',
            'route'  => 'dashboard.users.index',
            'can' => 'manage-users'
        ],
        [
            'text' => 'profile',
            'icon' => 'bi bi-person-fill',
            'route'  => 'dashboard.profile',
        ],
    ]
];