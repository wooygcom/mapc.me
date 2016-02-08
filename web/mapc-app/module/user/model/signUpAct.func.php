<?php
namespace Mapc\Module\User;

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

function signUpAct($option)
{ // BLOCK:sign_up_proc:20131005:회원가입 처리

	extract($option);

// $userId
// $group
	$userType   = 'normal';
	$userStatus = 'normal';
	$userPasswdEncrypt = hash($encryptMethod, $userPasswd.$passKey);
	$today       = date('Y-m-d H:i:s');

	$query = "
		INSERT INTO " . $prefix . "user_info
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
	$result = $sth->execute([
		$userUid,
		$userName,
		$userId,
		$userPasswdEncrypt,
		$userType,
		$userStatus,
		$today,
		$today,
		$userEmail,
		$group
	]);

	// insert metadata(if exists)
	$query = "
		INSERT INTO " . $prefix . "user_infometa
		   set usermeta_user_uid = ?, 
		       usermeta_lang     = ?, 
		       usermeta_key      = ?,
		       usermeta_value    = ?
		";
	$sth    = $dbh->prepare($query);
	foreach($meta as $key => $var) {
		$result = $sth->execute([
			$userUid,
			$locale,
			$key,
			$var
		]);
	}

	return [
		'result' => $result
	];

} // BLOCK

// this is it
