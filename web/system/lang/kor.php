<?php
	if(!defined('__MAPC__')) { exit(); }

	/**
	 * 언어설정
	 *
     * $LANG['var']	= '낱말'; '일반 낱말';
     * $LANG['sys_.....']	= '시스템에서 사용하는 메시지';
     *     낱말을 해석하는 것이 아님
     *     예를들어, sys_title은 시스템 타이틀 이 아니라 현재 웹에서의 제목을 뜻함
     * $LANG['ask_.....']	= '확인메시지';
     * $LANG['alt_.....']	= '알림메시지';
	 */

	// 언어이름
	$CODE = isset($CODE) ? $CODE : array();

	$CODE['core']['lang']['kor'] = '한글';
	$CODE['core']['lang']['eng'] = 'English';
	$CODE['core']['lang']['jpn'] = 'にほんご';
	$CODE['core']['lang']['zho'] = '中國語';


	$LANG = isset($LANG) ? $LANG : array();

	// 현재 사용하는 언어
	$LANG['core']['sys_lang'] = '한국어';
	// 사이트 제목
	$LANG['core']['sys_title'] = '사이트제목';

	$LANG['core']['suc_submit'] = '처리되었습니다.';
	$LANG['core']['err_submit'] = '처리 중 에러가 발생했습니다.';

	$LANG['core']['submit'] = '확인';
	$LANG['core']['cancel'] = '취소';

	$LANG['core']['alt_avail_word_count'] = '입력가능한 글자수';
	$LANG['core']['alt_max_word']	= '최대 글자수';
	$LANG['core']['alt_min_word']	= '최소 글자수';
	$LANG['core']['alt_max_num']	= '최대값';
	$LANG['core']['alt_min_num']	= '최소값';

	$LANG['core']['err_essen']		= '필수값(%s)이 입력되지 않았습니다.';
	$LANG['core']['err_select']		= '%s (을)를 선택해주세요.';
	$LANG['core']['err_over_word']	= '입력한 글자수가 최대값을 넘겼습니다.';
	$LANG['core']['err_under_word']	= '글자수가 최소값 이하입니다.';
	$LANG['core']['err_over_num']	= '입력된 숫자가 최대값 이상입니다.';
	$LANG['core']['err_under_num']	= '입력된 숫자가 최소값 이하입니다.';
	$LANG['core']['err_req_num']	= '숫자형태로만 입력해주세요.';
	$LANG['core']['err_wrong_email']= '이메일주소 형식이 잘못되었습니다.';

// this is it
