<?php
namespace Mapc\Module\User;

use PDO;

function infoGet($option) {

    extract($option);

    $query = '
        select user_name, fk_user_group_uid as user_group_uid from ' . $prefix . 'user_info
         where user_uid = ?
        ';

    $stm = $dbh->prepare($query);
    $stm->execute([$userUid]);
    $result = $stm->fetch(PDO::FETCH_ASSOC);

    return $result;

}

// this is it
