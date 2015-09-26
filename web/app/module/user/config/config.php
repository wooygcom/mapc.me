<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * URL & PATH
 */
$MODULE['user']['installed'] = TRUE;
// true일 경우 회원가입과 로그인창이 한꺼번에...
$MODULE['user']['sign_in_use'] = false;

$PATH['user']['root']	= MODULE_PATH . 'user/';
$PATH['user']['view']	= MODULE_PATH . 'user/view/';

$URL['user']['root']  = $URL['core']['root'] . 'user/';

$URL['user']['attend']     = $URL['user']['root'] . 'attend/';
$URL['user']['attend_act']     = $URL['user']['root'] . 'attend_act/';
$URL['user']['sign_in']     = $URL['user']['root'] . 'sign_in/';
$URL['user']['sign_in_act'] = $URL['user']['root'] . 'sign_in_act/';
$URL['user']['sign_out']     = $URL['user']['root'] . 'sign_out/';
$URL['user']['sign_out_act'] = $URL['user']['root'] . 'sign_out_act/';
$URL['user']['sign_up']      = $URL['user']['root'] . 'sign_up/';
$URL['user']['sign_up_act']  = $URL['user']['root'] . 'sign_up_act/';


/**
 * 모듈 환경설정
 *
 * 각 모듈별 환경설정이 필요할 경우 이곳에서 설정
 */

// end of file
