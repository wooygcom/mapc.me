<?php
/**
 * 세션 설정
 *
 * @param string $temp['save_session_path']
 * @param string $temp['cookie_domain']
 * @example
    $CONFIG_SECRET['session']['use_trans_sid'] = 0;
    $CONFIG_SECRET['session']['cache_expire'] = 120;
    $CONFIG_SECRET['session']['gc_maxlifetime'] = 10800;
    $CONFIG_SECRET['session']['gc_probability'] = 1;
    $CONFIG_SECRET['session']['gc_divisor'] = 100;
    $CONFIG_SECRET['session']['cookie_domain'] = '';
	$CONFIG_SECRET['session']['save_session_path'] = TEMP_PATH . 'sess/';
	require_once('session.proc.php');
 */

{

	ini_set("session.use_trans_sid",  $CONFIG_SECRET['session']['use_trans_sid']);
	ini_set("session.cache_expire",   $CONFIG_SECRET['session']['cache_expire']);
	ini_set("session.gc_maxlifetime", $CONFIG_SECRET['session']['gc_maxlifetime']);
	ini_set("session.gc_probability", $CONFIG_SECRET['session']['gc_probability']);
	ini_set("session.gc_divisor",     $CONFIG_SECRET['session']['gc_divisor']);
	ini_set("session.cookie_domain",  $CONFIG_SECRET['session']['cookie_domain']);
	ini_set("url_rewriter.tags", ''); // 링크에 PHPSESSID가 따라다니는것을 무력화함 (해뜰녘님께서 알려주셨습니다.)

	@session_cache_limiter("no-cache, must-revalidate");
	@session_save_path($CONFIG_SECRET['session']['save_session_path']);
	@session_set_cookie_params(0, "/");

	@session_start();

	// PHPSESSID 가 틀리면 로그아웃
	if (($_REQUEST['PHPSESSID']) && ($_REQUEST['PHPSESSID'] != session_id())) {

		echo 'Sign in Again, Please.'; exit;

	}

	unset($temp);

}

// end of file
