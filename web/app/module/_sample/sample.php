<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 샘플페이지
 *
 * 아래의 형태에서 각 페이지 성격에 맞게 수정하시면 됩니다.
 */

require(INIT_PATH.'common.head.init.php');
{ // Model : Head

	{ // BLOCK:module_include:20120912:필요한 파일 첨부

		require_once(MODULE_PATH	. '_sample/config/config_sample.php');

	} // BLOCK

} // Model : Tail
require(INIT_PATH.'common.tail.init.php');

// ======================================================================

{ // View : Head

	{ // BLOCK:prepare_view:20130923:화면출력에 필요한 준비

		$section_file['sample']        = $PATH['sample']['root'] . 'view/basic/sample.view.php';
		$section_data['sample']['var'] = $URL['sample']['var_url'];

	}

	{ // BLOCK:echo_view:20130923:화면출력

		$publish_data['layout_path'] = LAYOUT_PATH . $CONFIG['layout'] . '/';
		include_once(PROC_PATH . 'publish.proc.php');

	}

} // View : Tail

// end of file
