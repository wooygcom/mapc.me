<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * URL & PATH
 */
$MODULE['user']['installed'] = TRUE;

$PATH['user']['root']	= MODULE_PATH . 'user/';
$PATH['user']['view']	= MODULE_PATH . 'user/view/';

$URL['user']['root']  = $URL['core']['root'] . '?core_modl=user';

$URL['user']['sign_in']     = $URL['user']['root'] . '&core_page=sign_in';
$URL['user']['sign_in_act'] = $URL['user']['root'] . '&core_page=sign_in_act';
$URL['user']['sign_out']     = $URL['user']['root'] . '&core_page=sign_out';
$URL['user']['sign_out_act'] = $URL['user']['root'] . '&core_page=sign_out_act';
$URL['user']['sign_up']      = $URL['user']['root'] . '&core_page=sign_up';
$URL['user']['sign_up_act']  = $URL['user']['root'] . '&core_page=sign_up_act';


/**
 * 모듈 환경설정
 *
 * 각 모듈별 환경설정이 필요할 경우 이곳에서 설정
 */

// end of file
