<?php
namespace Mapc\Module\Mapc;

/**
 *
 * 사용자별 디렉토리 가져오기
 *
 * 사용자가 로그인 했을 경우 그 사용자의 디렉토리 가져오기
 *
 * @param string $absPath 기본 데이터 저장 디렉토리
 * @param string $user['type'] 사용자 종류 (admin, master, guest, user 따위)
 * @param string $user['id']   사용자 아이디
 *
 * @return string $return['user'] 사용자별 데이터 저장 디렉토리
 * @return string $return['abs'] 데이터 저장 전체 경로
 *
 * @example Mapc\Module\Mapc\dataPathRead($absPath, ['type' => $_SESSION['mapc_user_type'], 'id' => $_SESSION['mapc_user_uid']);
 *
 */

function dataPathRead($absPath, $user) {

    // 관리자의 기본 디렉토리는 default/
    if($user['type'] == 'admin' || $user['type'] == 'master' || $user['type'] == 'guest' || empty($user['id'])) {

        $return = 'default/';

    } else {

        $return = substr($user['id'], 0, 2) . '/' . substr($user['id'], 2, 2) . '/' . $user['id'] . '/';

    }

	$dirName = $absPath . $return['user'];

    // 디렉토리 구분자로 슬래시(/)를 인식못하는 멍청한 OS의 경우 백슬래시로 바꿔줌
    $dirName = (PHP_OS == 'WINNT') ? str_replace("/", "\\", $dirName) : $dirName;

    // 디렉토리 없으면 만들기
    @mkdir($dirName, 0777, true);

    return $return;

} // function

// end of file
