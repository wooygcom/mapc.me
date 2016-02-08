<?php
if(!defined('__MAPC__')) { exit(); }

{ // BLOCK:path_set:2012080901:경로지정

    // 기본디렉토리, 아래의 디렉토리 위치를 다른 곳으로 변경할 경우 이 값을 변경해줘야 함
    // 디렉토리를 지정할 때는 언제나 뒷부분에 /(슬래시)를 붙여야 합니다. (dir1/(O), dir2(X))
    define('ROOT_PATH', __DIR__.'/');

    define('APP_PATH',  ROOT_PATH.'mapc-app/');      // 애플리케이션(프로그램 모음) 디렉토리, Application Directory
    {
        define('ADMIN_PATH',  APP_PATH . 'admin/'); // 관리자 프로그램 모음, Admin Directory
        define('MODULE_PATH', APP_PATH . 'module/');    // 모듈 디렉토리, Module Directory
        define('SITE_PATH',   APP_PATH . 'site/' . SITE_CODE . '/');   // Specialize config for each site
        {
            define('CONFIG_PATH',  SITE_PATH . 'config/');
            define('CTRLERS_PATH', SITE_PATH . 'ctrlers/');
            define('VIEWS_PATH',   SITE_PATH . 'views/');
            define('DATA_PATH',    SITE_PATH . 'data/');
        }
    }

    define('PUBLIC_PATH', ROOT_PATH . 'mapc-public/');   // Specialize CONTENT for each site
    {
        define('LAYOUT_PATH', PUBLIC_PATH . 'layout/');
    }

    define('SYSTEM_PATH',  ROOT_PATH.'mapc-system/');
    {
        define('INIT_PATH',    SYSTEM_PATH .'init/');
        define('LIBRARY_PATH', SYSTEM_PATH .'library/');
        define('PROC_PATH',    SYSTEM_PATH .'proc/');
    }

    define('TEMP_PATH', ROOT_PATH . 'mapc-temp/');

    define('VENDOR_PATH', ROOT_PATH . 'mapc-vendor/');

    define('ROOT_URL', pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME) . '/');    // 웹에서 접근할 때의 ROOT 주소

} // BLOCK

{ // BLOCK:args:20141219:rewrite에 의해 넘어온 사용자의 넘김값을 $ARGS에 넣기

    // index.php%{REQUEST_URI}로 받을 때는 = $_SERVER['PATH_INFO']
    // index.php?%{REQUEST_URI로 받을 때는 } $_SERVER['REQUEST_URI'] ($_SERVER['argv']) PHP설정에 따라 이 값도 써먹을 수 있음)
    $temp = [];

    // Root directory에 설치되어있을 때는 -1 ('/'(슬래쉬)만 제거)
    $temp['strlen'] = strlen(ROOT_URL);
    if($temp['strlen'] <= 2) {
        $temp['count'] = -1;
    } else {
        $temp['count'] = 0;
    }
    $temp['str'] = substr(ltrim($_SERVER['REQUEST_URI']), $temp['strlen'] + $temp['count']);

    if(strpos($temp['str'], "&") !== false) {
        $temp['strlen2'] = strpos($temp['str'], "&");
        $temp['strlen2'] = ($temp['strlen2'] > 0) ? $temp['strlen2'] : $temp['strlen'] + $temp['count'];
        $temp['str']     = substr($temp['str'], 0, $temp['strlen2']);
    }

    $ARGS = array_filter(explode("/", $temp['str']));   // argument들이 arg1/arg2/arg3 처럼 값이 넘어옴
    $ARGS['last']        = end($ARGS);
    $ARGS['request_uri'] = $temp['str'];

    $count_args = count($ARGS);

// #TODO 현재는 /module/page/action, /module/page/{ID}/action/ 과 같은 딱 3~4단계의URL만 정의가능함
// #TODO routes.php 로 조절가능하기는 하지만... 현재는 /{:id}/ 같은 URI에 섞여 들어오는 변수 처리를 못함...
    // POST(Create, Update, Delete)
    if (! empty($_POST)) {

        switch($_POST['_method']) { // POST값이 넘어왔을 때
            case 'post':
            case 'patch':
            case 'delete':
            default:
//              $ARGS['page'] = $ARGS[1] . 'Create';
//              $ARGS['page'] = $ARGS[1] . 'Update';
//              $ARGS['page'] = $ARGS[1] . 'Delete';
                $ARGS['page'] = $ARGS[1] . '-action';
                break;

        }

    // GET(Read, View) : ARGS[2]가 있으면(ARGS 배열이 3개 이상일 경우)
    } else {

        switch($ARGS['last']) {
            case 'create':
                $ARGS['page'] = $ARGS[1] . '-create';
                break;
            case 'read': // #TODO 마지막 값이 id인지 다른 페이지를 의미하는 건지 알아내야됨
                $ARGS['page'] = $ARGS[1] . '-read';
                $ARGS['id']   = $ARGS[2];
                break;
            default:
                $ARGS['page'] = $ARGS['last'];
                break;
        }

    }

    // $ARGS값을 변경하려면 SITE/config/routes.php 에서 변경가능...
    $ARGS['modl'] = $ARGS[0] ? $ARGS[0] : 'home';
    $ARGS['page'] = $ARGS['page'] ? $ARGS['page'] : 'index';

    // #TODO admin- <- 이 부분을 사이트 운영자 맘대로 설정가능하도록 해야 됨 (보안때문)
    if(strpos($ARGS['modl'], 'admin-') !== false) {

        $ARGS['admn'] = str_replace("admin-", '', $ARGS['modl']);
        $ARGS['modl'] = $ARGS['admn'] ? $ARGS['admn'] : $ARGS['modl'];

    }

    unset($temp, $var_name, $var_value);

} // BLOCK

// end of file
