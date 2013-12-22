<?php
/**
 *
 * 화면출력 일괄처리 간단버전
 *
 * @param string $display_type 어떤 방식으로 화면에 출력할지
 * @param string $url          이동하려는 페이지 주소
 * @param string $message      출력하려는 내용
 *
 */

if(!defined('__MAPC__')) { exit(); }

{ // BLOCK:publish_hook_include:2013-01-21:publish hook 파일 첨부

    $temp_head_code = '';
    switch($display_type) {
        // 페이지 이동일 경우
        case 'move':
            $temp_head_code = '<meta http-equiv="refresh" content="0;url=' . $url . '">';
            $message        = (! empty($message)) ? $message : $url;
            // 이 자리에는 break문을 넣지 않음!!!
        case 'message':
            echo '<html><head><meta charset="utf-8">';
            echo $temp_head_code;
            echo '</head><body>';
            echo '<a href="' . $url . '">' . $message . '</a>';
            echo '</body></html>';
            break;
        case 'json':
            break;
    }

} // BLOCK

// end of file
