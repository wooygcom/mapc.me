<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 모듈명
 */

require(INIT_PATH.'common.head.init.php');
{ // Model : Head

	{ // BLOCK:module_include:20120912:필요한 모듈 첨부

		require_once(MODULE_PATH	. '_sample/config/config_sample.php');

	} // BLOCK


	{ // BLOCK:arg_check:2012081701:넘어온 값 점검

	} // BLOCK


    { // BLOCK:meta_get:20130921:Model 처리

	} // BLOCK

} // Model : Tail
require(INIT_PATH.'common.tail.init.php');

// ======================================================================

{ // View : Head

    $section_file['sample']        = $PATH['sample']['root'] . 'view/basic/sample.view.php';
    $section_data['sample']['var'] = $URL['sample']['var_url'];

	$publish_data['layout_path'] = LAYOUT_PATH . $CONFIG['layout'] . '/';
	include_once(PROC_PATH . 'publish.proc.php');

} // View : Tail

// end of file
