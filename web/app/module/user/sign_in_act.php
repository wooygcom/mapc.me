<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 로그인 처리
 *
 * 
 */

require(INIT_PATH . 'init.db.php');
{ // Model : Head

	{ // BLOCK:process:20131004:로그인 프로세스

		include_once(MODULE_PATH . 'user/model/sign_in_act.func.php');

		// 로그인 아이디 / 암호
		$user_id     = $_POST['user_id'];
		$user_passwd = $_POST['user_passwd'];

		// DB핸들러
		$option['dbh']      = $CONFIG_DB['handler'];
		// 로그인에 필요한 키값
		$option['pass_key'] = $CONFIG_SECRET['pass_key'];
        $option['encrypt_method'] = $CONFIG_SECRET['encrypt_method'];

		$sign_in_return = mapc_user_sign_in_act($user_id, $user_passwd, $option);

	} // BLOCK

} // Model : Tail

// ======================================================================

{ // View : Head

	{ // BLOCK:login_process:20130923:로그인 처리

		if($sign_in_return['result'] == 'success') {

			$_SESSION['mapc_user_uid']    = $sign_in_return['uid'];
			$_SESSION['mapc_user_id']     = $sign_in_return['id'];
			$_SESSION['mapc_user_type']   = $sign_in_return['type'];
            $_SESSION['mapc_user_status'] = $sign_in_return['status'];
            $_SESSION['mapc_user_group']  = $sign_in_return['group'];

            $VIEW['url']     = $_POST['link_to'] ? $_POST['link_to'] : $URL['core']['root'];
            $VIEW['message'] = _('로그인 되었습니다..');
            $display_type = 'html_alert';

        } else {

            unset($_SESSION);

            $VIEW['message'] = _('아이디와 비밀번호를 확인해주세요.');
            $VIEW['url']     = $URL['core']['root'];
            $display_type = 'html_alert';

		}

	} // BLOCK

} // View : Tail

// end of file
