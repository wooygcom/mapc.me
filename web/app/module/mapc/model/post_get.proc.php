<?php
/**
 * 글 정보들 읽어오기
 */

	{ // BLOCK:arg_check:2012081701:넘어온 값 점검

		// 글의 고유값, Unique ID of article
		$arg['mapc_uid']  = $arg['mapc_uid']  ? $arg['mapc_uid'] : $ARGS['mapc_uid'];
		// 언어
		$arg['mapc_lang'] = $arg['mapc_lang'] ? $arg['mapc_lang'] : $ARGS['mapc_lang'];

	} // BLOCK


    { // BLOCK:post_get:20130921:기본정보 가져오기

		include_once($PATH['mapc']['root'] . 'model/post_get.func.php');
		$option['dbh'] = $CONFIG_DB['handler'];
		$post_info = module_mapc_post_get($arg['mapc_uid'], $arg['mapc_lang'], $option);

	} // BLOCK


    { // BLOCK:postmeta_get:20130921:메타정보 가져오기

		include_once($PATH['mapc']['root'] . 'model/postmeta_get.func.php');
		$option['dbh'] = $CONFIG_DB['handler'];
		$postmeta_info = module_mapc_postmeta_get($arg['mapc_uid'], $arg['mapc_lang'], $option);

	} // BLOCK

// end of file
