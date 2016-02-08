<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 샘플페이지
 *
 * 아래의 형태에서 각 페이지 성격에 맞게 수정하시면 됩니다.
 */

require(INIT_PATH . 'init.core.php');
{ // Model : Head

	{ // BLOCK:sign-out:20120912

		session_destroy();
        $_SESSION = [];

	} // BLOCK

} // Model : Tail

// ======================================================================

{ // View : Head

	$VIEW['message'] = _('로그아웃 되었습니다.');
    $VIEW['url']     = $URL['core']['main'];
    $VIEW['display_type'] = 'html_alert';
    $VIEW['layout_file']  = 'html_simple.view.php';

} // View : Tail

// end of file
