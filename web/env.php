<?php
if(!defined("__MAPC__")) { exit(); }

{ // BLOCK:basic_config:20150807:기본값지정

    // make false before publish
    define('DEFAULT_VENDOR', 'common');
    define('DEFAULT_MODULE', 'index');

    if($_SERVER['REMOTE_ADDR'] == '175.196.104.211a') {

        define('TESTMODE', true);
        ini_set("display_errors","On");

    } else {

        error_reporting(0);

    }

} // BLOCK

{ // BLOCK:path_set:2012080901:경로지정

    // 디렉토리 구분자
    define('DS', DIRECTORY_SEPARATOR);

    // 기본디렉토리, 아래의 디렉토리 위치를 다른 곳으로 변경할 경우 이 값을 변경해줘야 함
    // 디렉토리를 지정할 때는 언제나 뒷부분에 /(슬래시)를 붙여야 합니다. (dir1/(O), dir2(X))
    define('ROOT_PATH', __DIR__ . DS);

    define('APP_PATH',    ROOT_PATH . 'mapc-app' . DS);      // 애플리케이션(프로그램 모음) 디렉토리, Application Directory
    define('SYSTEM_PATH', ROOT_PATH . 'mapc-system' . DS);      // 애플리케이션(프로그램 모음) 디렉토리, Application Directory
    {
        define('CONFIG_PATH', SYSTEM_PATH . 'config' . DS);
        define('PROC_PATH',   SYSTEM_PATH . 'proc' . DS);
        define('LIBRARY_PATH',   SYSTEM_PATH . 'library' . DS);
    }
    define('PUBLIC_PATH', ROOT_PATH . 'mapc-public' . DS);   // Specialize CONTENT for each site
    {
        define('LAYOUT_PATH', PUBLIC_PATH . 'layout' . DS);
    }
    define('DATA_PATH', ROOT_PATH . 'mapc-data' . DS);
    define('TEMP_PATH', ROOT_PATH . 'temp' . DS);

    define('VENDOR_PATH', ROOT_PATH . 'vendor' . DS);

//    define('ROOT_URL', '/_mapc/');    // 웹에서 접근할 때의 ROOT 주소
    define('ROOT_URL', pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME) . DS);    // 웹에서 접근할 때의 ROOT 주소
    define('DOMAIN', str_replace('www.', '', $_SERVER['HTTP_HOST']));
    define('HOST',   explode('.', DOMAIN)[0]);
    define('DEV_MODE', true);

} // BLOCK

// this is it
