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

	$LANG = isset($LANG) ? $LANG : array();
	$LANG['user']['name']     = '이름';
	$LANG['user']['email']    = '이메일';
	$LANG['user']['passwd'] = '암호';
	$LANG['user']['passwd_confirm'] = '암호확인';
	$LANG['user']['sign_up']   = '회원가입';
	$LANG['user']['sign_in']   = '로그인';
	$LANG['user']['sign_out']  = '로그아웃';
	$LANG['user']['alt_sign_in_info_save'] = '로그인 정보를 저장합니다.';
	$LANG['user']['alt_sign_in']	= '로그인 해주세요.';
	$LANG['user']['alt_sign_in_success'] = '로그인 성공';
	$LANG['user']['alt_sign_in_error']   = '로그인 에러';
	$LANG['user']['alt_sign_up_success'] = '회원가입 성공';
	$LANG['user']['alt_sign_up_error']   = '회원가입 에러';

	$LANG['user']['alt_email_not_valid']= '이메일 값이 올바르지 않습니다.';
	$LANG['user']['alt_passwd_confirm_not_same'] = '비밀번호와 비밀번호확인이 일치하지 않습니다.';

// end of file
