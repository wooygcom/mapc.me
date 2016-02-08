<?php
/**
 * 스킨파일 include 하기 위한 함수
 * 
 * $TPL_DATA['data1'] 같은 변수를 템플릿 화일안에서
 * $user_name, $list 같은 흔한 변수명을 사용하더라도 다른변수들과 충돌하지 않으면서
 * 템플릿안의 변수명을 수정하지 않고 사용할 수 있도록 하기위해 만든 함수
 *
 * @param array $tpl
 * @param string $path_of_file path/to/file
 * @param mixed  $data  템플릿안에 들어갈 변수들
 * @example
 *		$VIEW['_paging']['file'] = $PATH['paging']['root'] . 'view/basic/paging.view.php';
 *		$VIEW['_paging']['data'] = $paging;
 *		mapc_file_skin_include($VIEW['_paging']['file'], $VIEW['_paging']['data']);
 */

function mapc_file_skin_include($path_of_file, $VIEW = array()) {

	include($path_of_file);

}

// this is it
