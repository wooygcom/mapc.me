<?php
if(!defined('__MAPC__')) { exit(); }

/**
 *
 * 화면출력 일괄처리
 *
 * @param string $VIEW['display_type'] 어떤 방식으로 화면에 출력할지
 * @param string $VIEW['url']          이동하려는 페이지 주소
 * @param string $VIEW['message']      출력하려는 내용
 * @param string $PATH['layout']  Path of Layout files
 *
 * @example
 *      $VIEW['display_type'] = 'html_alert';
 *      $VIEW['message'] = _('로그인 되었습니다.');
 *      $VIEW['url']     = $URL['core']['root'];
 * @example
 *      $PATH['layout'] = LAYOUT_PATH . 'basic/';
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

    $PATH['layout']  = $PATH['layout']  ? $PATH['layout']  : LAYOUT_PATH . $CONFIG['layout'] . '/';
    $URL['layout']   = $URL['layout']   ? $URL['layout']   : $URL['core']['root'] . 'layout/' . $CONFIG['layout'] . '/';

    // 출력옵션에 따라서...
    switch($VIEW['display_type']) {

        case 'move':

            header('location:' . $VIEW['url']);
            exit;

        case 'html_alert':
        case 'html_simple':

            $VIEW['layout_file']  = $VIEW['layout_file'] ? $VIEW['layout_file'] : 'html_simple.view.php';
            break;

        default:

            $VIEW['layout_file']  = $VIEW['layout_file'] ? $VIEW['layout_file'] : 'html_default.view.php';
            break;

    }

    $VIEW['section_file'] = $VIEW['section_file'] ? $VIEW['section_file'] : $ARGS['page'];

    // 컨트롤러에서 특정하지 않을 경우 is_file('디렉토리지정안됨/page.view.php')은 당연히 false가 되버림
    if(! is_file($PATH['section'] . $VIEW['section_file'] . '.view.php')) {

        // 지정된 경로에 section_file이 없을 경우 기본 디렉토리의 view화일을 가져옴
        switch(PAGE_TYPE) {
            case 'admin':
                $PATH['section'] = $PATH['view']['admin'];  // ADMIN모듈의 기본 VIEW디렉토리에서...
                break;
            case 'module':
                $PATH['section'] = $PATH['view']['module']; // 일반모듈의 기본 VIEW디렉토리에서...
                break;
            case 'site':
            default:
                $PATH['section'] = $PATH['view']['site'];   // 사이트의 기본 VIEW디렉토리에서...
                break;
        }

    }

    // 부가적인 화일들...
    $headhook_filename = $VIEW['section_file'] . '.headhook.php';
    $script_filename   = $VIEW['section_file'] . '.script.php';

    // site/view/ 디렉토리에 headhook file이 있으면 html head부분에 include
    if(is_file($PATH['section'] . $headhook_filename)) {

        $VIEW['headhook'][$headhook_filename] = $PATH['section'];

    }

    // site/view/ 디렉토리에 script file이 있으면 html body끝나기 직전에 include
    if(is_file($PATH['section'] . $script_filename)) {

        $VIEW['script'][$script_filename] = $PATH['section'];

    }

} // BLOCK

{ // BLOCK:include_layout:20121202:레이아웃파일 불러오기

    // 캐쉬화일 저장할 곳이 생성되어있지 않으면 생성
    if(!is_dir(TEMP_PATH . 'cache/' . $PATH['section'])) {
        mkdir(TEMP_PATH . 'cache/' . $PATH['section'], 0777, true);
    }

    // 캐시화일 지정
    // #TODO 캐쉬화일 갱신주기 지정하도록...$CONFIG['cache_update_term']
    $cache_file = $VIEW['cache'] ? $VIEW['cache'] : TEMP_PATH . 'cache/' . $PATH['section'] . $VIEW['section_file'] . '.' . date('YmdH') . '.cache.php';

    ob_start();
    if(! DEBUG_MODE && is_file($cache_file)) {
        include($cache_file);
        $VIEW['content'] = ob_get_contents();
    } else {
        include($PATH['section'] . $VIEW['section_file'] . '.view.php');
        $VIEW['content'] = ob_get_contents();
        file_put_contents($cache_file, $VIEW['content']);
    }
    ob_end_clean();

    switch($CONFIG['show']) {

        case 'embed':
            echo $VIEW['content'];
            break;

        default:
            include($PATH['layout'] . $VIEW['layout_file']);
            break;

    }

} // BLOCK

// End of file
