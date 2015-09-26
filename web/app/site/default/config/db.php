<?php
	if(!defined('__MAPC__')) { exit(); }

	/**
	 * DB 환경설정
	 */
	$CONFIG_DB = array();
	$CONFIG_DB['type']   = 'mysql';
	$CONFIG_DB['host']   = 'localhost';
	$CONFIG_DB['name']   = 'dbname';
	$CONFIG_DB['user']   = 'dbuser';
	$CONFIG_DB['pass']   = 'dbpasswd';
	$CONFIG_DB['prefix'] = 'mc_';
	$CONFIG_DB['encode'] = 'utf8';

	$CONFIG_DB['page_set']  = 10; // 한 페이지에 출력하는 row수
	$CONFIG_DB['block_set'] = 10; // 한 페이지에 출력되는 block수

// this is it.
