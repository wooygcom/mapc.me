<?php
	if(!defined('__MAPC__')) { exit(); }

	/**
	 * 입력값 체크
	 *
	 * 해킹코드 검사
	 * <, > 기호는 몽땅 [, ]로 대체
	 */

	// #TODO 
	function mapc_common_check_var($data, $level = 'strict') {

		return str_replace(array('<','>'), array('[',']'), $data);

	}

// this is it
