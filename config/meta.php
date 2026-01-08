<?php

return [
    'socials' => [
        'instagram' => [
            'link' => env("INST_LINK", "https://www.instagram.com/"),
            'icon' => 'bi bi-instagram',
            'tooltip' => 'Instagram'
        ],
        'linkedin' => [
            'link' => env("LINKEDIN_LINK", "https://linkedin.com/"),
            'icon' => 'bi bi-linkedin',
            'tooltip' => 'Linkedin'
        ],
        'whatsapp' => [
            'link' => env("TG_LINK", "https://wa.me/"),
            'icon' => 'bi bi-whatsapp',
            'tooltip' => 'WhatsApp'
        ],
        'telegram' => [
            'link' => env("TG_LINK", "https://t.me/"),
            'icon' => 'bi bi-telegram',
            'tooltip' => 'Telegram'
        ],
    ]
];