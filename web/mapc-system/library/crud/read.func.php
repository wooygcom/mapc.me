<?php
namespace Mapc\Library\Crud;

use PDO;

if(!defined('__MAPC__')) { exit(); }

/**
 *
 * 자료 읽어오기
 *
 * $dbType
 * $table
 * $fields
 * $dbh
 *
 */

function crudRead($options = []) {

    extract($options);

    $return = [];

    switch($dbType) {

        case 'mysql':
        default:

            $query = "
                SELECT " . $fields . "
                  FROM " . $table . "
                 WHERE " . $keyField . " = :keyValue
                 LIMIT 1
            ";

            $sth = $dbh->prepare($query);

            $sth->execute([':keyValue' => $keyValue]);

            $return = $sth->fetch(PDO::FETCH_ASSOC);

            break;

    }

    return $return;

}

// end of file
