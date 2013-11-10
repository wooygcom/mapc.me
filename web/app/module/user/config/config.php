<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * URL & PATH
 */
$MODULE['user']['installed'] = TRUE;

$PATH['user']['root']	= MODULE_PATH . 'user/';
$PATH['user']['view']	= MODULE_PATH . 'user/view/';

$URL['user']['root']  = $URL['core']['root'] . '?core_modl=user';

$URL['user']['login']     = $URL['user']['root'] . '&core_page=login';
$URL['user']['login_act'] = $URL['user']['root'] . '&core_page=login_act';
$URL['user']['join']      = $URL['user']['root'] . '&core_page=join';
$URL['user']['join_act']  = $URL['user']['root'] . '&core_page=join_act';


/**
 * 모듈 환경설정
 *
 * 각 모듈별 환경설정이 필요할 경우 이곳에서 설정
 */

// end of file
