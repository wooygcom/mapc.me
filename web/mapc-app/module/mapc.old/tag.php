<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 글목록
 */

require(INIT_PATH.'init.db.php');
{ // MODEL : Head

    $query = "
        select postmeta_value as name, count(postmeta_value) as num from " . $CONFIG_DB['prefix'] . "mapc_postmeta 
         where postmeta_key = 'dc_subject'
         group by postmeta_value
         having count(postmeta_value) > 0
          order by count(postmeta_value) desc
        ";

    $sth = $CONFIG_DB['handler']->prepare($query);

    $sth->execute();
    $tag_list = $sth->fetchAll(PDO::FETCH_ASSOC);

} // MODEL : Foot

// end of file
