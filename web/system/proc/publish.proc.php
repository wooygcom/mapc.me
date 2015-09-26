<?php
if(!defined('__MAPC__')) { exit(); }

/**
 *
 * 화면출력 일괄처리 간단버전
 *
 * @param string $display_type 어떤 방식으로 화면에 출력할지
 * @param string $url          이동하려는 페이지 주소
 * @param string $message      출력하려는 내용
 * @param string $VIEW['layout_path'] Path of Layout files
 *
 * @example
 *      $display_type = 'message';
 *      $message = _('로그인 되었습니다.');
 *      $url     = $URL['core']['root'];
 *      include PROC_PATH . 'publish_simple.proc.php';
 * @example
 *      $VIEW['layout_path'] = LAYOUT_PATH . 'basic/';
 *      include_once(PROC_PATH . 'publish.proc.php');
 * 
 */

/**
*/

{ // BLOCK:unset_security_var:2014-11-08:템플릿 출력에는 불필요한 환경설정 변수 삭제

	unset($CONFIG_SECRET);
	unset($CONFIG_DB);

} // BLOCK

{ // BLOCK:publish_hook_include:2013-01-21:publish hook 파일 첨부

    if(is_file(SITE_PATH . 'proc/publish_hook.proc.php')) {

        include(SITE_PATH . 'proc/publish_hook.proc.php');

    }

} // BLOCK

{ // BLOCK:display_option:20150830

    $VIEW['head']['meta'] = (! empty($VIEW['head']['meta'])) ? $VIEW['head']['meta'] : $CONFIG['meta'];
    $VIEW['layout_path']  = $VIEW['layout_path']  ? $VIEW['layout_path']  : LAYOUT_PATH . $CONFIG['layout'] . '/';
    $VIEW['layout_url']   = $VIEW['layout_url']   ? $VIEW['layout_url']   : $URL['core']['root'] . 'layout/' . $CONFIG['layout'] . '/';
    $VIEW['section_path'] = $VIEW['section_path'] ? $VIEW['section_path'] : PAGE_PATH . 'view/' . $CONFIG['skin'] . '/';

    // 출력옵션에 따라서...
    switch($display_type) {

        case 'move':

            header('location:' . $url);
            break;

        case 'html_alert':
        case 'html_simple':

            { // BLOCK:set_var_for_html_simple:2013-03-28:필요한 변수설정

                $VIEW['layout_file']  = $VIEW['layout_path'] . 'html_simple.tpl.php';

            } // BLOCK

            break;

        default:


            { // BLOCK:set_var:2013-03-28:필요한 변수설정

                $VIEW['layout_file']  = $VIEW['layout_file']  ? $VIEW['layout_file']  : $VIEW['layout_path'] . 'html_default.tpl.php';

            } // BLOCK

            break;

    }

    if(! isset($section_file)) {

        $temp_path1 = (empty($ARGS['admn'])) ? $PATH['module']['skin'] : '';
        $temp_path2 = $VIEW['section_path'];
        $temp_skin_path = is_file($temp_path1 . $ARGS['page'] . '.view.php') ? $temp_path1 : $temp_path2;
        $section_filename  = $ARGS['page'] . '.view.php';
        $headhook_filename = $ARGS['page'] . '.headhook.php';
        $script_filename   = $ARGS['page'] . '.script.php';
        $section_file   = $temp_skin_path . $section_filename;
        $headhook_file  = $temp_skin_path . $headhook_filename;
        $script_file    = $temp_skin_path . $script_filename;

    }

    // site/view/ 디렉토리에 head file이 있으면 html head부분에 include
    if(is_file($headhook_file)) {

        $VIEW['headhook'][$headhook_filename] = $temp_skin_path;

    }

    // site/view/ 디렉토리에 foot file이 있으면 html foot부분에 include
    if(is_file($script_file)) {

        $VIEW['script'][$script_filename] = $temp_skin_path;

    }

} // BLOCK

{ // BLOCK:include_layout:20121202:레이아웃파일 불러오기

    switch($CONFIG['show']) {

        case 'embed':   // embed 일 경우 head태그 없이 본문만 바로 출력
            include(LIBRARY_PATH . 'mapc/file_skin_include.func.php');
            mapc_file_skin_include($section_file, $section_data);
            break;

        default:
            include($VIEW['layout_file']);
            break;

    }

} // BLOCK

// End of file
