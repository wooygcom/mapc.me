<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 로그인 처리
 *
 * 
 */

require(INIT_PATH . 'common.head.init.php');
{ // Model : Head

	{ // BLOCK:process:20131004:로그인 프로세스

		include_once(MODULE_PATH . 'user/model/login_act.func.php');

		// 로그인 아이디 / 암호
		$user_id     = $_POST['user_id'];
		$user_passwd = md5($_POST['user_passwd']);

		// DB핸들러
		$option['dbh'] = $CONFIG_DB['handler'];

		$login_return = mapc_user_login_act($user_id, $user_passwd, $option);

	} // BLOCK

} // Model : Tail
require(INIT_PATH . 'common.tail.init.php');

// ======================================================================

{ // View : Head

	{ // BLOCK:echo_view:20130923:화면출력

		if($login_return['result'] == 'success') {

			echo 'success';

		} else {

			echo 'error';

		}

	} // BLOCK

} // View : Tail

// end of file
