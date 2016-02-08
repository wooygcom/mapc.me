<?php
namespace Mapc\Library\Mapc;

/**
 *
 * 화일 타입별로 브라우저 출력용으로 변환
 *
 * 브라우저 출력에 맞게끔 각 화일을 변환해주는 함수, 화면에 표시할 수 없는 화일은 다운로드링크로 변환
 *
 * @param string $type    화일유형 (예 - image/jpeg, text/markdown, etc)
 * @param string $url     화일URL
 * @param string $path    화일PATH
 * @param string $content 내용 : 화일이 text/ 유형일 경우 content값이 넘어옴
 *
 */

function fileConvert($options) {

    extract($options);

    switch($type) {
        case 'image/jpeg':
        case 'image/gif':
        case 'image/png':
            $return = '<a href="' . $url . '"><img src="' . $url . '" id="mapc_main_file_qozv" style="width:100%;" /></a>';
            break;

        case 'application/pdf':
            $return = '[ <a href="' . $url . '">' . _('화일보기') . '</a> ]';
            break;

        case 'text/url':
            $return = nl2br($content);
            break;

        case 'text/plain':
            $return = '<p>' . $content . '</p>';
            break;

        case 'text/html':
            $return = $content;
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
//            \ParsedownExtra::instance()->setImagePath($URL['core']['root'] . 'mapc/file/');
*/

			// 마크다운 변환 : $content_html = Parsedown::instance()->parse($content);
            require_once VENDOR_PATH . 'erusev/parsedown/Parsedown.php';
            require_once VENDOR_PATH . 'erusev/parsedown-extra/ParsedownExtra.php';
            $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
            $return  = \ParsedownExtra::instance()->text($content);

            break;

    }

    return $return;

}

// this is it
