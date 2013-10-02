<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 일반적인 페이지에서 include하는 초기화 머리화일
 */

// 환경설정
require_once(CONFIG_PATH . 'db.php');

// 언어화일 include(cfg.php 에서 설정한 언어의 파일 불러오기)
require_once(LANG_PATH . $CONFIG['lang'].'.php');

// 기본함수 호출, Require Basic Function
require_once(LIBRARY_PATH . 'mapc/common.func.php');
require_once(LIBRARY_PATH . 'mapc/db.func.php');

// 호출한 모듈의 환경설정
if($CONFIG['module']) {
	// module/모듈명/config/config.php
	include_once(MODULE_PATH . $CONFIG['module'] . '/config/config.php');
	// module/모듈명/config/lang.언어코드.php
	include_once(MODULE_PATH . $CONFIG['module'] . '/config/lang.' . $CONFIG['lang'] . '.php');
}

// 사용자 입력값 체크
$_GET  = mapc_common_check_var($_GET);
$_POST = mapc_common_check_var($_POST);

// DB 연결
$CONFIG_DB['handler'] = $CONFIG_DB['handler'] ? $CONFIG_DB['handler'] : mapc_db_connect($CONFIG_DB);

{ // BLOCK:session_setup:20121231:세션설정

	$temp = array();
	$temp['save_session_path'] = $PATH['core']['sess'];
	$temp['cookie_domain']     = '';
	require_once(PROC_PATH . 'session.proc.php');

	// 사용자정보
	// #TODO get user information 사용자정보 가져오기
	$USER_INFO = $USER_INFO ? $USER_INFO : array();

} // BLOCK

// this is it
