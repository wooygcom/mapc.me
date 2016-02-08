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
        'root' => MODULE_PATH . 'mapc/',
        'data' => DATA_PATH   . 'mapc/'
    ],
    'url' => [
        'root' => $URL['core']['root'] . 'mapc/',
        'post' => $URL['core']['root'] . 'mapc/posts/',
        'file' => $URL['core']['root'] . 'mapc/files/'
    ],
    'crud' => [
        'table'  => $CONFIG_DB['prefix'] . 'mapc_post',
        // key field
        'key'    => 'post_seq',
        // 리스트에 가져올 내용들
        'list'   => 'post_uid, post_lang, post_title, post_content, post_origin_type, post_origin_url, post_user_uid, post_user_name, post_write_date',
        // 개별보기 화면에 출력할 내용들
        'read'   => 'post_uid, post_lang, post_title, post_content, post_origin_type, post_origin_url, post_user_uid, post_user_name, post_write_date',
        // required fields for edit
        'req'    => 'post_uid, post_title, post_content',
        // option fields for edit
        'option' => 'post_origin_type, post_origin_url, post_user_uid, post_user_name',
        // 자동으로 생성할 필드(NEW)
        'auto'   => [
            'post_seq' => 'auto_increment',
            'post_write_date' => date('Y-m-d H:i:s')
        ],
        // 검색에 활용할 필드
        'search' => [
            'keys' => 'post_title, post_origin_type, post_user_name, post_write_date',
            'vars' => '_("제목"), _("화일종류"), _("글쓴이"), _("글쓴날")'
        ]
    ],
    'meta' => [
        'table' => $CONFIG_DB['prefix'] . 'mapc_postmeta',
        'list'  => '`postmeta_seq`, `postmeta_post_uid`, `postmeta_key`, `postmeta_value`, `postmeta_lang`, `postmeta_desc`, `postmeta_etc`'
    ]

];

// end of file
