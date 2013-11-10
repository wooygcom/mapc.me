<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 경로지정
 */

{ // BLOCK:path_set:2012080901:경로지정

	define('SITE_CODE', 'default');

	// 기본디렉토리, 아래의 디렉토리 위치를 다른 곳으로 변경할 경우 이 값을 변경해줘야 함
	// 디렉토리를 지정할 때는 언제나 뒷부분에 /(슬래시)를 붙여야 합니다. (dir1/(O), dir2(X))
	define('ROOT_PATH', '../');

	define('APP_PATH',  ROOT_PATH.'app/');		// 애플리케이션(프로그램 모음) 디렉토리, Application Directory
		define('ADMIN_PATH',  APP_PATH . 'admin/');	// 관리자 프로그램 모음, Admin Directory
		define('LAYOUT_PATH', APP_PATH . 'layout/');
		define('MODULE_PATH', APP_PATH . 'module/');	// 모듈 디렉토리, Module Directory
		define('RES_PATH',  APP_PATH . 'res/');	// Resources
		define('SITE_PATH',   APP_PATH . 'site/' . SITE_CODE . '/');	// Specialize for each site, You can change this if you use another site.
			define('CONFIG_PATH',  SITE_PATH . 'config/');

	define('SYSTEM_PATH',  ROOT_PATH.'system/');
		define('INIT_PATH',    SYSTEM_PATH .'init/');
		define('LANG_PATH',    SYSTEM_PATH .'lang/');
		define('LIBRARY_PATH', SYSTEM_PATH .'library/');
		define('PROC_PATH',    SYSTEM_PATH .'proc/');

	define('DATA_PATH', ROOT_PATH . 'data/');
	define('TEMP_PATH', ROOT_PATH . 'temp/');

} // BLOCK

{ // BLOCK:config:2012112201:환경설정

	/**
	 * 기본환경설정
	 *
	 * 제목, 인코딩, 시간대 처럼
	 * 관리자가 변경은 가능하지만 추가 또는 삭제하면 않되는 설정값들
	 */
	include_once(CONFIG_PATH . 'config.php');

	/**
	 * 사용자환경설정
	 *
	 * 사용자의 입맛에 맞게 추가할 환경설정들
	 * 특정 모듈에 관한 환경설정들...
	 */
	if(is_file(CONFIG_PATH . 'custom.php')) {
		include_once(CONFIG_PATH . 'custom.php');
	}

} // BLOCK

/**
 * 페이지 불러오기
 */

{ // BLOCK:page_load:2012080901:페이지 불러오기

	if($CONFIG['admin']) {

		include_once( ADMIN_PATH . $CONFIG['admin'] . '/' . $CONFIG['page'] . '.php' );

	} else if($CONFIG['module']) {

		include_once( MODULE_PATH . $CONFIG['module'] . '/' . $CONFIG['page'] . '.php' );

	} else {

		include_once( SITE_PATH . $CONFIG['page'] . '.php' );

	}

} // BLOCK

// end of file
