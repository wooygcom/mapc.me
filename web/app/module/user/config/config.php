<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * URL & PATH
 */
$MODULE['user']['installed'] = TRUE;

$PATH['user']['root']	= MODULE_PATH . 'user/';
$PATH['user']['view']	= MODULE_PATH . 'user/view/';

$URL['user']['root']        = $URL['core']['root'] . '?core_modl=user';


/**
 * 모듈 환경설정
 *
 * 각 모듈별 환경설정이 필요할 경우 이곳에서 설정
 */

// end of file
