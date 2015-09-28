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

        case 'text/url':
        case 'text/plain':
        default:
            echo '<p>' . $content . '</p>';
            break;

        case 'text/markdown':
			// 원본글의 경로를 기준으로 이미지 기준경로 찾기
			$tmp_file  = pathinfo($origin_file);
			$path_info = $tmp_file['dirname'];
            $path_info = str_replace('/original/', '/thum/', $path_info);

			$md_content = file_get_contents($origin_file);
			// 마크다운 변환 : $content_html = Parsedown::instance()->parse($content);
            require_once VENDOR_PATH . 'erusev/parsedown/Parsedown.php';
            $parse = new Parsedown;
            $parse->setImagePath($path_info . '/');
            $content_html = $parse->parse($md_content);

            echo $content_html;
            break;

    }

}

// this is it
