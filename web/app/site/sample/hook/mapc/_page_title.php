<?php
switch($ARGS['mapc_cate']) {
    case 'image':
        $VIEW['page_title'] = _('그림');
        break;
    case 'news':
        $VIEW['page_title'] = _('새소식');
        break;
    default:
        $VIEW['page_title'] = _('게시판');
        break;
}

// end of file
