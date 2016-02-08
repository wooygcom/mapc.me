<?php
if(!defined('__MAPC__')) { exit(); }

require(INIT_PATH . 'init.admin.php');
{ // MODEL : Start

    $seq = $ARGS['seq'];

    include(__DIR__ . '/model/popup_get_banner.func.php');
    $old_file_name = popup_get_banner($seq);
    $save_dir = DATA_PATH . 'popup/';
    unlink($save_dir . $old_file_name);

    $query = '
        delete from ' . $CONFIG_DB['prefix'] . 'popup_info
         where popup_seq = :seq
        ';
    $sth = $CONFIG_DB['handler']->prepare($query);
    $sth->execute(array(':seq' => $seq));

} // MODEL : Finish


{ // View : Start

    if(!$error) {
        header('location:' . $URL['core']['root'] . 'admin-popup/list/result/success/');
    } else {
        header('location:' . $URL['core']['root'] . 'admin-popup/list/result/error/');
    }

} // View : Finish

// this is it
