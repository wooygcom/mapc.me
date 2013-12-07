<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * URL & PATH
 */

$PATH_ADMIN['user']['root']	= ADMIN_PATH . 'user/';
$PATH_ADMIN['user']['view']	= ADMIN_PATH . 'user/view/';

$URL_ADMIN['user']['root']  = $URL['core']['root'] . '?core_admn=user';


/**
 * 모듈 환경설정
 *
 * 각 모듈별 환경설정이 필요할 경우 이곳에서 설정
 */

// end of file
