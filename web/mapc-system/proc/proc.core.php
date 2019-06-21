<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 일반적인 페이지에서 include하는 초기화 머리화일
 */

// 기본함수 호출, Require Basic Function
require_once(LIBRARY_PATH . 'mapc/common.func.php');

// 넘김값 체크
$ARGS  = mapc_common_check_var($ARGS);
$_GET  = mapc_common_check_var($_GET);
$_POST = mapc_common_check_var($_POST);

{ // BLOCK:session_setup:20121231:세션설정

	require_once(PROC_PATH . 'session.proc.php');

	// 사용자정보
    $_SESSION['mapc_user_type'] = $_SESSION['mapc_user_type'] ? $_SESSION['mapc_user_type'] : 'guest';

} // BLOCK

/**
 * 언어 설정
 */
{ // BLOCK:language_setup:20141110:언어설정

	include_once(PROC_PATH . 'locale.proc.php');

}

// this is it
