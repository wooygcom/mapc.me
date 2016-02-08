<?php

function popup_get_banner($seq) {

    global $CONFIG_DB;

    // 기존화일 가져오기...
    $query = '
        select popup_banner from ' . $CONFIG_DB['prefix'] . 'popup_info
         where popup_seq = :seq
        ';
    $sth = $CONFIG_DB['handler']->prepare($query);
    $sth->execute(array(':seq' => $seq));
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    $file_name = $result['popup_banner'];

    return $file_name;

}

// end of file