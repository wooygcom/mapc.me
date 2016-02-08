<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * URL & PATH
 */

$PATH_ADMIN['admin']['root']	= ADMIN_PATH . 'admin/';
$PATH_ADMIN['admin']['view']	= ADMIN_PATH . 'admin/view/';

$URL_ADMIN['admin']['root']     = $URL['core']['root'] . 'admin-core/';
$URL_ADMIN['admin']['site_detail']     = $URL_ADMIN['admin']['root'] . 'site_detail/';
$URL_ADMIN['admin']['site_detail_act'] = $URL_ADMIN['admin']['root'] . 'site_detail_act/';
$URL_ADMIN['admin']['module']          = $URL_ADMIN['admin']['root'] . 'module/';
$URL_ADMIN['admin']['module_edit']     = $URL_ADMIN['admin']['root'] . 'module_edit/';
$URL_ADMIN['admin']['module_edit_act'] = $URL_ADMIN['admin']['root'] . 'module_edit_act/';
$URL_ADMIN['admin']['page']            = $URL_ADMIN['admin']['root'] . 'page/';
$URL_ADMIN['admin']['page_edit']       = $URL_ADMIN['admin']['root'] . 'page_edit/';
$URL_ADMIN['admin']['page_edit_act']   = $URL_ADMIN['admin']['root'] . 'page_edit_act/';


/**
 * 모듈 환경설정
 *
 * 각 모듈별 환경설정이 필요할 경우 이곳에서 설정
 */

// end of file
