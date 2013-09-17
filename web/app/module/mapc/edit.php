<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 글쓰기
 */

require(INIT_PATH.'common.head.init.php');
{ // Model : Head

	{ // BLOCK:module_include:20120912:필요한 모듈 첨부

		require_once(MODULE_PATH	. 'mapc/config/config_mapc.php');
		require_once(LIBRARY_PATH	. 'file.func.php');

	} // BLOCK


	{ // BLOCK:arg_check:2012081701:넘어온 값 점검

		// 글의 고유값, Unique ID of article
		$mapc_uid = $_GET['mapc_uid'];
		// 카테고리, Category
		$mapc_cate= $_GET['mapc_cate'];

	} // BLOCK


    { // BLOCK

       include_once($PATH['mapc']['root'] . 'model/meta_get_asfk.func.php');
       $return = meta_get_asfk($CONFIG_DB['handler'], 1);

    } // BLOCK


	{ // BLOCK:tpl_load_by_cate:2012081701:Format에 따라 템플릿 부르기(입력하는 내용에 따라 화면출력을 다르게 하려고)

		// #todo
		// Format... 논문, 메모, 일기, 영화감상, 유머 여부에 따라서
		// 내용만 입력받을지, 주제에는 무슨무슨 내용을 자동으로 넣을지 결정...

	} // BLOCK


} // Model : Tail
require(INIT_PATH.'common.tail.init.php');

// ======================================================================

{ // View : Head

    include_once($PATH['mapc']['root'] . 'model/dc_get.func.php');

    // #todo /data/mapc/사용자 디렉토리에서 가져오게끔... 없으면 default
    $section_file['mapc_edit']                      = $PATH['mapc']['root'] . 'view/basic/edit.view.php';
    $section_data['mapc_edit']['dc_edit_run_url']   = $URL['mapc']['edit_run'];
    $section_data['mapc_edit']['dc']                = mapc_dc_get($mapc_uid, $PATH['mapc']['data']);

	/*
	#TODO 옵션
		특정 디렉토리만 선택해서 파일들 보이게 하기
		전체보기 할 때는... ->
		dc파일이 없는 파일부터 보이기, 몇월몇일꺼만 보이게하기, 특정파일이름만 검색해서보이기
		모두보이기
	*/
echo '<xmp>';
print_r(mapc_dir_list($PATH['mapc']['data']));
echo '</xmp>';
	$publish_data['layout_path'] = LAYOUT_PATH . $CONFIG['layout'] . '/';
	include_once(PROC_PATH . 'publish.proc.php');

} // View : Tail

// end of file
