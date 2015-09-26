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
	 * include Configuration
	 *
	 */

	include_once(CONFIG_PATH . 'config.php');

    /**
     *
     * Customize config
	 *
     */

    include_once(CONFIG_PATH . 'custom.php');

    /**
     *
     * Routes
     *
     */

    include_once(CONFIG_PATH . 'routes.php');

} // BLOCK

{ // BLOCK:set_path:2012080901

	/**
	 *
	 * Set path of page
	 *
	 */

    // site + page
	if($ARGS['modl'] == SITE_CODE || $ARGS['modl'] == 'home') {

        define('PAGE_PATH', PUBLIC_PATH . 'site/' . SITE_CODE . '/');

    // admin
	} elseif($ARGS['admn']) {

        define('PAGE_PATH', ADMIN_PATH . $ARGS['admn'] . '/');

	// module + page
	} else {

		define('PAGE_PATH', MODULE_PATH . $ARGS['modl'] . '/');

	}

} // BLOCK

{ // BLOCK:include_page:20150807

	/**
	 *
	 * Include Page (Include Controller)
	 *
	 */

	if(is_file(PAGE_PATH . $ARGS['page'] . '.php')) {

        // page file include(real functions for each page)
		@include(PAGE_PATH . $ARGS['page'] . '.php');

        // get hook file of module (if exists)
        @include(SITE_PATH . 'hook/' . $ARGS['modl'] . '/' . $ARGS['page'] . '.hook.php');

    } elseif(is_file(PAGE_PATH . 'index.php')) {

        // index.php
        include(PAGE_PATH . 'index.php');

    } else {

        // init page
        include(INIT_PATH . 'init.core.php');

	}

} // BLOCK

{ // BLOCK:publish:20150825

    include_once(PROC_PATH . 'publish.proc.php');

} // BLOCK

// end of file
