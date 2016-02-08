<?php
namespace Mapc\Module\Mapc;

/*
post_title
post_content
post_origin_url
post_write_date
post_edit_date_latest
post_status = ''
post_etc = ''
*/

/**
 *
 * post create/edit
 *
 * @param array  $postinfo
 * @param object $option['dbh']      PDO DB handler
 * @param string $option['prefix']   prefix for db table (ie. 'mc_')
 * @param bool   $option['isCreate'] true : create / false : update
 *
 */

function postUpdate($postInfo, $option) {

    // 새 글일 경우 "글쓴날"에 현재시간을 판올림일 경우 "편집일"에
    if($option['isNew']) {

        $query = "
            INSERT INTO " . $option['prefix'] . "mapc_post
                SET post_title         = :title
                  , post_lang          = :lang
                  , post_content       = :content
                  , post_content_type  = :content_type
                  , post_write_date    = :date
                  , post_origin_type   = :origin_type
                  , post_origin_server = :origin_server
                  , post_origin_url    = :origin_url
                  , post_status        = :status
                  , post_etc           = :etc
                  , post_uid           = :uid
            ";

        // 글쓴날 말고 고친날 값도 같이 들어왔을 경우(그림 화일은 찍은날이 "글쓴날" 그림 올린날을 "편집일"로 지정함)
        if(! empty($postInfo['date_edit']) ) {
            $query .= ', post_edit_date_latest = :date_edit ';
        }

    } else {

        $query = "
            UPDATE " . $option['prefix'] . "mapc_post
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

  	$res = $option['dbh']->prepare($query);
  	$res->bindParam(':uid',        $uid,                    PDO::PARAM_STR);
    $res->bindParam(':lang',       $postInfo['lang'],       PDO::PARAM_STR);
  	$res->bindParam(':title',      $postInfo['title'],      PDO::PARAM_STR);
  	$res->bindParam(':date',       $postInfo['date']        PDO::PARAM_STR);
  	$res->bindParam(':content',    $postInfo['content'],    PDO::PARAM_STR);
  	$res->bindParam(':origin_type',$postInfo['origin_type'],PDO::PARAM_STR);
  	$res->bindParam(':origin_url', $postInfo['origin_url'], PDO::PARAM_STR);
  	$res->bindParam(':status',     $postInfo['status'],     PDO::PARAM_STR);
  	$res->bindParam(':etc',        $postInfo['etc'],        PDO::PARAM_STR);
    if(! empty($postInfo['date_edit']) ) {
        $res->bindParam(':date_edit', $postInfo['date_edit'], PDO::PARAM_STR);
    }

    $return = $res->execute();

    return $return;

}

// this is it
