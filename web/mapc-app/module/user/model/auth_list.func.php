<?php
/**
 * 권한체크
 *
 * @param string  $userId User ID
 * @param string  $auth_require 체크하려는 권한
 * @param string  $option['level'] strict, default
 * @param handler $arg['dbh'] DBhandler
 */

function module_user_auth_list($user_uid, $auth_require = '', $option = array('level' => 'strict')) {

    global $CONFIG;
    global $CONFIG_DB;

    $user_uid     = (! empty($user_uid)) ? $user_uid : 'default';

    { // BLOCK:auth_list:20131125:개인 권한 가져오기

        $query = "
            select usermeta_value
              from " . $CONFIG_DB['prefix'] . "user_infometa
             where usermeta_user_uid = :user_uid
               and usermeta_key      = 'auth'
        ";

        $res = $CONFIG_DB['handler']->prepare($query);
        $res->execute(array(':user_uid' => $user_uid));
        while($result = $res->fetch(PDO::FETCH_ASSOC)) {

            $auth_key = $result['usermeta_value'];
            $auth_have[$auth_key] = $auth_key;

        }

    } // BLOCK

    if(empty($auth_have)) // 개인 권한이 없을때
    { // BLOCK:up_level_auth_get:20131125:권한이 없을 경우 자신이 속한 그룹의 권한 가져오기

        // #TODO user_type 별 접근 메뉴권한을 줄것!!!!!!!!!!!!!!!!!
        // #TODO user_auth 테이블을 만드는 게 좋을듯... (이게 다되면 init.auth.php도 수정!!!)

        $query = "
            select usermeta_user_uid, usermeta_value
              from " . $CONFIG_DB['prefix'] . "user_infometa
             where usermeta_key   = 'auth'
               and usermeta_user_uid IN
                (
                    select usermeta_user_uid
                      from " . $CONFIG_DB['prefix'] . "user_infometa
                     where usermeta_key   = 'sub_user'
                       and usermeta_value = :user_uid
                )

        ";

        $res = $CONFIG_DB['handler']->prepare($query);
        $res->execute(array(':user_uid' => $user_uid));
        while($result = $res->fetch(PDO::FETCH_ASSOC)) {

            $auth_key = $result['usermeta_value'];
            $auth_have[$auth_key] = $auth_key;

        }

    } // BLOCK

    return $auth_have;

} // function
