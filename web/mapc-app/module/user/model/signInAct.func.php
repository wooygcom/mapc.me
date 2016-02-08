<?php
namespace Mapc\Module\User;

/**
 *
 * 로그인 처리
 *
 * @param string $options['userId']
 * @param string $options['userPasswd']
 * @param string $options['dbh']
 * @param string $options['prefix']
 * @param string $options['encryptMethod']
 * @param string $options['passKey']
 *
 * @return string $return['result'] success/fail
 * @return string $return['status'] normal/banned
 *
 */

function signInAct($options)
{ // BLOCK:login_proc:20131005:로그인 처리

	extract($options);

    $userPasswd = hash($encryptMethod, $userPasswd.$passKey);

	// 있는 계정인지 확인
	$query = "
		SELECT `user_uid`,  `user_id`, `user_passwd`, `user_email`, `user_type`, `user_status`, `fk_user_group_uid` as user_group
		  FROM `" . $prefix . "user_info`
		 WHERE user_id = ?
		";

	$sth = $dbh->prepare($query);
	$sth->execute([$userId]);
	$signInResult = $sth->fetch();

	// 에러가 나면 에러 내용에 따라 에러메시지 출력
	if(empty($signInResult)) {

		$return = [
			'result' => 'fail',
			'status' => 'noUser'
		];

	} else if ($signInResult['user_status'] == 'banned') { // #TODO 접근금지된 회원 처리

		$return = [
			'result' => 'fail',
			'status' => 'banned'
		];

	} else if ($userPasswd == $signInResult['user_passwd']) {

		// 에러 없으면 로그인
		$return = [
			'result' => 'success',
			'uid'    => $signInResult['user_uid'],
			'id'     => $signInResult['user_id'],
			'type'   => $signInResult['user_type'],
        	'status' => $signInResult['user_status'],
        	'group'  => $signInResult['user_group']
        ];

	}

	return $return;

} // BLOCK

// this is it
