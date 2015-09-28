<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 회원가입
 */

require(INIT_PATH . 'init.db.php');
{ // Model : Head

	{ // BLOCK:module_include:20120912:필요한 파일 첨부

	} // BLOCK

} // Model : Tail

// ======================================================================

{ // View : Head

	{ // BLOCK:echo_view:20130923:화면출력


	    $message      = '완료';
	    $display_type = 'message';
	    $url = $URL_ADMIN['admin']['page'];
	    include PROC_PATH . 'publish_simple.proc.php';

	}

} // View : Tail

// end of file
