<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 일반적인 페이지에서 include하는 초기화 머리화일
 */

if(false) // #TODO 아래 security_arguments.php 손봐야됨(지금 에러가 남 ㅠ_ㅠ)~!!!!!
{ // BLOCK:security:20191204:보안설정

    // 기본함수 호출, Require Basic Function
    require_once(LIBRARY_PATH . 'security_arguments.php');

    // 넘김값 체크
    $ARGS  = security_arguments($ARGS);
    $_GET  = security_arguments($_GET);
    $_POST = security_arguments($_POST);

} // BLOCK

{ // BLOCK:session_setup:20121231:세션설정

    include_once(PROC_PATH . 'proc.user.php');

    session_start();

	// 사용자정보
    $_SESSION['mapc_user_type'] = $_SESSION['mapc_user_type'] ? $_SESSION['mapc_user_type'] : 'guest';

} // BLOCK

{ // BLOCK:language_setup:20141110:언어설정

	include_once(PROC_PATH . 'proc.locale.php');

} // BLOCK

// this is it
