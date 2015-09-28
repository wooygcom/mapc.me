<?php
if(!defined('__MAPC__')) { exit(); }

{ // BLOCK:path_set:2012080901:경로지정

    // 기본디렉토리, 아래의 디렉토리 위치를 다른 곳으로 변경할 경우 이 값을 변경해줘야 함
    // 디렉토리를 지정할 때는 언제나 뒷부분에 /(슬래시)를 붙여야 합니다. (dir1/(O), dir2(X))
    define('ROOT_PATH', __DIR__.'/');

    define('APP_PATH',  ROOT_PATH.'app/');      // 애플리케이션(프로그램 모음) 디렉토리, Application Directory
    {
        define('ADMIN_PATH',  APP_PATH . 'admin/'); // 관리자 프로그램 모음, Admin Directory
        define('MODULE_PATH', APP_PATH . 'module/');    // 모듈 디렉토리, Module Directory
        define('SITE_PATH',   APP_PATH . 'site/' . SITE_CODE . '/');   // Specialize config for each site

        if(is_dir(SITE_PATH . 'config/')) { // 실제 config 디렉토리가 있을 경우 [config]이 환경설정 디렉터리
            define('CONFIG_PATH', SITE_PATH . 'config/');
        } else { // config 디렉토리가 없을 경우 [config.sample] 디렉토리가 환경설정 디렉터리
            define('CONFIG_PATH', SITE_PATH . 'config.sample/');
        }

        define('DATA_PATH', SITE_PATH . 'data/');
    }

    define('PUBLIC_PATH', ROOT_PATH . 'public/');   // Specialize CONTENT for each site
    {
        define('LAYOUT_PATH', PUBLIC_PATH . 'layout/');
    }

    define('SYSTEM_PATH',  ROOT_PATH.'system/');
    {
        define('INIT_PATH',    SYSTEM_PATH .'init/');
        define('LIBRARY_PATH', SYSTEM_PATH .'library/');
        define('PROC_PATH',    SYSTEM_PATH .'proc/');
    }

    define('TEMP_PATH', ROOT_PATH . 'temp/');

    define('VENDOR_PATH', ROOT_PATH . 'vendor/');

    define('ROOT_URL', pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME) . '/');    // 웹에서 접근할 때의 ROOT 주소

} // BLOCK

{ // BLOCK:args:20141219:rewrite에 의해 넘어온 사용자의 넘김값 변경

    // #TODO 아랫부분을 routes.php에서 처리하게 하는게 좋을듯...
    // dir1/dir2/dir3/arg1/var1/arg2/var2/ 처럼 들어왔을때의 처리
    // 근데 routes는 각 사이트마다 별도로 만드는데..

    // index.php%{REQUEST_URI}로 받을 때는 = $_SERVER['PATH_INFO']
    // index.php?%{REQUEST_URI로 받을 때는 } $_SERVER['REQUEST_URI'] ($_SERVER['argv']) PHP설정에 따라 이 값도 써먹을 수 있음)
    $path_info = $_SERVER['REQUEST_URI'];
    $temp['args'] = explode("/", str_replace(ROOT_URL, '', ltrim($path_info)));   // argument들이 arg1/arg2/arg3 처럼 값이 넘어옴

    // 첫번째 argument는 항상 "모듈"값이 들어옴, 두번째는 항상 "페이지"
    $ARGS['modl'] = $temp['args'][0];
    $ARGS['page'] = $temp['args'][1];

    // #TODO admin- <- 이 부분을 사용자가 맘대로 바꿀 수 있게 (보안)
    if(strpos($ARGS['modl'], 'admin-') !== false) {

        $ARGS['admn'] = str_replace("admin-", '', $ARGS['modl']);

    }

} // BLOCK

{ // BLOCK:declare_of_default_page:20150817

    $ARGS['admn']   = !empty($ARGS['admn']) ? $ARGS['admn'] : '';    // default admin module
    $ARGS['modl']   = !empty($ARGS['modl']) ? $ARGS['modl'] : SITE_CODE;    // default module
    $ARGS['modl']   = !empty($ARGS['admn']) ? $ARGS['admn'] : $ARGS['modl'];    // default admin값이 있을 경우 $ARGS['modl']은 admin값을 따름
    $ARGS['page']   = !empty($ARGS['page']) ? $ARGS['page'] : 'dashboard';    // default page

} // BLOCK

{ // BLOCK:get_args:20150825

    $count_args = (count($temp['args']));

    // Rewrite모듈에서 /foo1/var1/foo2/var2/foo3/var3 과 같은 형태로 넘어온 값을 $ARGS['foo1'] = 'var1'; 형태로 변경
    for($i=2; $i < $count_args; $i += 2) {

        $var_name = $temp['args'][$i];
        $var_value = $temp['args'][$i+1];

        // []값이 있을 경우 배열 변수로 처리
        if(strpos($var_name, "[]")) {

            $var_name = str_replace("[]", "", $var_name);
            $ARGS[$var_name][] = $var_value;

        // ?값이 있을 경우 (GET값이 넘어온 경우)
        } else if(strpos($var_name, "?") !== false) {

            $var_name = str_replace("?", "", $var_name);
            $temp['arg1'] = explode("&", $var_name);
            foreach($temp['arg1'] as $var) {

                $temp['arg2'] = explode("=", $var);
                $temp_key = $temp['arg2'][0]; 
                $temp_var = $temp['arg2'][1]; 

                $ARGS[$temp_key] = $temp_var;

               }

        } else {

            $ARGS[$var_name] = $var_value;

        }

    }

    unset($temp, $temp_key, $temp_var, $var_name, $var_value);

} // BLOCK

// end of file
