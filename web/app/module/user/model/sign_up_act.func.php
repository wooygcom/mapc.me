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

    global $CONFIG;
    global $CONFIG_DB;

	$dbh      = $CONFIG_DB['handler'];

    $user_id      = $arg['user_id'];
	$user_type   = 'normal';
	$user_status = 'normal';
	$user_passwd = hash($option['encrypt_method'], $arg['user_passwd'].$option['pass_key']);
	$today       = date('Y-m-d H:i:s');
    $group = $option['group'];

	$query = "
		INSERT INTO " . $CONFIG_DB['prefix'] . "user_info
		   SET user_uid    = ?,
		     user_name   = ?,
			 user_id     = ?,
		     user_passwd = ?,
			 user_type   = ?,
			 user_status = ?,
			 user_sign_up_date = ?,
			 user_sign_in_date_latest = ?,
			 user_email  = ?,
			 fk_user_group_uid = ?
		";
	$sth    = $dbh->prepare($query);
	$result = $sth->execute(
		array(
			$arg['user_uid'],
			$arg['user_name'],
			$user_id,
			$user_passwd,
			$user_type,
			$user_status,
			$today,
			$today,
			$arg['user_email'],
			$group
		)
	);

	// insert metadata(if exists)
	$query = "
		INSERT INTO " . $CONFIG_DB['prefix'] . "user_infometa
		   set usermeta_user_uid = ?, 
		       usermeta_lang     = ?, 
		       usermeta_key      = ?,
		       usermeta_value    = ?
		";
	$sth    = $dbh->prepare($query);
	foreach($arg['meta'] as $key => $var) {
		$result = $sth->execute(
			array(
				$arg['user_uid'],
				$option['lang'],
				$key,
				$var
			)
		);
	}

	$return['result'] = $result;

	return $return;

} // BLOCK

// this is it
