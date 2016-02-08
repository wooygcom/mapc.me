<?php
if(!defined('__MAPC__')) { exit(); }
/**
 * 글편집
 */

require(INIT_PATH . 'init.db.php');
{ // Model : Head

    $mapcConfig = include(__DIR__ . '/config/config.php');
    // $mapcConfig['crud']['req'] = 'post_uid, post_title, post_content',
    // $mapcConfig['crud']['option'] = 'post_origin_type, post_origin_url, post_user_uid, post_user_name',

/////////////////////////////////////////////////////// 여기까지
/*
    #TODO 마크다운 화일이 저장될 때 내용안의 ![그림](그림위치).... 그림위치 부분을 <?= $mapcConfig['url']['file'] . $그림UID; ?> 로 자동으로 바뀌도록 해야됨!!!
*/


} // Model : Tail

// ======================================================================

{ // View : Head

    $VIEW['actionUrl'] = $URL['core']['root'] . 'mapc/posts';
    $VIEW['link_to']   = $_REQUEST['link_to'];

} // View : Tail

// end of file
