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

function mapc_user_sign_in_act(&$user_id, &$user_passwd, &$option)
{ // BLOCK:login_proc:20131005:로그인 처리

    global $CONFIG_DB;

	$dbh = $option['dbh'];
    $user_passwd = hash($option['encrypt_method'], $user_passwd.$option['pass_key']);

	// 있는 계정인지 확인
	$query = "
		SELECT `user_uid`,  `user_id`, `user_passwd`, `user_email`, `user_type`, `user_status`, `fk_user_group_uid` as user_group
		  FROM `" . $CONFIG_DB['prefix'] . "user_info`
		 WHERE user_id     = ?
		";

	$sth = $dbh->prepare($query);
	$sth->execute( array($user_id) );
	$sign_in_result = $sth->fetch(PDO::FETCH_ASSOC);

	// 에러가 나면 에러 내용에 따라 에러메시지 출력
	if(empty($sign_in_result)) {

		$return['result'] = 'fail';
		$return['status'] = 'no_user';

	} else if ($sign_in_result['user_status'] == 'banned') { // #TODO 접근금지된 회원 처리

		$return['result'] = 'fail';
		$return['status'] = 'banned';

	} else if ($user_passwd == $sign_in_result['user_passwd']) {

		// 에러 없으면 로그인
		$return['result'] = 'success';

		$return['uid']    = $sign_in_result['user_uid'];
		$return['id']     = $sign_in_result['user_id'];
		$return['type']   = $sign_in_result['user_type'];
        $return['status'] = $sign_in_result['user_status'];
        $return['group']  = $sign_in_result['user_group'];

	}

	return $return;

} // BLOCK

// this is it
