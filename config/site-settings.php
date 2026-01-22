<?php
return [
    'general' => [
        'site_title' => [
            'type' => 'translatable_string',
            'label' => 'Название сайта',
            'translatable' => true,
            'locales' => ['en', 'ru', 'uz']
        ],
        'site_description' => [
            'type' => 'text',
            'label' => 'Описание сайта',
            'help' => 'Краткое описание вашего портфолио'
        ],
        'site_url' => [
            'type' => 'url',
            'label' => 'URL сайта',
            'help' => 'Основной адрес сайта'
        ],
    ],
    
    'contact' => [
        'contact_email' => [
            'type' => 'email',
            'label' => 'Email',
            'help' => 'Основной контактный email'
        ],
        'contact_phone' => [
            'type' => 'string',
            'label' => 'Телефон',
            'help' => 'Контактный номер телефона'
        ],
        'contact_address' => [
            'type' => 'text',
            'label' => 'Адрес',
            'help' => 'Физический адрес или город'
        ],
        'contact_working_hours' => [
            'type' => 'string',
            'label' => 'Рабочие часы',
            'help' => 'Часы работы для контакта'
        ],
    ],
    
    'social' => [
        'social_github' => [
            'type' => 'url',
            'label' => 'GitHub',
            'help' => 'Ссылка на профиль GitHub'
        ],
        'social_linkedin' => [
            'type' => 'url',
            'label' => 'LinkedIn',
            'help' => 'Ссылка на профиль LinkedIn'
        ],
        'social_telegram' => [
            'type' => 'url',
            'label' => 'Telegram',
            'help' => 'Ссылка на профиль Telegram'
        ],
        'social_instagram' => [
            'type' => 'url',
            'label' => 'Instagram',
            'help' => 'Ссылка на профиль Instagram'
        ],
        'social_youtube' => [
            'type' => 'url',
            'label' => 'YouTube',
            'help' => 'Ссылка на профиль YouTube'
        ],
        'social_whatsapp' => [
            'type' => 'url',
            'label' => 'WhatsApp',
            'help' => 'Ссылка на профиль WhatsApp'
        ],
    ],
    
    'seo' => [
        'seo_keywords' => [
            'type' => 'text',
            'label' => 'Ключевые слова',
            'help' => 'Ключевые слова для SEO (разделены запятой)'
        ],
        'seo_author' => [
            'type' => 'string',
            'label' => 'Автор',
            'help' => 'Имя автора для мета-тегов'
        ],
    ],
];