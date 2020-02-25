<?php
	$mapcArgs = explode("/", $_REQUEST['_url']);

	$routes = [];

// #TODO phacon의 ROUTE->add 함수 또는 Laravel의 ROUTE::post('/uri', '/callback') 같은 클래스를 만들어야 됨
	$routes['vendor'] = $mapcArgs[1] ? $mapcArgs[1] : DEFAULT_VENDOR;
	$routes['module'] = $mapcArgs[2] ? $mapcArgs[2] : DEFAULT_MODULE;

	switch($routes['vendor']) {

		/**
		 *
		 * 특수한 경우에만 Route {Vendor}/config/routes.php 에서 설정을 따로 함
		 *
		 */
		/*
			Retrieve(여러개)
				GET	/contents
			Create
				GET	/contents/new
				POST	/contents
			Retrieve
				GET	/contents/:id
			Update
				GET	/contents/:id/edit
				PUT	/contents/:id
			Delete
				DELETE	/contents/:id
		*/
		/*
		case 'VENDOR':
			$routes = include(APP_PATH . $routes['vendor'] . '/config/routes.php');
			break;
		*/
		// 각각의 디렉토리의 routes설정을 가져오도록... common/config/routes.php
		case 'Common':
		case 'ext':

			$routes = include(APP_PATH . $routes['vendor'] . DS . 'config' . DS . 'routes.php');
			break;

		default:

			$routes['action'] = $mapcArgs[3] ? $mapcArgs[3] : DEFAULT_ACTION;
			$routes['option'] = $mapcArgs[4];
			$routes['args']   = array_slice($mapcArgs, 5);

			$routes['callback'] = $routes['module'] . DS . $routes['action'];

			break;

	}

	return $routes;

// this is it
