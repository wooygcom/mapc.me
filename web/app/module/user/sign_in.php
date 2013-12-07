<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 샘플페이지
 *
 * 아래의 형태에서 각 페이지 성격에 맞게 수정하시면 됩니다.
 */

require(INIT_PATH . 'init.head.php');
{ // Model : Head

	{ // BLOCK:module_include:20120912:필요한 파일 첨부

	} // BLOCK

} // Model : Tail
require(INIT_PATH . 'init.tail.php');

// ======================================================================

{ // View : Head

	{ // BLOCK:echo_view:20130923:화면출력

		$publish_data['layout_path'] = LAYOUT_PATH . $CONFIG['layout'] . '/simple.tpl.php';
		$section_file = $PATH['user']['root'] . 'view/basic/sign_in.view.php';
		include_once(PROC_PATH . 'publish.proc.php');

	}

} // View : Tail

// end of file
