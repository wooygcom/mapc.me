<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 글보기
 */
// #TODO 똑같은 주제/형태의 글 다시 쓰기 (새로운 UID로)
// #TODO 제목 -> SLUG로 바꿀 때 특수문자 제거 (쌍따옴표 마침표 따위)
// #TODO 마크다운 또는 텍스트는 첫줄(제목)을 생략하고 출력

require(INIT_PATH.'init.db.php');
{ // Model : Head

    { // BLOCK:post_get:20131023:글 정보 가져오기

    	// $post_info, $postmeta_info 가져오기
        $arg['mapc_lang'] = $ARGS['mapc_lang'] ? $ARGS['mapc_lang'] : $CONFIG['lang'];
        include_once($PATH['mapc']['root'] . 'model/post_get.proc.php');

    } // BLOCK

    { // BLOCK:personal_info_get:2013-01-18:로그인한 사용자의 개별 디렉터리 반환

        // $arg['user_dir'], $arg['data_dir'] return
        include($PATH['mapc']['root'] . 'model/path_get_per_user.proc.php');

    } // BLOCK

    { // BLOCK:get_data:2012081701:읽으려는 파일의 종류, 파일 위치 가져오기

        $data_origin = $PATH['mapc']['data'] . $arg['user_dir'] . 'original/' . $postmeta_info['mapc_dir'][0] . $postmeta_info['rdf_about'][0];
        $data_thum   = $PATH['mapc']['data'] . $arg['user_dir'] . 'thum/'     . $postmeta_info['mapc_dir'][0] . $postmeta_info['rdf_about'][0];
        $arg['file_name_qwer'] = is_file($data_thum) ? $data_thum : $data_origin;

        $tmp = pathinfo($postmeta_info['rdf_about'][0]);
        $postmeta_info['slug'][0] = $tmp['filename'];

    } // BLOCK

    { // BLOCK:prev_and_next:20131218:이전글,다음글 UID 가져오기

        // #TODO 검색조건에 따라서 이전글 다음글 불러오는 로직도 바꿀것!!!
        // #TODO DB에서 바로불러오는게 아니라 텍스트에 각 검색결과에 따른 이전글 다음글을 저장해놓고 (search_type-text_subject-memo.txt 형태) 불러오기는 어떨까?

        $query = "
            SELECT post_uid FROM " . $CONFIG_DB['prefix'] . "mapc_post WHERE post_seq < ? ORDER BY post_seq DESC LIMIT 1
            ";
        $sth = $CONFIG_DB['handler']->prepare($query);
        $sth->execute(array($post_info['post_seq']));
        $view_prev = $sth->fetch();

    } // BLOCK

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

    if(in_array('BGHWTSPXA18Y3KF7QLC6', $postmeta_info['dc_subject_id']))
    { // BLOCK:get_another_lang:20131230:덧붙임2. 주제가  홀로이름씨(영화이름, 책이름 따위)일 경우 이 글을 연결하고 있는 다른 글들

        $query = "
			SELECT post_uid, post_title FROM dbname.mc_mapc_post where post_uid IN (
			            select postmeta_post_uid
			              from " . $CONFIG_DB['prefix'] . "mapc_postmeta
			             where postmeta_key = 'dc_subject_id'
			               and postmeta_value = ?
			)
			and post_lang = ?
            ";
        $sth = $CONFIG_DB['handler']->prepare($query);
        $sth->execute(array($arg['mapc_uid'], $arg['mapc_lang']));
        $title_same_subject = $sth->fetchAll(PDO::FETCH_ASSOC);

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

} // Model : Tail

// ======================================================================

{ // View : Head

    $VIEW['head']['meta'] = $CONFIG['meta'];
    $VIEW['head']['meta']['title']       = $post_info['post_title'] . ' - ' . $VIEW['head']['meta']['title'];
    $VIEW['head']['meta']['type']        = $post_info['post_origin_type'];
    // 원본그림
    
    if(strpos($post_info['post_origin_type'], 'image/') == true) {
        $VIEW['head']['meta']['image']   = $post_info['post_origin_url'];
    // 원본이 없으면 기본 이미지
    } else {
        // #TODO 사이트 기본이미지
    }
    // #TODO mod_rewrite에서 /module/page/[글번호] 가져올 수 있게끔 처리!!!
    $VIEW['head']['meta']['url']         = $URL['mapc']['view'] . 'mapc_uid/' . $ARGS['mapc_uid'] . '/';
    $VIEW['head']['meta']['description'] = $postmeta_info['dc_description'][0];
    $VIEW['head']['meta']['keywords']    = (is_array($postmeta_info['dc_subject'])) ? implode(",", $postmeta_info['dc_subject']) : '';

    $section_file = $PATH['module']['skin'] . 'view.view.php';

} // View : Tail

// end of file
