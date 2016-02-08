<?php
/**
 * 화일 타입별로 브라우저 출력용으로 변환
 *
 * 브라우저 출력에 맞게끔 각 화일을 변환해주는 함수, 화면에 표시할 수 없는 화일은 다운로드링크로 변환
 */

function module_mapc_convert_file($type, $origin_file, &$content, $option = array()) {

    global $PATH;
    global $URL;

    include($PATH['mapc']['root'] . 'model/path_get_per_user.proc.php');

    switch($type) {
        case 'image/jpeg':
        case 'image/gif':
        case 'image/png':
            $file_thum = str_replace('/original/', '/thum/', $origin_file);
            $file_url = is_file($file_thum) ? $file_thum : $origin_file;

            echo '<a href="' . $URL['mapc']['file_view'] . 'mapc_uid/' . $option['post_uid'] . '"><img src="' . $URL['mapc']['file_view'] . 'mapc_uid/' . $option['post_uid'] . '" id="mapc_main_file" style="width:100%;" /></a>';
            echo '<p>' . $content . '</p>';
            break;

        case 'application/pdf':
            echo '[ <a href="' . $URL['mapc']['file_view'] . 'mapc_uid/' . $option['post_uid'] . '/display_direct/yes/">'. _('화일보기') . '</a> ]';
            echo '<p>' . $content . '</p>';
            break;

        case 'text/url':
        case 'text/plain':
            echo '<p>' . $content . '</p>';
            break;

        case 'text/markdown':
        default:
			// 원본글의 경로를 기준으로 이미지 기준경로 찾기
/*
// #TODO 이미지 경로 지정을 상대경로로 할지 절대경로로 할지... 
마크다운에서 image.jpg 라고 지정하면 바로 지정한 경로의 실제 이미지를 불러오게끔 (어차피 마크다운 편집할 때 이미지 경로같은건 신경 안쓸테니까...)
// 화일에서 가져오는 방식...
			$tmp_file  = pathinfo($origin_file);
			$path_info = $tmp_file['dirname'];
            $path_info = str_replace('/original/', '/thum/', $path_info);

            $md_content = file_get_contents($origin_file);
//            ParsedownExtra::instance()->setImagePath($URL['core']['root'] . 'mapc/file/');
*/

			// 마크다운 변환 : $content_html = Parsedown::instance()->parse($content);
            require_once VENDOR_PATH . 'erusev/parsedown/Parsedown.php';
            $content_html =  Parsedown::instance()->parse($content);

            echo $content_html;
            break;

    }

}

// this is it
