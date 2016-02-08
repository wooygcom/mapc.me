<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 회원 리스트
 */

require(INIT_PATH . 'init.auth.php');
{ // Model : Head

    { // BLOCK:get_config:20150205:환경설정 가져오기

        include_once(ADMIN_PATH . 'user/config/config.php');

    } // BLOCK

    { // BLOCK:search:20150208:검색

        $url_addition .= ($search_status) ? 'search_status/' . $search_status . '/' : '';
        $VIEW['body']['url_addtion'] = $url_addition;

    } // BLOCK

} // Model : Tail

// ======================================================================

{ // View : Head

    { // BLOCK:var_for_search:20150216:검색에 필요한 값

        $today       = new DateTime();
        $yesterday = new DateTime('yesterday');
        $last_month = new DateTime('first day of last month');
        $VIEW['body']['today'] = $today->format('Y-m-d');
        $VIEW['body']['yesterday'] = $yesterday->format('Y-m-d');
        $VIEW['body']['month_begin'] = $today->format('Y-m-01');
        $VIEW['body']['month_end'] = $today->format('Y-m-t');
        $VIEW['body']['last_month_begin'] = $last_month->format('Y-m-01');
        $VIEW['body']['last_month_end'] = $last_month->format('Y-m-t');

    } //  BLOCK

    { // BLOCK:list:20130923:리스트출력에 필요한 

        if(empty($VIEW['body']['user_list'])) {
            $user_list['title'] = '회원관리';
            $user_list['name'] = '이름';
            $user_list['id'] = '아이디';
            $user_list['email'] = '이메일';
            $user_list['status'] = '상태';
            $user_list['sign_up_date'] = '등록일';
            $user_list['sign_in_date_latest'] = '로그인';
            $user_list['etc'] = '기타';
            $VIEW['body']['user_list'] = $user_list; 
        }

    } //  BLOCK
    
    { // BLOCK:echo_view:20130923:화면출력
	
        $VIEW['head']['js']['jquery-2.1.3.min.js']  = 'https://code.jquery.com/';
        $VIEW['head']['js']['jquery-ui.min.js']  = 'https://code.jquery.com/ui/1.11.2/';
        $VIEW['head']['css']['jquery-ui.css']  = 'https://code.jquery.com/ui/1.11.2/themes/redmond/';
        $VIEW['head']['js']['bootstrap.min.js'] = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/';
        $VIEW['head']['css']['bootstrap.min.css']   = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/';
	    $VIEW['head']['js']['jquery.jtable.js']   = $URL['core']['root'] . 'vendor/jtable/';
        $VIEW['head']['js']['jquery.jtable.kr.js']  = $URL['core']['root'] . 'vendor/jtable/localization/';
        $VIEW['head']['css']['jtable.css']   = $URL['core']['root'] . 'vendor/jtable/themes/metro/blue/';
        $VIEW['head']['js']['jquery.validationEngine-en.js'] = $URL['core']['root'] . 'vendor/jquery-plugin-validation/';
        $VIEW['head']['js']['jquery.validationEngine.js'] = $URL['core']['root'] . 'vendor/jquery-plugin-validation/';

        $PATH['layout'] = LAYOUT_PATH . $CONFIG['layout'] . '/html_simple.view.php';
		$section_file = $PATH_ADMIN['user']['root'] . 'view/basic/user_crud.view.php';
		include_once(PROC_PATH . 'publish.proc.php');

    } //  BLOCK

} // View : Tail

// end of file
