<?php
function module_user_name_get($user_uid = '') {

    global $CONFIG_DB;

    $query = '
        select user_name from ' . $CONFIG_DB['prefix'] . 'user_info
         where user_uid = ?
        ';

    $stm = $CONFIG_DB['handler']->prepare($query);
    $stm->execute(array($user_uid));
    $result = $stm->fetch(PDO::FETCH_ASSOC);

    return $result['user_name'];

}

// this is it
