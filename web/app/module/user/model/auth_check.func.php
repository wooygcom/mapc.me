<?php
/**
 * 권한체크
 *
 * @param string  $user_id User ID
 * @param string  $request_auth 체크하려는 권한
 * @param string  $option['level'] strict, default
 * @param handler $arg['dbh'] DBhandler
 */

function module_user_auth_check($user_uid, $request_auth, $option = array('level' => 'strict')) {

    global $CONFIG_DB;

    $user_uid = (! empty($user_uid)) ? $user_uid : 'default';

    { // BLOCK:auth_check:20131125:해당 사용자의 권한 체크

        $query = "
            select usermeta_user_uid, usermeta_value
              from mapc_usermeta
             where usermeta_user_uid = ?
               and usermeta_key      = 'auth'
               and usermeta_value    = ?
        ";

        $res = $CONFIG_DB['handler']->prepare($query);
        $res->execute(array($user_uid, $request_auth));
        $result = $res->fetch();

        if(! empty($result['usermeta_value'])) {

            return true;

        } else {

            $return = false;

        }

    } // BLOCK

    if(! $return) // 권한이 없을때
    { // BLOCK:up_level_auth_get:20131125:권한이 없을 경우 자신이 속한 그룹에는 권한이 있는지 체크

        $query = "
            select usermeta_user_uid, usermeta_value
              from mapc_usermeta
             where usermeta_key   = 'auth'
               and usermeta_value = ?
               and usermeta_user_uid IN
                (
                    select usermeta_user_uid
                      from mapc_usermeta
                     where usermeta_key   = 'sub_user'
                       and usermeta_value = ?
                )

        ";

        $res = $CONFIG_DB['handler']->prepare($query);
        $res->execute(array($request_auth, $user_uid));
        $result = $res->fetch();

        if(! empty($result['usermeta_value'])) {

            return true;

        } else {

            $return = false;

        }

    } // BLOCK


    // 까다롭게 검사(권한없으면 바로 멈춤)
    if($option['level'] == 'strict') {
        echo 'AUTH ERROR';
        exit;
    // 부드럽게 검사("권한없음" 반환)
    } else {
        // 결과값 반환
        return $return;
    }

} // function
