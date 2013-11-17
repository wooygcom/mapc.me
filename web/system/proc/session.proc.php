<?php
/**
 * 세션 설정
 *
 * @param string $temp['save_session_path']
 * @param string $temp['cookie_domain']
 * @example
	$temp = array();
	$temp['save_session_path'] = '/temp/session';
	$temp['cookie_domain']     = 'sessiondomain.com';
	require_once('session.proc.php');
 */

// #TODO 환경설정에서 변경가능하도록...
{

	ini_set("session.use_trans_sid", 0);		// PHPSESSID를 자동으로 넘기지 않음
	ini_set("session.cache_expire", 120);	// 세션 캐쉬 보관시간 (분)
	ini_set("session.gc_maxlifetime", 10800);	// session data의 garbage collection 존재 기간을 지정 (초)
	ini_set("session.gc_probability", 1);	// session.gc_probability는 session.gc_divisor와 연계하여 gc(쓰레기 수거) 루틴의 시작 확률을 관리합니다. 기본값은 1입니다. 자세한 내용은 session.gc_divisor를 참고하십시오.
	ini_set("session.gc_divisor", 100);		// session.gc_divisor는 session.gc_probability와 결합하여 각 세션 초기화 시에 gc(쓰레기 수거) 프로세스를 시작할 확률을 정의합니다. 확률은 gc_probability/gc_divisor를 사용하여 계산합니다. 즉, 1/100은 각 요청시에 GC 프로세스를 시작할 확률이 1%입니다. session.gc_divisor의 기본값은 100입니다.
	ini_set("session.cookie_domain", $temp['cookie_domain']);
	ini_set("url_rewriter.tags", '');		// 링크에 PHPSESSID가 따라다니는것을 무력화함 (해뜰녘님께서 알려주셨습니다.)

	@session_cache_limiter("no-cache, must-revalidate");
	@session_save_path($temp['save_session_path']);
	@session_set_cookie_params(0, "/");

	@session_start();

	// PHPSESSID 가 틀리면 로그아웃
	if (($_REQUEST['PHPSESSID']) && ($_REQUEST['PHPSESSID'] != session_id())) {

		echo 'Sign in Again, Please.'; exit;

	}

	unset($temp);

}

// end of file
