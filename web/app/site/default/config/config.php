<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 사용자 입력값 및 기본값 설정
 */

{ // BLOCK:argument_arrange:2012080901:사용자 입력값 (또는 GET값 중 필요한 부분) 처리(환경 설정에서 필요한 부분은 사용하고 나머지는 버림)

	error_reporting(0);	// 에러출력

    $temp = array();

	// $_REQUEST['core_modl']
	// 기본으로 사용할 모듈(선택)
	$temp['modl'] = htmlspecialchars($_REQUEST['core_modl']);
	// 관리자 모듈(선택)
	$temp['admn'] = htmlspecialchars($_REQUEST['core_admn']);
	// 페이지 지정하지 않았을 경우 기본 페이지
	$temp['page'] = htmlspecialchars($_REQUEST['core_page']);
	// 사용할 언어
	$temp['lang'] = htmlspecialchars($_REQUEST['core_lang']);
	// 기본 출력(html, json, etc...)
	$temp['show'] = htmlspecialchars($_REQUEST['core_show']);

} // BLOCK


/**
 * 일반설정
 * 
 * 사용자에 의해 변경가능한 값
 */

{ // BLOCK:normar_config:20121202

	date_default_timezone_set('Asia/Seoul');	// 기본시간대

	$CONFIG = array();
	$CONFIG['encode']	= 'utf-8';	// 기본 인코딩, default encoding
	$CONFIG['utc']		= date('P'); // UTC 시차 (+09:00 형태)
	$CONFIG['email']	= '';       // 관리자 이메일
	$CONFIG['layout']	= 'basic';	// 기본 레이아웃

    $CONFIG['admin']    = !empty($temp['admn']) ? $temp['admn'] : '';    // admin module
    $CONFIG['module']   = !empty($temp['modl']) ? $temp['modl'] : '';    // default module
    $CONFIG['module']   = !empty($temp['admn']) ? $temp['admn'] : $temp['modl'];    // admin에 값이 있을 경우 $CONFIG['module']은 admin값을 따름
    $CONFIG['page']     = !empty($temp['page']) ? $temp['page'] : 'dashboard';    // default page
    $CONFIG['lang']     = !empty($temp['lang']) ? $temp['lang'] : 'kor';  // 기본언어
    $CONFIG['show']     = !empty($temp['show']) ? $temp['show'] : 'html'; // 기본화면출력 : html, html_emb(embed형식), html_cont(head,body태그 빼고 내용만 출력), xml, docbook, json

	unset($temp);

} // BLOCK


/**
 * 메타데이터 지정
 */
{ // BLOCK:meta_data:20131209:메타데이터 지정

    // $CONFIG['meta'] 값 가져오기
    include(CONFIG_PATH . 'meta.lang_' . $CONFIG['lang'] . '.php');

} // BLOCK


/**
 * 보안관련 설정
 * 
 * 고정값으로 사용자에 의한 변경 불가능
 */
 
{ // BLOCK:secret_config:20130104:템플릿으로 출력되기 직전 삭제할 환경설정

	$CONFIG_SECRET['pass_key']	= 'a5Fk597a'; // 새로운 사이트에서는 반드시 새로운 값으로 변경하세요!!! // #TODO 처음 설치할 때 변경할 수 있도록!!!!!!!!!!!!!
    $CONFIG_SECRET['session']['use_trans_sid'] = 0; // PHPSESSID를 자동으로 넘기지 않음
    $CONFIG_SECRET['session']['cache_expire'] = 120; // 세션 캐쉬 보관시간 (분)
    $CONFIG_SECRET['session']['gc_maxlifetime'] = 10800; // session data의 garbage collection 존재 기간을 지정 (초)
    $CONFIG_SECRET['session']['gc_probability'] = 1; // session.gc_probability는 session.gc_divisor와 연계하여 gc(쓰레기 수거) 루틴의 시작 확률을 관리합니다. 기본값은 1입니다. 자세한 내용은 session.gc_divisor를 참고하십시오.
    $CONFIG_SECRET['session']['gc_divisor'] = 100; 	// session.gc_divisor는 session.gc_probability와 결합하여 각 세션 초기화 시에 gc(쓰레기 수거) 프로세스를 시작할 확률을 정의합니다. 확률은 gc_probability/gc_divisor를 사용하여 계산합니다. 즉, 1/100은 각 요청시에 GC 프로세스를 시작할 확률이 1%입니다. session.gc_divisor의 기본값은 100입니다.
    $CONFIG_SECRET['session']['cookie_domain'] = '';
	$CONFIG_SECRET['session']['save_session_path'] = TEMP_PATH . 'sess/';

} // BLOCK


/**
 * URL & PATH
 *
 * 시스템상의 접근경로 설정
 * 시스템 운영에 꼭 필요한 디렉토리는 상수로 설정
 * 그밖의 부수적인 디렉토리는 변수로 설정...
 * PATH : for System
 * URL  : for web access
 */

{ // BLOCK:path_config:20121202:.....

	$PATH = array();
	$PATH['core']['skin']	= SITE_PATH . 'view/';
	$PATH['core']['log']	= TEMP_PATH . 'log/';	// 로그 저장용 (시스템 사용에 관한 기록들)

	$URL = array();
	// ROOT (상대주소를 사용할 경우에는 빈칸 또는 ./, 절대 주소를 사용할때는 웹상의URL을 적는다)
	$URL['core']['root'] = eregi_replace("\/[^/]*\.php$", "/", $_SERVER['PHP_SELF']);
	// 기본페이지 (기본페이지?변수1=값1&변수2=값2 와 같은 형태로 호출됨)
	$URL['core']['main'] = $URL['core']['root'] . 'index.php';
	$URL['core']['site'] = $URL['core']['root'] . 'site/' . SITE_CODE . '/';
	$URL['core']['skin'] = $URL['core']['site'] . 'view/';

} // BLOCK


/**
 * Declare Debug mode
 *
 * Change debug mode, if connect in localhost.
 */
{ // BLOCK:declare_is_debug:20121228

	if($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '::1' || $is_debug == true) {

		$is_debug = true;
		error_reporting(E_ALL ^ E_NOTICE);

	} else {

		$is_debug = false;
		error_reporting(0);

	}

} // BLOCK

// end of file
