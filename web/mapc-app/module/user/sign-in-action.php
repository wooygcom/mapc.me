<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 로그인 처리
 *
 * 
 */

require(INIT_PATH . 'init.db.php');
{ // Model : Head

	{ // BLOCK:process:20131004:로그인 프로세스

		include_once(__DIR__ . '/model/signInAct.func.php');

		$signInResult = Mapc\Module\User\signInAct([
            'userId'     => $_POST['user_id'],
            'userPasswd' => $_POST['user_passwd'],
            'dbh'        => $CONFIG_DB['handler'],
            'prefix'     => $CONFIG_DB['prefix'],
            'encryptMethod' => $CONFIG_SECRET['encrypt_method'],
            'passKey'    => $CONFIG_SECRET['pass_key']
        ]);

	} // BLOCK

} // Model : Tail

// ======================================================================

{ // View : Head

	{ // BLOCK:login_process:20130923:로그인 처리

		if($signInResult['result'] == 'success') {

            // locale정보도 세션에 저장되어있으므로 += 연산자를 씀.
			$_SESSION['mapc_user_uid']    = $signInResult['uid'];
            $_SESSION['mapc_user_id']     = $signInResult['id'];
            $_SESSION['mapc_user_type']   = $signInResult['type'];
            $_SESSION['mapc_user_status'] = $signInResult['status'];
            $_SESSION['mapc_user_group']  = $signInResult['group'];

            $VIEW['message'] = _('로그인 되었습니다..');

        } else {

            $_SESSION['mapc_user_uid']    = '';
            $_SESSION['mapc_user_id']     = '';
            $_SESSION['mapc_user_type']   = 'guest';
            $_SESSION['mapc_user_status'] = '';
            $_SESSION['mapc_user_group']  = '';

            $VIEW['message'] = _('아이디와 비밀번호를 확인해주세요.');

		}

        $VIEW['url']     = $_POST['link_to'] ? $_POST['link_to'] : $URL['core']['root'];
        $VIEW['display_type'] = 'html_alert';
        $VIEW['layout_file']  = 'html_simple.view.php';

	} // BLOCK

} // View : Tail

// end of file
