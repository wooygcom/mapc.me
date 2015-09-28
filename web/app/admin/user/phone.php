<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 전화번호 목록...
 *  
 * tel: 을 이용해서 직접전화도 걸 수 있게...
 */

require(INIT_PATH.'init.db.php');
{ // Model : Head

    $user_uid = $ARGS['user_uid'];
    $query = '
        select user_name from ' . $CONFIG_DB['prefix'] . 'user_info
         where user_uid = :user_uid
        ';
    $sth = $CONFIG_DB['handler']->prepare($query);
    $sth->execute(array(':user_uid' => $user_uid));
    $temp = $sth->fetch(PDO::FETCH_ASSOC);
    $user_name = $temp['user_name'];

    $query_sub = '
            SELECT `usermeta_seq` as m_seq, `usermeta_user_uid` as m_uid, `usermeta_lang` as lang, `usermeta_key` as m_key, `usermeta_value` as m_value, `usermeta_desc` as m_desc, `usermeta_etc` as etc
              FROM ' . $CONFIG_DB['prefix'] . 'user_infometa 
         where (usermeta_user_uid = :user_uid)
           and usermeta_key like "phone_%"';

    $sth_sub = $CONFIG_DB['handler']->prepare($query_sub);
    $sth_sub->execute(array(':user_uid' => $user_uid));

    while($result_sub = $sth_sub->fetch(PDO::FETCH_ASSOC)) {

        switch($result_sub['m_key']) {
            case 'phone_home':
                $temp['name'] = '집전화';
                break;
            case 'phone_cell':
                $temp['name'] = '핸드폰';
                break;
            case 'phone_etc':
                $temp['name'] = '기타';
                break;
        }
        $temp['number'] = $result_sub['m_value'];
        $temp['desc'] = $result_sub['m_desc'];

        $phone[] = $temp;
        unset($temp);

    }

} // Model : Tail

// ======================================================================

{ // View : Head

    $VIEW['body']['user_uid']     = $user_uid;
    $VIEW['body']['user_name'] = $user_name;
    $VIEW['body']['phone'] = $phone;
    $VIEW['layout_path'] = LAYOUT_PATH . $CONFIG['layout'] . '/html_simple.tpl.php';
    include_once(PROC_PATH . 'publish.proc.php');

} // View : Tail

// end of file
