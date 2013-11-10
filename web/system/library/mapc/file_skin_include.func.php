<?php
/**
 * 스킨파일 include 하기 위한 함수
 * 
 * $TPL_DATA['data1'] 같은 변수를 템플릿 화일안에서
 * $user_name, $list 같은 흔한 변수명을 사용하더라도 다른변수들과 충돌하지 않으면서
 * 템플릿안의 변수명을 수정하지 않고 사용할 수 있도록 하기위해 만든 함수
 *
 * @param string $TPL_DATA[KEY]['file'] filename
 * @param mixed  $TPL_DATA[KEY]['data]  템플릿안에 들어갈 변수들
 * @example
 *		$TPL_DATA['paging']['file'] = $PATH['paging']['root'] . 'view/basic/paging.tpl.php';
 *		$TPL_DATA['paging']['data'] = $paging;
 *		mapc_file_skin_include($TPL_DATA['paging']['file'], $TPL_DATA['paging']['data']);
 */

function mapc_file_skin_include($file, $data = array()) {

	extract($data);
	include($file);
	
}

// this is it
