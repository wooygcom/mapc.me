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

        $VIEW['message'] .= _('완료');
        $VIEW['url']      = $URL['core']['root'];
        $VIEW['display_type'] = 'html_alert';
        $VIEW['layout_file']  = 'html_simple.view.php';

	}

} // View : Tail

// end of file
