<?php

function popup_get() {
    //
}
/* #TODO
이미 init.db.php를 불러왔을 경우의 처리를 해야 됨!!! 
(이 아래에서는 $CONFIG_DB가 안먹힘);

include_once(INIT_PATH . 'init.db.php');

function popup_get() {

    $query = '
        select popup_seq as seq, popup_title as title, popup_link as link, popup_banner as popup_banner
          from ' . $CONFIG_DB['prefix'] . 'popup_info
         where popup_expire_date >= :today
           and popup_active = 1
         order by popup_expire_date desc
         limit 1
        ';

    $sth = $CONFIG_DB['handler']->prepare($query);
    $sth->execute(array(':today' => date('Y-m-d H:i:s')));
    $banner = $sth->fetch(PDO::FETCH_ASSOC);

    return $banner;

}
*/

// end of file
