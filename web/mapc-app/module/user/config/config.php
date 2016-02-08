<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 모듈 환경설정
 *
 * 각 모듈별 환경설정이 필요할 경우 이곳에서 설정
 */

return [

    /**
     * URL & PATH
     */
    'path' => [
        'root' => MODULE_PATH . 'user/',
    ],
    'url' => [
        'root'  => $URL['core']['root'] . 'user/',
    ],
    'user' => [
        'table'  => $CONFIG_DB['prefix'] . 'user',
        // key field
        'key'    => 'seq',
        // 리스트에 가져올 내용들
        'list'   => '`uid`, `title`, `desc`, `surmary`, `create_date`, `update_date`, `expire_date`, `status`, `etc`',
        // 개별보기 화면에 출력할 내용들
        'read'   => '`uid`, `title`, `desc`, `surmary`, `create_date`, `update_date`, `expire_date`, `status`, `etc`',
        // required fields for edit
        'req'    => '`uid`, `title`',
        // option fields for edit
        'option' => '`desc`, `surmary`',
        // 자동으로 생성할 필드(Auto Create Fields)
        'autoCreate' => [
            'seq' => 'auto_increment',
            'create_date' => date('Y-m-d H:i:s')
        ],
        // 업데이트 할 때 자동으로 수정될 필드(Auto Update Fields)
        'autoUpdate' => [
            'update_date' => date('Y-m-d H:i:s'),
        ],
        // 검색에 활용할 필드
        'search' => [
            'keys' => '_title, create_date, expire_date',
            'vars' => '_("제목"), _("시작일"), _("마김일")'
        ]
    ],
    'surveymeta' => [
        'table' => $CONFIG_DB['prefix'] . 'mapc_postmeta',
        'list'  => '`postmeta_seq`, `postmeta_post_uid`, `postmeta_key`, `postmeta_value`, `postmeta_lang`, `postmeta_desc`, `postmeta_etc`'
    ]

];

// end of file
