<?php
namespace Mapc\Library\Crud;

use PDO;

if(!defined('__MAPC__')) { exit(); }

/**
 *
 * list 가져오기
 *
 */

function crudList($options = []) {

    extract($options);

    $return = [];

    switch($dbType) {

        case 'mysql':
        default:

            $page      = $page    ? $page    :  1;
            $pageSet   = $pageSet ? $pageSet : 10;
            $pageStart = ($page - 1) * $pageSet;

            $where   = $where   ? " WHERE "    . $where   : '';
            $orderBy = $orderBy ? " ORDER BY " . $orderBy : '';
            $limit   = $page    ? " LIMIT :pageStart, :pageSet " : '';

            $query = "
                SELECT SQL_CALC_FOUND_ROWS " . $fields . "
                  FROM " . $table . "
                  " . $where . "
                  " . $orderBy . "
                  " . $limit . "
            ";

            $sth = $dbh->prepare($query);

            if($page) {
                $sth->bindParam(":pageStart", $pageStart, PDO::PARAM_INT);
                $sth->bindParam(":pageSet"  , $pageSet,   PDO::PARAM_INT);
            }

            if(! empty($where)) {
                foreach($whereValue as $key => $var) {
                    $sth->bindValue(":".$key, $var, PDO::PARAM_STR);
                }
            }

            $sth->execute();

            $i = 0;
            while($result = $sth->fetch(PDO::FETCH_ASSOC)) {

                // 게시판 글번호 정하기...
                $postNum = $total - (($page - 1) * $pageSet) - $i;
                $i++;

                $return['lists'][$postNum] = $result;

            }

            // 페이징에 필요한 전체 갯수 구하기
            $return['total'] = $dbh->query('SELECT FOUND_ROWS()')->fetch(PDO::FETCH_COLUMN);

            break;

    }

    return $return;

}

// end of file
