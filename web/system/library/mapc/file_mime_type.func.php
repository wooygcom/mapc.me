<?php
/**
 * 확장자 기준으로 화일 MIME타입 가져오기
 */
function mapc_file_mime_type($extension) {
    switch($extension) {
        case 'png':
            $return['mime_type'] = 'image/png';
            break;
        case 'jpg':
            $return['mime_type'] = 'image/jpeg';
            break;
        case 'gif':
            $return['mime_type'] = 'image/gif';
            break;
        case 'md':
            $return['mime_type'] = 'text/markdown';
            break;
        case 'txt':
            $return['mime_type'] = 'text/plain';
    }

    return $return;
}
