<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * URL & PATH
 */
$MODULE['mapc']['installed'] = TRUE;

$PATH['mapc']['root']	= MODULE_PATH . 'mapc/';
$PATH['mapc']['view']	= MODULE_PATH . 'mapc/view/';
$PATH['mapc']['data']	= DATA_PATH . 'mapc/default';	// #TODO 사용자별 디렉토리 따로 만들기

$URL['mapc']['root']        = $URL['root'].'?core_modl=mapc';
$URL['mapc']['edit']        = $URL['mapc']['root'] . '&core_page=edit';
$URL['mapc']['edit_run']    = $URL['mapc']['root'] . '&core_page=edit_run';
$URL['mapc']['view']        = $URL['mapc']['root'] . '&core_page=view';
$URL['mapc']['list']        = $URL['mapc']['root'] . '&core_page=list';

/**
 * 모듈 환경설정
 *
 * 각 모듈별 환경설정이 필요할 경우 이곳에서 설정
 */

// end of file
