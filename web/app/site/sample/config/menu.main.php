<?php
    if(!defined('__MAPC__')) { exit(); }

    $MENU = [
        '_default_submenu' => 'mainmenu1',
        'home' => [
            'mainmenu1' => [
                '_title' => '메인메뉴1', '_link'  => '#',
                '_sub'   => [
                    'menu1' => [
                        '_title' => '메뉴1', '_link'  => '#'
                    ],
                    'menu2' => [
                        '_title' => '메뉴2', '_link'  => '#'
                    ],
                    'menu3' => [
                        '_title' => '메뉴3', '_link'  => '#'
                    ]
                ]
            ],
            'mainmenu2' => [
                '_title' => '메인메뉴2', '_link'  => '#',
                '_sub'   => [
                    'menu1' => [
                        '_title' => '메뉴1', '_link'  => '#'
                    ],
                    'menu2' => [
                        '_title' => '메뉴2', '_link'  => '#'
                    ]
                ]
            ]
        ]
    ];

    $MENU += [
        'admin' => [
            'main' => [
                '_title' => '관리', '_link'  => '#'
            ],
            'user' => [
                '_title' => '사용자', '_link'  => '#',
                '_sub'   => [
                    'user_list' => [
                        '_title' => '사용자', '_link'  => '#'
                    ]
                ]
            ]
        ]
    ];

// this is it
