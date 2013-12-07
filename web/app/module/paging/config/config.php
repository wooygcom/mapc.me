<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * URL & PATH
 */
$MODULE['paging']['installed'] = TRUE;

$PATH['paging']['root']	= MODULE_PATH . 'paging/';
$PATH['paging']['view']	= MODULE_PATH . 'paging/view/';

$URL['paging']['root']        = $URL['core']['root'] . '?core_modl=paging';

/**
 * 모듈 환경설정
 *
 * 각 모듈별 환경설정이 필요할 경우 이곳에서 설정
 */

// end of file
