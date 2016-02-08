<?php
if(!defined('__MAPC__')) { exit(); }

require(INIT_PATH . 'init.db.php');
{ // Model : Head

    include_once(MODULE_PATH . 'user/model/infoGet.func.php');
    $temp_info = Mapc\Module\User\infoGet([
        'userUid' => $ARGS['user_uid']
    ]);
    $user_name = $temp_info['user_name'];

} // Model : Tail

// ======================================================================

{ // View : Head

    { // BLOCK:echo_view:20130923:화면출력

        switch($ARGS['message']) {
            case 'not_register':
                $VIEW['message'] = '등록된 회원이 아닙니다.';
                $user_name = '';
                break;
            case 'already':
                $VIEW['message'] = '이미 처리되었습니다.';
                break;
            case 'success':
                $VIEW['message'] = '완료';
                break;
        }

    } // BLOCK

} // View : Tail

// end of file
