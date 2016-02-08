<?php
{ // BLOCK:bare_code:20151003
/*
    return [
        'home' => [
            'mainmenu1' => [
                '_title' => '으뜸메뉴',
                '_link'  => '#',
                '_sub'   => [
                    'menu1' => [
                        '_title' => '버금메뉴1',
                        '_link'  => '#'
                    ]
                ]
            ]
        ]
    ];
*/
} // BLOCK

if(!defined('__MAPC__')) { exit(); }

{ // BLOCK:menu:20151012

    return [
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
    ];

} // BLOCK

// this is it
