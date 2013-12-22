<?php
/**
 * 화면출력 일괄처리
 *
 * @param string $publish_data['layout_path'] Path of Layout files
 * @example
	$publish_data['layout_path'] = LAYOUT_PATH . 'basic/';
	include_once(PROC_PATH . 'publish.proc.php');
 */

if(!defined('__MAPC__')) { exit(); }

{ // BLOCK:publish_hook_include:2013-01-21:publish hook 파일 첨부

	if(is_array($publish_hook)) {

		foreach($publish_hook as $file => $dir) {

			include($dir . $file);

		}

	}

	if(is_file(SITE_PATH . 'proc/publish_hook.proc.php')) {

		include(SITE_PATH . 'proc/publish_hook.proc.php');

	}

} // BLOCK


{ // BLOCK:include_library:2013-03-28:필요한 라이브러리 첨부

    include(LIBRARY_PATH . 'mapc/file_skin_include.func.php');

} // BLOCK


{ // BLOCK:include_layout:20121202:레이아웃파일 불러오기

    $publish_data['head']['meta'] = (! empty($publish_data['head']['meta'])) ? $publish_data['head']['meta'] : $CONFIG['meta'];

	if(empty($publish_data['layout_path'])) {

		$publish_data['layout_path'] = LAYOUT_PATH . $CONFIG['layout'] . '/default.tpl.php';

	}

    switch($CONFIG['show']) {

        case 'embed':   // embed 일 경우 head태그 없이 본문만 바로 출력
            mapc_file_skin_include($section_file, $section_data);
            break;

        default:
            include($publish_data['layout_path']);
            break;

    }

} // BLOCK

// End of file
