<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * URL & PATH
 */
$MODULE['sample']['installed'] = TRUE;

$PATH['sample']['root']	= MODULE_PATH . '_sample/';
$PATH['sample']['view']	= MODULE_PATH . '_sample/view/';

$URL['sample']['root']        = $URL['core']['root'] . '?core_modl=sample';

/**
 * 모듈 환경설정
 *
 * 각 모듈별 환경설정이 필요할 경우 이곳에서 설정
 */

// end of file
