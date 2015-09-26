<?php
/**
 *
 * 화면출력 일괄처리 간단버전
 *
 * @param string $display_type 어떤 방식으로 화면에 출력할지
 * @param string $url          이동하려는 페이지 주소
 * @param string $message      출력하려는 내용
 *
 * @example
 * 		$display_type = 'message';
 * 		$message = _('로그인 되었습니다.');
 * 		$url     = $URL['core']['root'];
 * 		include PROC_PATH . 'publish_simple.proc.php';
 * 
 */

if(!defined('__MAPC__')) { exit(); }

{ // BLOCK:unset_security_var:2014-11-08:템플릿 출력에는 불필요한 환경설정 변수 삭제

	unset($CONFIG_SECRET);
	unset($CONFIG_DB);

} // BLOCK


{ // BLOCK:publish_hook_include:2013-01-21:publish hook 파일 첨부

    $VIEW['headhook']['headhook_metatag.tpl.php'] = $VIEW['layout_path'];
    include($VIEW['layout_path'] . '/html_simple.tpl.php');
    exit;

} // BLOCK

// end of file
