<?php
/**
 *
 * 메타정보 가져오기
 *
 */
function moduleUserMetaRead($user_uid = '') {

    global $CONFIG_DB;

    $query = '
        SELECT `usermeta_seq`, `usermeta_user_uid`, `usermeta_lang`, `usermeta_key`, `usermeta_value`, `usermeta_desc`, `usermeta_etc`
          FROM `' . $CONFIG_DB['prefix'] . 'user_infometa`
         WHERE usermeta_user_uid = :user_uid
        ';

    $stm = $CONFIG_DB['handler']->prepare($query);
    $stm->execute([':user_uid' => $user_uid]);

    $result = [];

    while($rlt = $stm->fetch(PDO::FETCH_ASSOC)) {

        $key = $rlt['usermeta_key'];
        $var = $rlt['usermeta_value'];
        $result[$key] = $var;   

    } 

    unset($key, $var);

    return $result;

}

// end of file
