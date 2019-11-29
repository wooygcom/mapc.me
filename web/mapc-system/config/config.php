<?php
$config = [
    'site' => [
        'title'       => '사이트제목',
        'site_url'    => $_SERVER['REQUEST_URI'],
        'description' => 'site description',
        'lang'        => 'ko-KR',
        'type'        => 'website',
        'og_image'    => 'http://sample/images/img.png',
        'og_image_type'   => 'image/png',
        'og_image_width'  => '1024',
        'og_image_height' => '768',
        'author'   => '우연근',
        'email'    => 'webmaster@sample.com',
        'keywords' => '키워드, 키워드2',
        'favicon'  => 'favicon.ico',

        'layout' => 'core'
    ],

    'menu' => [
        'admin' => [
            'my_info' => ROOT_URL . 'commonAdmin/auth/info',
            'users' => ROOT_URL . 'commonAdmin/users/'
        ]
    ],

    'secure' => [
        'upload_dir' => '',

        'dbadapter' => 'mysql',
        'dbhost'    => '127.0.0.1',
        'dbname' => 'test',
        'dbuser' => 'root',
        'dbpass' => 'testtest'
    ],

    'daum_api' => [
        'rest_api_key' => '#daum_api'
        ],
    'naver_api' => [
        'client_id' => '#your client id#', // 오픈 API 키 발급받은 client ID
        'client_secret' => '#your client secret#', // 오픈 API 키 발급받은 client secrete
        'authorize_url' => 'https://nid.naver.com/oauth2.0/authorize',
        'access_token_url' => 'https://nid.naver.com/oauth2.0/token',

        // 오픈 API 키 등록 시 입력한 callback 주소, tutorial에서는 "도메인주소/callback.php".
        'callback_uri' => '#your_callback_uri#',
        'index_uri' => '#your_website_uri#', // tutorial에서는 "도메인주소/index.php"

        'list_category_api_uri' => 'https://openapi.naver.com/blog/listCategory.json',
        'write_post_api_uri' => 'https://openapi.naver.com/blog/writePost.json'
        ]
    ];

return $config;

// this is it
