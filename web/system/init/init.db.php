<?php
if(!defined('__MAPC__')) { exit(); }

require(INIT_PATH . 'init.core.php');

{ // BLOCK:db_setup:20121231:DB설정

	// DB환경설정
	require_once(CONFIG_PATH . 'db.php');
	// DB관련함수
	require_once(LIBRARY_PATH . 'mapc/db.func.php');
	// DB 연결
	$CONFIG_DB['handler'] = $CONFIG_DB['handler'] ? $CONFIG_DB['handler'] : mapc_db_connect($CONFIG_DB);

} // BLOCK

// this is it
