<?php
/**
 * 글 등록
 *
 * @param string $uid
 * @param string $title
 * @param object $arg['dbh'];
 */

/*

post_title
post_content
post_origin_url
post_write_date
post_edit_date_latest
post_status = ''
post_etc = ''
*/

function module_mapc_post_update(&$uid, &$post_info, &$arg = array()) {

	global $CONFIG_DB;

    // 새 글일 경우 "글쓴날"에 현재시간을 판올림일 경우 "편집일"에
    if($arg['is_new_post']) {

        $query = "
            INSERT INTO " . $CONFIG_DB['prefix'] . "mapc_post
                SET post_title      = :title
                  , post_lang       = :lang
                  , post_content    = :content
                  , post_write_date = :date
                  , post_origin_type= :origin_type
                  , post_origin_url = :origin_url
                  , post_status     = :status
                  , post_etc        = :etc
                  , post_uid        = :uid
            ";

        // 글쓴날 말고 고친날 값도 같이 들어왔을 경우(그림 화일은 찍은날이 "글쓴날" 그림 올린날을 "편집일"로 지정함)
        if(! empty($post_info['date_edit']) ) {
            $query .= ', post_edit_date_latest = :date_edit ';
        }

    } else {

        $query = "
            UPDATE " . $CONFIG_DB['prefix'] . "mapc_post
                SET post_title      = :title
                  , post_content    = :content
                  , post_edit_date_latest = :date 
                  , post_origin_type= :origin_type
                  , post_origin_url = :origin_url
                  , post_status     = :status
                  , post_etc        = :etc
             WHERE post_uid         = :uid
               AND post_lang       = :lang
            ";

    }

	$res = $arg['dbh']->prepare($query);
	$res->bindParam(':uid',        $uid,                     PDO::PARAM_STR);
    $res->bindParam(':lang',       $arg['lang'],             PDO::PARAM_STR);
	$res->bindParam(':title',      $post_info['title'],      PDO::PARAM_STR);
	$res->bindParam(':date',       $post_info['date']);
	$res->bindParam(':content',    $post_info['content'],    PDO::PARAM_STR);
	$res->bindParam(':origin_type',$post_info['origin_type'],PDO::PARAM_STR);
	$res->bindParam(':origin_url', $post_info['origin_url'], PDO::PARAM_STR);
	$res->bindParam(':status',     $post_info['status'],     PDO::PARAM_STR);
	$res->bindParam(':etc',        $post_info['etc'],        PDO::PARAM_STR);
    if(! empty($post_info['date_edit']) ) {
        $res->bindParam(':date_edit', $post_info['date_edit'], PDO::PARAM_STR);
    }
	$return = $res->execute();

    return $return;

}

// this is it
