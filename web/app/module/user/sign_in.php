<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 샘플페이지
 *
 * 아래의 형태에서 각 페이지 성격에 맞게 수정하시면 됩니다.
 */

require(INIT_PATH . 'init.db.php');
{ // Model : Head

    { // BLOCK:get_config:20150205:환경설정 가져오기

        include_once(MODULE_PATH . 'user/config/config.php');

    } // BLOCK

    { // BLOCK:data:20150215:필요한 값들 설정하기

        $VIEW['body']['sign_in_use'] = $MODULE['user']['sign_in_use'];
        $VIEW['body']['user_group']  = $ARGS['user_group'];

    } // BLOCK

} // Model : Tail

// ======================================================================

{ // View : Head

	{ // BLOCK:echo_view:20130923:화면출력

        $VIEW['link_to']     = $_REQUEST['link_to'];
        $display_type = 'html_simple';

	} // BLOCK

} // View : Tail

// end of file
