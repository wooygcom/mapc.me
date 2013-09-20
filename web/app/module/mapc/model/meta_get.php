<?php

function module_mapc_meta_get($dbh, $post_id, $option = 'id') {

    $query = '
        select meta_id, post_id, post_uid, meta_key, meta_value
          from mapc_postmeta
         where post_id = "' . $post_id . '"
        ';

    $sth = $dbh->prepare($query);
    $sth->execute();
    while($result = $sth->fetch(PDO::FETCH_ASSOC)) {

        $key = $result['meta_key'];
        $val = $result['meta_value'];

        $return[$post_id][$key] = $val;

    }

    return $return;

}

// this is it
