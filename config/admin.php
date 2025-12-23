<?php

return [
    'title' => 'Simple Admin',
    'name' => '<b>Simple</b> Admin',
    'route_prefix' => 'admin',
    'route_name_prefix' => 'admin.',
    'middleware' => ['web', 'auth'],
    'auth_guard' => 'web',
    'menu' => [
        [
            'title'      => 'dashboard',
            'icon'       => 'bi bi-columns-gap',
            'route'      => 'admin.dashboard',
            'permission' => 'view_dashboard'
        ],
        [
            'title'      => 'projects',
            'icon'       => 'bi bi-briefcase',
            'route'      => 'admin.projects.index',
            'permission' => 'view_projects',
        ],
        // [
        //     'title'       => 'media',
        //     'icon'       => 'bi bi-image',
        //     'route'      => 'admin.media.index',
        //     'permission' => 'view_media',
        // ],
        [
            'title'       => 'users',
            'icon'       => 'bi bi-people',
            'route'      => 'admin.users.index',
            'permission' => 'manage_users',
        ],
    ]
];