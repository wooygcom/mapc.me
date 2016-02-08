<?php
if(!defined("__MAPC__")) { exit(); }

{ // BLOCK:set_path:2012080901

    /**
     *
     * Set path of controller page
     *
     */

    // if already defined (in the routes.php)
    if (defined('PAGE_PATH')) {

        define('PAGE_TYPE', 'site');

    } elseif ($ARGS['modl'] == 'home') {

        define('PAGE_TYPE', 'site');
        define('PAGE_PATH', CTRLERS_PATH);

    // PAGE_PATH = admin directory
    } elseif ($ARGS['admn']) {

        define('PAGE_TYPE', 'admin');
        define('PAGE_PATH', ADMIN_PATH . $ARGS['admn'] . '/');

    // PAGE_PATH = module directory
    } else {

        define('PAGE_TYPE', 'module');
        define('PAGE_PATH', MODULE_PATH . $ARGS['modl'] . '/');

    }

} // BLOCK

{ // BLOCK:include_page:20150807

    /**
     *
     * Include Page (Include Controller)
     *
     */

    // PAGE_PATH/page.php 가 있을 경우...
    if(is_file(PAGE_PATH . $ARGS['page'] . '.php')) {

        // page file include(real functions for each page)
        include(PAGE_PATH . $ARGS['page'] . '.php');

    // PAGE_PATH/에 page.php는 없고 index.php 만 있을 경우...
    } elseif(is_file(PAGE_PATH . 'index.php')) {

        // index.php
        include(PAGE_PATH . 'index.php');

    } else {

        // 단순 화면출력일 경우 controller화일 없이 VIEW화일(page.view.php)만 불러오게끔...
        include(INIT_PATH . 'init.core.php');

    }

} // BLOCK

// end of file
