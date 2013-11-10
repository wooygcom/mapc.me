<?php
/**
 * 로그인 처리
 *
 * @param string $user_id
 * @param string $user_passwd
 * @param object $option['dbh'];
 * @param string $option['pass_key']; crypt함수에 써먹을 키값
 *
 * @return string $return['result'] success/fail
 * @return string $return['status'] normal/banned
 */

function mapc_user_login_act(&$user_id, &$user_passwd, &$option)
{ // BLOCK:login_proc:20131005:로그인 처리

	$pass_key = $option['pass_key'];
	$dbh      = $option['dbh'];

	// 있는 계정인지 확인
	$query = "
		SELECT `user_id`, `user_passwd`, `user_email`, `user_type`, `user_status`
		  FROM `mapc_user`
		 WHERE user_id     = '". $user_id . "'
		";
	$sth = $dbh->prepare($query);
	$sth->execute();
	$login_result = $sth->fetch(PDO::FETCH_ASSOC);

	// 에러가 나면 에러 내용에 따라 에러메시지 출력
	if(empty($login_result)) {

		$return['result'] = 'fail';
		$return['status'] = 'no_user';

	} else if ($login_result['user_status'] == 'banned') { // #TODO 접근금지된 회원 처리

		$return['result'] = 'fail';
		$return['status'] = 'banned';

	} else if (crypt($_POST['user_passwd'].$pass_key, $login_result['user_passwd']) == $login_result['user_passwd']) {

		// 에러 없으면 로그인
		$return['result'] = 'success';

		$return['id']     = $login_result['user_id'];
		$return['type']   = $login_result['user_type'];
		$return['status'] = $login_result['user_status'];

	}

	return $return;

} // BLOCK

// this is it
