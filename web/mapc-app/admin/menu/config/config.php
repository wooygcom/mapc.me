<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * URL & PATH
 */

$PATH_ADMIN['menu']['root']	= ADMIN_PATH . 'menu/';
$PATH_ADMIN['menu']['view']	= ADMIN_PATH . 'menu/view/';

$URL_ADMIN['menu']['root']  = $URL['core']['root'] . '?core_admn=menu';


/**
 * 모듈 환경설정
 *
 * 각 모듈별 환경설정이 필요할 경우 이곳에서 설정
 */

// end of file
