<?php

return [
    'Cài đặt Laravel' => [
        //'url' => '#',
        'children' => [
            '1.1, XAMPP' => 'docs/xampp-installation',
            '1.2, Vagrant / Homestead' => '#',
            '1.3, Docker' => '#',
        ],
    ],
    'Kiến trúc cơ bản' => [
        //'url' => 'docs/getting-started',
        'children' => [
            '2.1, Request lifecycle' => 'docs/request-lifecycle',
            '2.2, Service Provider' => '#',
        ],
    ],
    'Basic Laravel' => [
        //'url' => 'docs/getting-started',
        'children' => [
            '3.1, Routing' => 'docs/routing',
            '3.2, Middlewares' => 'docs/middlewares',
            '3.3, Controllers' => 'docs/controllers',
            '3.4, Requests' => '#',
            '3.5, Responses' => '#',
            '3.6, Views' => '#',
            '3.7, Services' => '#',
            '3.8, Eloquent Models' => '#',
            '3.9, Events & Handlers' => '#',
            '3.10, Console' => '#',
        ],
    ],
    'Laravel 6.0 LTS' => [
        // 'url' => 'docs/getting-started',
        'children' => [
            '4.1, Các điểm cần lưu ý của bản phát hành 6.0' => '#',
        ],
    ],
    'Official Packages' => [
        // 'url' => 'docs/getting-started',
        'children' => [
            '5.1, Horizon' => '#',
            '5.1, Telescope' => '#',
        ],
    ],
    'Lumen' => [
        // 'url' => 'docs/getting-started',
        'children' => [
            '6.1, So sánh giữa Lumen và Laravel' => '#',
        ],
    ],
];
