<?php
if(!defined('__MAPC__')) { exit(); }

require(INIT_PATH . 'init.db.php');
{ // MODEL : Start

    $seq = $ARGS['seq'];

    $query = '
        select popup_seq as seq, popup_title as title, popup_link as link, popup_content as content, popup_banner as banner, popup_expire_date as expire_date, popup_active
          from ' . $CONFIG_DB['prefix'] . 'popup_info
         where popup_seq = :seq
        ';
    $sth = $CONFIG_DB['handler']->prepare($query);
    $sth->execute(array(':seq' => $seq));
    $VIEW['popup_detail'] = $sth->fetch(PDO::FETCH_ASSOC);

} // MODEL : Finish


{ // View : Start

} // View : Finish

// this is it
