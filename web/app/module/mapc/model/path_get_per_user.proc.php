<?php
/**
 * 사용자별 디렉토리 가져오기
 *
 * 사용자가 로그인 했을 경우 그 사용자의 디렉토리 가져오기
 *
 * @param string $PATH['mapc']['data'] 기본 데이터 저장 디렉토리
 * @param string $arg['user_id'] 사용자 아이디
 *
 * @return string $arg['user_dir'] 사용자별 데이터 저장 디렉토리
 * @return string $arg['data_dir'] 데이터 저장 전체 경로
 */
{

    // 관리자의 기본 디렉토리는 default/
    if($_SESSION['mapc_user_type'] == 'admin' || $_SESSION['mapc_user_type'] == 'master' || empty($_SESSION['mapc_user_uid'])) {
        $arg['user_dir'] = 'default/';
    } else {
        $arg['user_dir'] = $_SESSION['mapc_user_uid'] . '/';
    }

	$arg['data_dir'] = $PATH['mapc']['data'] . $arg['user_dir'];

    // 디렉토리 구분자로 슬래시(/)를 인식못하는 OS의 경우 백슬래시로 바꿔줌
    $tmp_dir_name = (PHP_OS == 'WINNT') ? str_replace("/", "\\", $arg['data_dir']) : $arg['data_dir'];
    @mkdir($tmp_dir_name, 0777);

}
