<?php

function module_mapc_postmeta_get($post_id, $lang, $option = array()) {

    global $CONFIG_DB;
	$dbh = $option['dbh'];

    $query = '
        select postmeta_post_uid, postmeta_lang, postmeta_key, postmeta_value, postmeta_etc
          from ' . $CONFIG_DB['prefix'] . 'mapc_postmeta
         where postmeta_post_uid = ?
           and postmeta_lang = ?
        ';

    $sth = $dbh->prepare($query);
    $sth->execute( array($post_id, $lang) );
    while($result = $sth->fetch(PDO::FETCH_ASSOC)) {

        $etc = $result['postmeta_etc'];
        $key = $result['postmeta_key'];
        $val = $result['postmeta_value'];

        // #TODO 아래의 조건문 간단하게 하는 방법 없을까?
        $return[$key][] = $val;
    }

    return $return;

}

// this is it
