<?php
if(!defined('__MAPC__')) { exit(); }
/**
 * 글편집
 */

require(INIT_PATH . 'init.auth.php');
{ // Model : Head

	{ // BLOCK:post_get:20131023:글 정보 가져오기

        $mapc_cate = $ARGS['mapc_cate'];

        // dc_identifier값이 없을 경우 새 글
        if(empty($_REQUEST['mapc_uid'])) {
            $is_new_post = TRUE;
        }

		include_once(MODULE_PATH  . 'user/config/config.php');
		include_once(LIBRARY_PATH . 'mapc/dir_list.func.php');

        $arg['mapc_lang'] = $_REQUEST['mapc_lang'] ? $_REQUEST['mapc_lang'] : $CONFIG['lang'];
		include_once($PATH['mapc']['root'] . 'model/post_get.proc.php');

        // 새 글 쓰기 일 경우 기본값은 markdown
        if(empty($post_info['post_uid'])) {
            $post_info['post_origin_type'] = 'text/markdown';
        }

	} // BLOCK

    { // BLOCK:personal_info_get:2013-01-18:로그인한 사용자의 개별 디렉터리 반환

        // $arg['user_dir'], $arg['data_dir'] return
        include($PATH['mapc']['root'] . 'model/path_get_per_user.proc.php');

    } // BLOCK

	{ // BLOCK:get_data:2012081701:읽으려는 파일의 종류, 파일 위치 가져오기

		$data_file = $postmeta_info['mapc_dir'][0] . $postmeta_info['rdf_about'][0];
		$arg['file_name_qwer'] = $data_file;
		$tmp = pathinfo($postmeta_info['rdf_about'][0]);
        // $tmp['filename']을 그대로 slug에 넣으려 했으나 한글화일은 깨지는 경우가 생겨서 원래 이름에 확장자를 지우는 형태로 함
        // "한-글-화-일.txt" 라는 화일을 pathinfo함수에서 돌렸더 ""-글-화-일.txt"" 처럼 깨져버림;;;
		// $postmeta_info['slug'][0] = $tmp['filename'];
		$postmeta_info['slug'][0] = str_replace('.'.$tmp['extension'], '', $postmeta_info['rdf_about'][0]);

	} // BLOCK

	{ // BLOCK:dir_list_get:20131116:서버 디렉토리 구조 가져오기(업로드 위치 지정하는 곳에 뿌려주기 위함)

		$option['show_sub']  = true;
		$option['hide_file'] = true;
        if(is_dir($PATH['mapc']['data'] . $arg['user_dir'] . 'original/')) {
            $server_list = mapc_dir_list($PATH['mapc']['data'] . $arg['user_dir'] . 'original/', $option);
        }

	} // BLCOK

    { // BLOCK:mapc_edit_cate:20131125:글쓰기 종류별로 기본 입력해야 되는 값들을 미리 준비하기

        if($is_new_post) {

            if(! empty($mapc_cate_edit)) {
                extract($CONFIG_MODL_MAPC['edit'][$mapc_cate_edit]);
            }

            $postmeta_info['dc_language'][0] = $CONFIG['lang'];
            $publish_check_option['mapc_slug_change_by_title'] = true;

        } else {

            $publish_check_option['mapc_slug_change_by_title'] = false;

        }

    } // BLOCK

} // Model : Tail

// ======================================================================

{ // View : Head

    $VIEW['mapc_cate'] = $mapc_cate;

    $VIEW['head']['css']['jquery-ui.min.css'] = $URL['core']['root'] . 'res/jquery-ui/css/default/';
    $VIEW['head']['js']['jquery.min.js']      = $URL['core']['root'] . 'res/jquery/';
    $VIEW['head']['js']['jquery-ui.min.js']   = $URL['core']['root'] . 'res/jquery-ui/js/';

	if(false) { // dropzone을 사용할 경우에만 true // #TODO dropzone을 사용할지 여부(또는 어떤 업로드 모듈을 사용할지 옵션을 지정할 수 있게...)
	    $VIEW['head']['css']['dropzone.css'] = $URL['core']['root'] . 'res/dropzone/css/';
	    $VIEW['head']['js']['dropzone.min.js']   = $URL['core']['root'] . 'res/dropzone/';
	}

    $VIEW['action_url'] = $URL['mapc']['edit_act'];
    $VIEW['link_to']    = $_REQUEST['link_to'];
    $section_file = $PATH['module']['skin'] . 'edit.view.php';

} // View : Tail

// end of file
