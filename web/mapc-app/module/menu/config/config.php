<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * URL & PATH
 */
$PATH['menu']['root'] = MODULE_PATH . 'menu/';
$PATH['menu']['data'] = DATA_PATH . 'menu/';

$MODULE_MENU_URL['edit']      = $URL['core']['root'].'menu/edit/';
$MODULE_MENU_URL['edit_proc'] = $URL['core']['root'].'menu/edit_run/';

/**
 * 모듈 환경설정
 *
 * 각 모듈별 환경설정이 필요할 경우 이곳에서 설정
 */

// end of file
