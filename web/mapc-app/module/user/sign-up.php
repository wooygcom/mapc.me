<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 회원가입
 */

require(INIT_PATH . 'init.db.php');
{ // Model : Head

    { // BLOCK:data:20150215:필요한 값들 설정하기

        $VIEW['body']['user_group'] = $ARGS['user_group'];

	} // BLOCK

} // Model : Tail

// ======================================================================

{ // View : Head

} // View : Tail

// end of file