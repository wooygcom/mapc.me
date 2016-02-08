<?php
define('__MAPC__', true);

{ // BLOCK:environment_and_barecode_for_system:20150807

	/**
	 *
	 * bare code for startup
	 *
	 */

    require(__DIR__ . '/../env.php');
	require(__DIR__ . '/../bootstrap.php');

} // BLOCK

{ // BLOCK:config:2012112201:환경설정

    /**
     *
     * Routes
     *
     */

    include_once(CONFIG_PATH . 'routes.php');

	/**
	 *
	 * Core Configuration
	 *
	 */

	include_once(CONFIG_PATH . 'config.php');

    /**
     *
     * Customize Configuration
	 *
     */

    include_once(CONFIG_PATH . 'custom.php');

} // BLOCK

{ // BLOCK:get_controller:20150825:컨트롤러 불러오기

    /**
     *
     * Get Controller
     *
     */

    include_once(PROC_PATH . 'ctrler.proc.php');

} // BLOCK

{ // BLOCK:publish:20150825:출력처리


    /**
     *
     * Get VIEW file and publish
     *
     */

    include_once(PROC_PATH . 'publish.proc.php');

} // BLOCK

// end of file
