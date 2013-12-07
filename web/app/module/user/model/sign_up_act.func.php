<?php
/**
 * 로그인 처리
 *
 * @param string $arg['user_email']  사용자아이디
 * @param string $arg['user_passwd'] 비밀번호
 * @param string $arg['user_nick']   별명
 * @param object $option['dbh'];     DB핸들러
 * @param string $option['pass_key']; crypt함수에 써먹을 키값
 *
 * @return book $result 회원등록성공:true/실패:false
 */

function mapc_user_sign_up_act(&$arg, &$option)
{ // BLOCK:sign_up_proc:20131005:회원가입 처리

	$dbh      = $option['dbh'];
	$pass_key = $option['pass_key'];

	$user_type   = 'normal';
	$user_status = 'normal';
	$user_passwd = crypt($arg['user_passwd'].$pass_key);
	$today       = date('Y-m-d H:i:s');

	$query = "
		INSERT INTO mapc_user
		   SET user_uid    = ?
		     , user_name   = ?
			 , user_id     = ?
		     , user_passwd = ?
			 , user_type   = ?
			 , user_status = ?
			 , user_sign_up_date = ?
			 , user_sign_in_date_latest = ?
			 , user_email  = ?
		";
	$sth    = $dbh->prepare($query);
	$result = $sth->execute(
		array(
			$arg['user_uid'],
			$arg['user_name'],
			$arg['user_email'],
			$user_passwd,
			$user_type,
			$user_status,
			$today,
			$today,
			$arg['user_email']
		)
	);

	$return['result'] = $result;

	return $return;

} // BLOCK

// this is it
