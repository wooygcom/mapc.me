<?php
if(!defined('__MAPC__')) { exit(); }

require(INIT_PATH . 'init.admin.php');
{ // MODEL : Start

    $query = '
        select popup_seq as seq, popup_title as title, popup_banner as banner, popup_expire_date as expire_date, popup_active as active
          from ' . $CONFIG_DB['prefix'] . 'popup_info
        ';
    $sth = $CONFIG_DB['handler']->prepare($query);
    $sth->execute();
    $VIEW['popup_list'] = $sth->fetchAll(PDO::FETCH_ASSOC);

} // MODEL : Finish


{ // View : Start

    $active_key = 'etc';

} // View : Finish

// this is it
