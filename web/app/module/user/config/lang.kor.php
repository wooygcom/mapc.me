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
	$LANG['user']['email']    = '이메일';
	$LANG['user']['password'] = '암호';
	$LANG['user']['signin']   = '로그인';
	$LANG['user']['alt_login_info_save'] = '로그인 정보를 저장합니다.';
	$LANG['user']['alt_signin']	= '로그인 해주세요.';
	$LANG['user']['alt_signin_success'] = '로그인 성공';
	$LANG['user']['alt_signin_error']   = '로그인 에러';

// end of file
