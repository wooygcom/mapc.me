<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 글쓰기
 */

require(INIT_PATH.'common.head.init.php');
{ // Model : Head

	{ // BLOCK:module_include:20120912:필요한 모듈 첨부

        include_once($PATH['mapc']['root'] . 'model/mapc_dc_get.func.php');

	} // BLOCK


	{ // BLOCK:arg_check:2012081701:넘어온 값 점검

		// 글의 고유값, Unique ID of article
		$mapc_uid  = $_REQUEST['mapc_uid'];
		// 글 URL
		$mapc_slug = $_REQUEST['mapc_slug'];
		// 카테고리, Category
		$mapc_cate = $_REQUEST['mapc_cate'];

	} // BLOCK


    { // BLOCK:meta_get:20130921:메타데이터 가져오기

$option = array();
$option['dir'] = $PATH['mapc']['data'];
$option['slug']= $mapc_slug;

$meta = mapc_dc_get($mapc_uid, $option);

		// #TODO
/*
        include_once($PATH['mapc']['root'] . 'model/meta_get.func.php');
        $return = module_mapc_meta_get($CONFIG_DB['handler'], 1);
*/

    } // BLOCK


	{ // BLOCK:tpl_load_by_cate:2012081701:분류에 따라 템플릿 부르기(입력하는 내용에 따라 화면출력을 다르게 하려고)

		// #todo
		// Format... 논문, 메모, 일기, 영화감상, 유머 여부에 따라서
		// 내용만 입력받을지, 주제에는 무슨무슨 내용을 자동으로 넣을지 결정...

	} // BLOCK


} // Model : Tail
require(INIT_PATH.'common.tail.init.php');

// ======================================================================

{ // View : Head

    // #todo /data/mapc/사용자 디렉토리에서 가져오게끔... 없으면 default
    $section_file = $PATH['mapc']['root'] . 'view/basic/edit.view.php';
	include_once(PROC_PATH . 'publish.proc.php');

} // View : Tail

// end of file
