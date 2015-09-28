<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 권한 설정
 */

require(INIT_PATH . 'init.auth.php');
{ // Model : Head

	{ // BLOCK:argument_check:20140717:넘김값 체크

		$user_uid = $_REQUEST['user_uid'];

	} // BLOCK

} // Model : Tail


// ======================================================================

{ // View : Head

    $section_file = $PATH_ADMIN['user']['root'] . 'view/basic/auth.view.php';
	include_once(PROC_PATH . 'publish.proc.php');

} // View : Tail

// end of file
