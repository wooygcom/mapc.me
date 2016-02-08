<?php
/**
 *
 * 글의 UID 가져오기
 *
 * @param string  $ARGS['mapc_search_key']  검색하려는 글의 제목
 *
 */

require(INIT_PATH.'init.db.php');
{ // Model : Head

    $mapc_search_key = '%' . $ARGS['mapc_search_key'] . '%';
    $query = 'SELECT post_uid, post_title, post_content FROM ' . $CONFIG_DB['prefix'] . 'mapc_post WHERE post_title like :search_key ';

    $sth = $CONFIG_DB['handler']->prepare($query);
    $sth->execute(array(':search_key' => $mapc_search_key));

    $return = $sth->fetchAll(PDO::FETCH_ASSOC);

    foreach ($return as $var) {
        $row['id']    = $var['post_uid'];
        $row['value'] = stripslashes($var['post_title']);
        $row['desc']  = stripslashes($var['post_content']);
        $row_set[]    = $row; // build an array
    }

} // Model : Tail

// ======================================================================

{ // View : Head

    echo json_encode($row_set);

} // View : Tail

// end of file
