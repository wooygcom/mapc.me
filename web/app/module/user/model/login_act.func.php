<?php
/**
 * 로그인 처리
 *
 * @param string $user_id
 * @param string $user_passwd
 * @param object $option['dbh'];
 *
 * @return string $return['result'] success/fail
 * @return string $return['status'] normal/banned
 */

function mapc_user_login_act($user_id, $user_passwd, $option)
{ // BLOCK:login_proc:20131005:로그인 처리

	$dbh = $option['dbh'];

	// 있는 계정인지 확인
	$query = "
		SELECT `user_id`, `user_email`, `user_type`, `user_status`
		  FROM `mapc_user`
		 WHERE user_id     = '". $user_id . "'
		   AND user_passwd = '". $user_passwd . "'
		";
	$sth = $dbh->prepare($query);
	$sth->execute();
	$login_result = $sth->fetch(PDO::FETCH_ASSOC);

	// 에러가 나면 에러 내용에 따라 에러메시지 출력
	if(empty($login_result)) {

		$return['result'] = 'fail';

	} else if ($login_result['user_status'] == 'banned') { // #TODO 접근금지된 회원 처리

		$return['status'] = 'banned';

	} else {

		// 에러 없으면 로그인
		$_SESSION['mapc_user_id']     = $login_result['user_id'];
		$_SESSION['mapc_user_type']   = $login_result['user_type'];
		$_SESSION['mapc_user_status'] = $login_result['user_status'];

		$return['result'] = 'success';
		$return['status'] = 'normal';

	}

	return $return;

} // BLOCK

// this is it
