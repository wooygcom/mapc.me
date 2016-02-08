<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * DB 환경설정
 */
return [
    'type' => 'mysql',
    'host'   => 'localhost',
	'name'   => 'dbname',
	'user'   => 'dbuser',
    'pass'   => 'dbpasswd',
    'prefix' => 'mc_',
    'encode' => 'utf8',

    'page_set'  => 10, // 한 페이지에 출력하는 row수
    'block_set' => 10 // 한 페이지에 출력되는 block수
];

// this is it.
