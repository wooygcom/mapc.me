<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 샘플페이지
 *
 * 아래의 형태에서 각 페이지 성격에 맞게 수정하시면 됩니다.
 */

require(INIT_PATH.'common.head.init.php');
{ // Model : Head

} // Model : Tail
require(INIT_PATH.'common.tail.init.php');

// ======================================================================

{ // View : Head

	{ // BLOCK:echo_view:20130923:화면출력

		$section_file = $PATH['sample']['root'] . 'view/basic/sample.view.php';
		include_once(PROC_PATH . 'publish.proc.php');

	}

} // View : Tail

// end of file
