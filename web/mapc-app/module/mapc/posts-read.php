<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 글보기
 */
// #TODO 똑같은 주제/형태의 글 다시 쓰기 (새로운 UID로)
// #TODO 제목 -> SLUG로 바꿀 때 특수문자 제거 (쌍따옴표 마침표 따위)
// #TODO 마크다운 또는 텍스트는 첫줄(제목)을 생략하고 출력

require_once(INIT_PATH.'init.db.php');
{ // Model : Head

    { // BLOCK:init:20151226

        // module/모듈명/config/config.php
        $mapcConfig = include_once(__DIR__ . '/config/config.php');

    } // BLOCK

    { // BLOCK:post_get:20131023:글 정보 가져오기

        // $post['main'], $post['meta'] 가져오기
        include(__DIR__ . '/model/postsRead.proc.php');

    } // BLOCK

    { // BLOCK:get_data_path_per_user:2013-01-18

        // $arg['user_dir'], $arg['data_dir'] return (private directory of logged in user)
        include_once(__DIR__ . '/model/dataPathRead.func.php');

        // 자료디렉토리 상대주소
        $dataPath = Mapc\Module\Mapc\dataPathRead($mapcConfig['path']['data'], [
            'type' => $_SESSION['mapc_user_type'],
            'id'   => $_SESSION['mapc_user_uid']
        ]);

        // 자료디렉토리 절대주소
        $dataPathAbs = $mapcConfig['path']['data'] . $dataPath;

    } // BLOCK

/////////////////////////////////////////////////////// 여기까지

/*
    { // BLOCK:get_another_lang:20131230:덧붙임1. 다른 언어로 된 글 제목 가져오기

        $query = "
            select postmeta_lang, postmeta_value
              from " . $CONFIG_DB['prefix'] . "mapc_postmeta
             where postmeta_key = 'dc_title'
               and postmeta_post_uid = ?
            ";
        $sth = $CONFIG_DB['handler']->prepare($query);
        $sth->execute(array($arg['mapc_uid']));
        $title_another_lang = $sth->fetchAll(PDO::FETCH_ASSOC);

    } // BLOCK

    { // BLOCK:get_another_lang:20131230:덧붙임3. 이 글과 같은 주제의 글 리스트 보기

        $so_query = "
            SELECT distinct postmeta_key, postmeta_value
              FROM " . $CONFIG_DB['prefix'] . "mapc_postmeta
             WHERE postmeta_key = :search_key
            ";

        $so_sth = $CONFIG_DB['handler']->prepare($so_query);

        $so_search_key = 'dc_subject';
        $so_sth->bindParam(':search_key', $so_search_key, PDO::PARAM_STR);
        $so_sth->execute();
        $so_rlt['dc_subject'] = $so_sth->fetchAll(PDO::FETCH_ASSOC);

    } // BLOCK

    { // BLOCK:get_data:2012081701:읽으려는 파일의 종류, 파일 위치 가져오기

        include($PATH['mapc']['root'] . 'model/convert_file.func.php');

    } // BLOCK
*/

    { // BLOCK:get_data:2012081701:원본 파일의 종류, 파일 위치 가져오기

        $dataOrigin   = $dataPathAbs . 'original/' . $post['meta']['mapc_dir'][0] . $post['meta']['rdf_about'][0];
        $dataThum     = $dataPathAbs . 'thum/'     . $post['meta']['mapc_dir'][0] . $post['meta']['rdf_about'][0];
        $dataFileName = is_file($dataThum) ? $dataThum : $dataOrigin;

        $post['meta']['slug'][0] = pathinfo($post['meta']['rdf_about'][0])['filename'];

    } // BLOCK

} // Model : Tail

// ======================================================================

{ // View : Head

    $VIEW['meta']['contentTitle'] = $post['main']['post_title'] . ' - ' . $VIEW['meta']['title'];
    $VIEW['meta']['type']  = $post['main']['post_origin_type'];
// #TODO $VIEW['meta']['url'] 에 http://domain.com 추가
    $VIEW['meta']['url']         = $mapcConfig['url']['root'] . 'posts/' . $ARGS['id'] . '/';
    $VIEW['meta']['description'] = $post['meta']['dc_description'][0];
    $VIEW['meta']['keywords']    = (is_array($post['meta']['dc_subject'])) ? implode(",", $post['meta']['dc_subject']) : '';

    $VIEW['url']['mapc'] = $mapcConfig['url']['post'];

    include_once(LIBRARY_PATH . 'mapc/fileConvert.func.php');
    $VIEW['content'] = Mapc\Library\Mapc\fileConvert([
        'type' => $post['main']['post_origin_type'],
        'url'  => $mapcConfig['url']['file']  . $post['main']['post_uid'],
        'path' => $mapcConfig['path']['data'] . $post['main']['post_origin_url'],
        'content' => $post['main']['post_content']
    ]);

    // 원본그림
    if(strpos($post['main']['post_origin_type'], 'image/') == true) {
// #TODO post_origin_url에 http://domain.com 추가
        $VIEW['meta']['image']   = $post['main']['post_origin_url'];
// #TODO 원본이 없으면 기본 이미지 사이트 기본이미지
    }

} // View : Tail

// end of file
