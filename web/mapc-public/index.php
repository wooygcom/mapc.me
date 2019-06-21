<?php
define('__MAPC__', true);

{ // BLOCK:init:20180825:초기화

	include('../env.php');
    include('../bootstrap.php');

} // BLOCK

{ // BLOCK:config:2012112201:환경설정
    /**
     *
     * Configuration
     *
     */
    $CONFIG = include(CONFIG_PATH . 'config.php');

    /**
     *
     * Routes
     *
     */
	$ROUTES = include(CONFIG_PATH . 'routes.php');

} // BLOCK

{ // BLOCK:load_page:20180829:페이지 불러오기

	/**
	 *
	 * Load page
	 *
	 */
	include(APP_PATH . $ROUTES['vendor'] . '/index.php');

} // BLOCK

// this is it
