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
        'list' => [
            '_title' => '글읽기', '_link'  => $URL['core']['root'] . 'mapc/posts/',
            '_sub'   => [
                'list' => [
                    '_title' => '일반', '_link'  => $URL['core']['root'] . 'mapc/posts/',
                    '_sub'   => [
                        'computer' => [
                            '_title' => '셈틀', '_link' => $URL['core']['root'] . 'mapc/posts/' . '&mapc_search[]=dc_subject_id:FN2B3EDRG7Y4VXAP8THK'
                        ],
                        'server' => [
                            '_title' => '써버', '_link' => $URL['core']['root'] . 'mapc/posts/' . 'mapc_search[]/dc_subject_id:JXH5DSP79CFQ8RZWBT4M/'
                        ],
                        'tip' => [
                            '_title' => '생활의 지혜', '_link' => $URL['core']['root'] . 'mapc/posts/' . 'mapc_search[]/dc_subject_id:2BNQTZ5G7FLXY4EDAK1H/'
                        ],
                        'quiz' => [
                            '_title' => '수수께끼', '_link' => $URL['core']['root'] . 'mapc/posts/' . 'mapc_search[]/dc_subject_id:SUQPCELTYB1K7MA326F4/'
                        ]
                    ]
                ],
                'pictures' => [
                    '_title' => '사진', '_link'  => $URL['core']['root'] . 'mapc/posts/' . 'mapc_cate/image/',
                    '_sub'   => [
                        'animal' => [
                            '_title' => '동물', '_link' => $URL['core']['root'] . 'mapc/posts/' . 'mapc_cate/image/mapc_search[]/dc_subject:반려동물/'
                        ],
                        'memory' => [
                            '_title' => '추억', '_link' => $URL['core']['root'] . 'mapc/posts/' . 'mapc_cate/image/mapc_search[]/dc_subject_id:YF893RVLWCHQMAN7DTS5/'
                        ],
                        'satire' => [
                            '_title' => '풍자', '_link' => $URL['core']['root'] . 'mapc/posts/' . 'mapc_cate/image/mapc_search[]/dc_subject:풍자/'
                        ],
                        'landscape' => [
                            '_title' => '풍경', '_link' => $URL['core']['root'] . 'mapc/posts/' . 'mapc_cate/image/mapc_search[]/dc_subject:풍경/'
                        ],
                        'humor' => [
                            '_title' => '우스개', '_link' => $URL['core']['root'] . 'mapc/posts/' . 'mapc_cate/image/mapc_search[]/dc_type:우스개/'
                        ]
                    ]
                ],
                'calendar' => [
                    '_title' => '달력', '_link' => $URL['core']['root'] . 'mapc/posts/' . 'mapc_cate/date/',
                    '_sub' => [
                        '_title' => '날적이', '_link' => $URL['core']['root'] . 'mapc/posts/' . 'mapc_cate/date/mapc_search[]/dc_type:날적이/'
                    ]
                ],
                'tag' => [
                    '_title' => '꼬리표', '_link' => $URL['core']['root'] . 'mapc/posts/' . 'mapc_cate/tag/'
                ]
            ]
        ],

        'write' => [
            '_title' => '글쓰기', '_link'  => '#',
            '_sub' => [
                'memo' => [
                    '_title' => '적바림', '_link' => $URL['mapc']['edit'] . 'mapc_cate_edit/memo/'
                ],
                'diary' => [
                    '_title' => '날적이', '_link' => $URL['mapc']['edit'] . 'mapc_cate_edit/diary/'
                ],
                'quiz' => [
                    '_title' => '수수께끼', '_link' => $URL['mapc']['edit'] . 'mapc_cate_edit/quiz/'
                ],
                'proverb' => [
                    '_title' => '명언', '_link' => $URL['mapc']['edit'] . 'mapc_cate_edit/proverb/'
                ],
                'satire' => [
                    '_title' => '풍자', '_link' => $URL['mapc']['edit'] . 'mapc_cate_edit/satire/'
                ],
                'word' => [
                    '_title' => '이름씨', '_link' => $URL['mapc']['edit'] . 'mapc_cate_edit/word/'
                ],
                'animal' => [
                    '_title' => '반려동물', '_link' => $URL['mapc']['edit'] . 'mapc_cate_edit/animal_picture/'
                ],
                'landscape' => [
                    '_title' => '풍경', '_link' => $URL['mapc']['edit'] . 'mapc_cate_edit/landscape_picture/'
                ]
            ]
        ],

        'special' => [
            '_title' => '관리', '_link' => '#',
            '_sub' => [
                'scrap' => [
                    '_title' => '긁어오기', '_link' => $URL['mapc']['scrap']
                ],
                'batch' => [
                    '_title' => '일괄편집', '_link' => $URL['mapc']['batch']
                ]
            ]
        ]
    ];

} // BLOCK

// this is it
