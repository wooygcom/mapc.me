<?php
/**
 * 중복화일 체크
 *
 * DB안의 다른 글중에 똑같은 화일을 사용하는 글이 있는지 체크
 *
 * @param string  $file_path  중복확인하려는 화일 경로
 * @param handler $arg['dbh'] DB핸들러
 * // #TODO del.php에 화일중복체크하는 부분을 이 함수로 교체!!!!!
 */
function module_mapc_file_check_duplica($file_path, $dbh) {

    global $CONFIG_DB;

    $query = "
        SELECT COUNT(post_origin_url) as cnt
          FROM " . $CONFIG_DB['prefix'] . "mapc_post
         WHERE post_origin_url = ?
        ";
    $sth = $dbh->prepare($query);
    $sth->execute( array($file_path) );

    $return = $sth->fetch(PDO::FETCH_ASSOC);

    // 다른 post에서도 연결되어있는 화일이면 TRUE
    if($return['cnt'] > 1) {
        return true;
    // 아니면 FALSE
    } else {
        return false;
    }

}

// end of file
