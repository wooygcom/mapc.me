<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 회원가입 처리
 */

require(INIT_PATH . 'init.db.php');
{ // Model : Head

	{ // BLOCK:process:20131004:회원가입 프로세스

		include_once(LIBRARY_PATH . 'mapc/string_key_gen.php');
		include_once(MODULE_PATH . 'user/model/sign_up_act.func.php');

		/**
         * 회원가입 정보
         */
		$arg['user_name']    = $_POST['user_name'];
		$arg['user_email']    = $_POST['user_email'];
		$arg['user_passwd'] = $_POST['user_passwd'];
		$arg['user_passwd_confirm'] = $_POST['user_passwd_confirm'];
        $arg['group']           = $_POST['group'];

        $arg['user_id'] = $_POST['user_email'];
        $arg['user_uid'] = $arg['user_id'];

        // 에러가 생기면 false로 바뀜...
        $return['result'] = true;

        if($arg['user_passwd'] !== $arg['user_passwd_confirm']) { // 비밀번호, 비밀번호확인이 같은지 검사

            $return['result'] = false;
            $return['status'] = _('암호와 암호확인은 같아야 합니다.');

        } elseif(!filter_var($arg['user_email'], FILTER_VALIDATE_EMAIL)) {
        
            $return['result'] = false;
            $return['status'] = _('이메일 형태가 올바르지 않습니다.');

        }

        // 에러가 없으면... 중복되는 아이디가 있는지 검사
        if($return['result']) {

            $query = '
                select user_id
                  from ' . $CONFIG_DB['prefix'] . 'user_info
                 where user_id = :user_id
                ';
            $stm = $CONFIG_DB['handler']->prepare($query);
            $stm->execute(array(':user_id' => $arg['user_id']));
            $check_id = $stm->fetch(PDO::FETCH_ASSOC);
    
            if($check_id['user_id']) {
    
                $return['result'] = false;
                $return['status'] = _('이미 사용중인 아이디입니다..');
    
            }

        }

        // 에러가 없으면... 
        if($return['result']) {

            // DB핸들러
            $option['dbh']      = $CONFIG_DB['handler'];
            // 로그인에 필요한 키값
            $option['pass_key'] = $CONFIG_SECRET['pass_key'];
            $option['encrypt_method'] = $CONFIG_SECRET['encrypt_method'];

            $return = mapc_user_sign_up_act($arg, $option);
            $return['status'] = $return['status'] ? $return['status'] : '회원가입이 완료되었습니다.';

        }

	} // BLOCK

} // Model : Tail

// ======================================================================

{ // View : Head

    $VIEW['message'] .= $return['status'];
    $VIEW['url']      = $URL['core']['root'];
    $VIEW['display_type'] = 'html_alert';
    $VIEW['layout_file']  = 'html_simple.view.php';

} // View : Tail

// end of file
