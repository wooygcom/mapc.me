<?php
if(!defined('__MAPC__')) { exit(); }

require_once(INIT_PATH . 'init.core.php');
require_once(INIT_PATH . 'init.db.php');

{ // BLOCK:auth_check:20131123:권한체크

    // 기본 환경설정 불러오기.
    include_once(ADMIN_PATH . 'core/config/config.php');

    // 호출한 모듈(관리자)의 환경설정 불러오기
    // admin/모듈명/config.config.php
    include_once(ADMIN_PATH . $ARGS['admin'] . '/config/config.php');

    // 권한체크
    include_once(MODULE_PATH . 'user/model/auth_list.func.php');
    $auth = module_user_auth_list($_SESSION['mapc_user_uid']);

    if(! in_array($auth['admin'], array('admin', 'manager') ) ) {
        $auth_require = $auth_require ? $auth_require : $ARGS['modl'] . '/' . $ARGS['page'] . '/';
        // 필요한 권한이 있거나 로그인 로그아웃 페이지일 때...
        if(($ARGS['admn'] == 'core' && ($ARGS['page'] == 'sign_in' || $ARGS['page'] == 'sign_up'))
            || $auth[$auth_require]) {

            // PASS

        } elseif($_SESSION['mapc_user_id']) {

            $VIEW['message'] .= _('권한이 없습니다.');
            $VIEW['url']      = ROOT_URL;

        } else {

            $VIEW['message'] .= _('로그인 해주세요.');
            $VIEW['url']      = $URL['core']['root'] . 'admin-core/sign-in/';

        }

        $VIEW['display_type'] = 'html_alert';
        $VIEW['layout_file']  = 'html_simple.view.php';

    }

} // BLOCK

// this is it
