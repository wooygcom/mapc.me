<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 회원가입 처리
 */

require(INIT_PATH . 'init.head.php');
{ // Model : Head

	{ // BLOCK:process:20131004:로그인 프로세스

		include_once(LIBRARY_PATH . 'mapc/string_key_gen.php');
		include_once(MODULE_PATH . 'user/model/sign_up_act.func.php');

		// DB핸들러
		$option['dbh']      = $CONFIG_DB['handler'];
		// 로그인에 필요한 키값
		$option['pass_key'] = $CONFIG_SECRET['pass_key'];

		// 회원가입 정보
		$arg['user_uid']            = (!empty($_POST['user_uid'])) ? $_POST['user_uid'] : mapc_string_key_gen(20);
		$arg['user_name']           = $_POST['user_name'];
		$arg['user_email']          = $_POST['user_email'];
		$arg['user_passwd']         = $_POST['user_passwd'];
		$arg['user_passwd_confirm'] = $_POST['user_passwd_confirm'];

		// 비밀번호, 비밀번호확인이 같은지 검사
		if($arg['user_passwd'] !== $arg['user_passwd_confirm']) {

			$return['result'] = false;
			$return['status'] = $LANG['user']['alt_passwd_confirm_not_same'];

		} elseif(!filter_var($arg['user_email'], FILTER_VALIDATE_EMAIL)) {
		
			$return['result'] = false;
			$return['status'] = $LANG['user']['alt_email_not_valid'];

		} else {

			$return = mapc_user_sign_up_act($arg, $option);

		}

	} // BLOCK

} // Model : Tail
require(INIT_PATH . 'init.tail.php');

// ======================================================================

{ // View : Head

	{ // BLOCK:echo_view:20130923:화면출력

		if($return['result']) {

			echo $LANG['user']['alt_sign_up_success'];

		} else {

			echo $return['status'];

		}

	} // BLOCK

} // View : Tail

// end of file
