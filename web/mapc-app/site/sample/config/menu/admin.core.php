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
        'user' => [
            '_title' => '사용자',
            '_link'  => '#',
            '_sub'   => [
                'user' => [
                    '_title' => '회원',
                    '_link'  => $URL['core']['admin'] . 'user/user-crud/'
                ],
                'mileage' => [
                    '_title' => '마일리지',
                    '_link'  => $URL['core']['admin'] . 'user/mileage/'
                ],
                'action' => [
                    '_title' => '활동기록',
                    '_link'  => $URL['core']['admin'] . 'user/action/'
                ],
                'action-list' => [
                    '_title' => '활동내역',
                    '_link'  => $URL['core']['admin'] . 'user/action-list/'
                ]
            ]
        ],
        'bbs' => [
            '_title' => '게시판',
            '_link'  => '#',
            '_sub'   => [
                '' => [
                    '_title' => '게시판',
                    '_link'  => $URL['core']['admin'] . 'mapc/posts/'
                ],
            ]
        ],
        'mapc-shop' => [
            '_title' => '쇼핑몰',
            '_link'  => '#',
            '_sub'   => [
                'cate' => [
                    '_title' => '분류',
                    '_link'  => $URL['core']['admin'] . 'mapc/cate/'
                ],
                'prod' => [
                    '_title' => '상품',
                    '_link'  => $URL['core']['admin'] . 'mapc-shop/prod/'
                ],
                'orders' => [
                    '_title' => '주문',
                    '_link'  => $URL['core']['admin'] . 'mapc-shop/orders/'
                ],
            ]
        ],
        'cal' => [
            '_title' => '일정',
            '_link'  => '#',
            '_sub'   => [
                'cal' => [
                    '_title' => '일정',
                    '_link'  => $URL['core']['admin'] . 'cal/cal/'
                ],
            ]
        ],
        'etc' => [
            '_title' => '기타',
            '_link'  => '#',
            '_sub'   => [
                'popup' => [
                    '_title' => '팝업',
                    '_link'  => $URL['core']['admin'] . 'popup/list/'
                ],
            ]
        ],
        'stat' => [
            '_title' => '통계',
            '_link'  => '#',
            '_sub'   => [
                'visitors' => [
                    '_title' => '방문내역',
                    '_link'  => $URL['core']['admin'] . 'academy/attend/'
                ],
            ]
        ],
    ];

} // BLOCK

// this is it
